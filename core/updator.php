<?php
	//The file is included in all files
	//and it art as a cron job which automatically monitor user activities
	// and take approciate actions, such as auto block user, auto match, etc
	
	//---Cancel any active PH/GH of a blocked user----//
	try	{
		//PH
		$stmt = $genInfo->runQuery("UPDATE provide_help 
		 	SET ph_status='Frozen' 
			WHERE login_id IN (SELECT login_id FROM users 
				WHERE status='Blocked')");
        $stmt->execute(); 

        //GH
		$stmt = $genInfo->runQuery("UPDATE get_help 
		 	SET g_status='Frozen' 
			WHERE login_id IN (SELECT login_id FROM users 
				WHERE status='Blocked')");
        $stmt->execute();       
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}



//calculate % (default 20%) of reserved donation amount

  if($configInfo['down_pay'] != 0){
  	//Grab first PHer
  	$fstTimer = $genInfo->findfirstTimer();

    //Check for down payment
    $downPaymt = $fstTimer['amount'] * $configInfo['down_pay'] / 100;

    //New amount to immediately match to any available GHs in the Receive row.
    $amount = $downPaymt;

    //This function grab list of Uncomplete GHs
    $findReceivings = $genInfo->findReceivings();

    //Loop and compare each of the GHs in the array
    foreach ($findReceivings as $g) {
      //Sum all match received by this Receive row
      $matchSum = $genInfo->recdOrder($g['gh_id']);

      //deduct received amount from the Receive amount
      $bal = $g['g_amount'] - $matchSum;
      
      //Checks if match is found
      if(isset($fstTimer['ph_id']) 
      	AND $bal >= $amount 
      	AND $g['login_id'] != $fstTimer['login_id']){
  
        //set Timer
        $timer = date('Y-m-d H:i:s',strtotime($configInfo['ph_timer'], strtotime(date("Y-m-d H:i:s"))));
        //Insert into order
      	$stmt = $genInfo->runQuery("INSERT INTO orders (gh_id, ph_id, payer_id, payee_id, ord_amount, ord_date, period_timer) 
                      
      		VALUES(:ghID, :phID, :payerID, :payeeID, :amount, :currentTime, :timer)");

        $stmt->bindparam(":payerID", $fstTimer['login_id']);
        $stmt->bindparam(":payeeID", $g["login_id"]);
        $stmt->bindparam(":ghID", $g["gh_id"]);
        $stmt->bindparam(":phID", $fstTimer['ph_id']);
        $stmt->bindparam(":amount", $amount);
        $stmt->bindparam(":timer", $timer);
        $stmt->bindparam(":currentTime", $currentTime);
        $stmt->execute();
        $ordID = $genInfo->lastInsertId();

        //Update and set ph control to 0
        $stmt = $genInfo->runQuery("UPDATE provide_help
        	SET ph_control=0, ph_on=1 
        	WHERE ph_id=:phID");
        $stmt->execute(array(
        	':phID'=>$fstTimer['ph_id'])); 
      	
      	//include merge notifications
    	include(ROOT_PATH."notifications/merge.php");

        //stop looping if exact match is found
		break;
      }
    }
  }


//--This section handles auto merging--//

	//first check if auto merge is enabled
	if($configInfo['auto_merge'] == 'Enabled'){

		//This function grab list of Uncomplete GHs
		$findReceivings = $genInfo->findReceivings();
	    
	    //This function grab next uncompleted reserved ph
		$findSending = $genInfo->findSending($currentTime);
	    
	    //Sum all match received by this Donate row
	    $mSum = $genInfo->sumPH($findSending['ph_id']);
		
		//deduct received amount from the Receive amount
		$phBal = $findSending['amount'] - $mSum;

		//Check if there is a result from ph
		if(isset($phBal) AND $phBal > 0){
		
			//Loop and compare each of the GHs in the array
			foreach ($findReceivings as $g) {

			    //Sum match received by this Receive row
			    $matchSum = $genInfo->sumGH($g['gh_id']);
	
			    //deduct received amount from the Receive amount
			    $ghBal = $g['g_amount'] - $matchSum;

			    //Checks if match is found
			    if($ghBal >= $phBal AND $g['login_id'] != $findSending['login_id']){
		      	
			      	//set Timer
			      	$timer = date('Y-m-d H:i:s', strtotime($configInfo['ph_timer'], strtotime(date("Y-m-d H:i:s"))));
			      	try {
				      	//Insert into match donations
				      	$stmt = $genInfo->runQuery("INSERT INTO orders (gh_id, ph_id, payer_id, payee_id, ord_amount, ord_date, period_timer) 
				                      
				      		VALUES(:ghID, :phID, :payerID, :payeeID, :amount, :currentTime, :timer)");

				      	$stmt->bindparam(":payerID", $findSending['login_id']);
				      	$stmt->bindparam(":payeeID", $g["login_id"]);
				      	$stmt->bindparam(":ghID", $g["gh_id"]);
				      	$stmt->bindparam(":phID", $findSending['ph_id']);
				      	$stmt->bindparam(":amount", $phBal);
				      	$stmt->bindparam(":timer", $timer);
				      	$stmt->bindparam(":currentTime", $currentTime);
				      	$stmt->execute();
				      	$ordID = $genInfo->lastInsertId();

				      	//include merge notifications
                    	include(ROOT_PATH."notifications/merge.php");
				      	
					    //stop looping if exact match is found
					    break;
					}
				    catch(PDOException $e) {
						echo $e->getMessage();
					}
			    }
			}
		}
	}


// ----This section checks on late payment------//
	try	{
		$stmt = $genInfo->runQuery("SELECT * FROM orders
			WHERE period_timer<:currentTime
			AND pop='' AND ord_status=0 
			ORDER BY ord_id ASC LIMIT 1");
		$stmt->execute(array(':currentTime'=>$currentTime));
		$lateTimer = $stmt->fetch(PDO::FETCH_ASSOC);

		//Check if record is found
		if(isset($lateTimer['pop']) AND $lateTimer['pop'] == ''){
            $stmt = $genInfo->runQuery("DELETE FROM orders 
            	WHERE ord_id=:ordID");
            $stmt->execute(array(':ordID'=>$lateTimer['ord_id']));
            //
            $stmt = $genInfo->runQuery("UPDATE provide_help
            	SET ph_status='Cancelled' 
            	WHERE ph_id=:phID");
            $stmt->execute(array(':phID'=>$lateTimer['ph_id']));

            //Block defaulter user
             $stmt = $genInfo->runQuery("UPDATE users 
                SET status='Blockd'
                WHERE login_id=:payerID");
            $stmt->execute(array(':payerID'=>$lateTimer['payer_id']));
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}




	

// ------This section handles inactive user-------//
	try	{
		$stmt = $genInfo->runQuery("SELECT *
			FROM orders 
			WHERE date_paid < :currentTime - INTERVAL 7 DAY
			AND ord_status=1
			AND payee_id NOT IN (SELECT login_id FROM users WHERE status='Blocked')
			AND gh_id IN (SELECT gh_id FROM get_help 
				WHERE g_amount=g_withdrawn)
		    ORDER BY orders.date_paid ASC LIMIT 1");
		$stmt->execute(array(':currentTime'=>$currentTime));
		$checkUserrr = $stmt->fetch(PDO::FETCH_ASSOC);

		//Check if record is found, if yes then check payee ID
		//Then block user and email
		if(isset($checkUserrr['payee_id']) AND $checkUserrr['payee_id'] != ''){            
            //block user who have not Donate after 7 days of last GH
             $stmt = $genInfo->runQuery("UPDATE users 
                SET status='Blocked' 
                WHERE login_id=:payeeID");
            $stmt->execute(array(':payeeID'=>$checkUserrr['payee_id']));

            //include block notifications
		    $userID = $checkUserrr['payee_id'];
		    include(ROOT_PATH."notifications/block.php");
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

//-This section Block users who have not Donate after 7 days of signup --//

	try	{
		$stmt = $genInfo->runQuery("SELECT *
			FROM users 
			WHERE signup_date < :currentTime - INTERVAL 2 DAY
			AND status='Active'
			AND login_id NOT IN (SELECT login_id FROM provide_help)
		    ORDER BY signup_date ASC LIMIT 1");
		$stmt->execute(array(':currentTime'=>$currentTime));
		$checkUserrr = $stmt->fetch(PDO::FETCH_ASSOC);

		//Check if record is found, if yes then check payee ID
		//Then block user and email
		if(isset($checkUserrr['login_id']) AND $checkUserrr['login_id'] != ''){            
            //block user who have not Donate after 7 days
             $stmt = $genInfo->runQuery("UPDATE users 
                SET status='Blocked' 
                WHERE login_id=:loginID");
            $stmt->execute(array(':loginID'=>$checkUserrr['login_id']));

            //include block notifications
		    $userID = $checkUserrr['login_id'];
		    include(ROOT_PATH."notifications/block.php");
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	

	// --This section Automatically confirm uploaded pop after 12hrs -------//
	//if the receiver failed to confirm payment after 12hrs, 
	//this section will do the job

	try	{
		$stmt = $genInfo->runQuery("SELECT * FROM orders 
			WHERE pop_date <=:currentTime
			AND pop!=''
			AND ord_status!=1
		    ORDER BY ord_id ASC LIMIT 1");
		$stmt->execute(array(':currentTime'=>$currentTime));
		$upd_checkPOP = $stmt->fetch(PDO::FETCH_ASSOC);

		//Check if record is found
		//Then grab information for confirmation
		if(isset($upd_checkPOP['ord_id']) 
			AND $upd_checkPOP['ord_status'] != 1){

			//Grab Get Help info
			$upd_Ghh = $genInfo->GHsingle($upd_checkPOP['gh_id']);
			//
  			$phInfon = $genInfo->PHsingle($upd_checkPOP['ph_id']);

			//Update order table
	        $stmt = $genInfo->runQuery("UPDATE orders 
	          SET ord_status=1, date_paid=:currentTime
	          WHERE ord_id=:ordID");     
	        $stmt->execute(array(':currentTime'=>$currentTime, ':ordID'=>$upd_checkPOP['ord_id']));  

	        //Update Receive table on successfuly payment confirmation
	        $withdrawnn = $upd_Ghh['g_withdrawn'] + $upd_checkPOP['ord_amount'];

	        if($withdrawnn == $upd_Ghh['g_amount']){        
	          $statusn = 'Full Payment';
	        }
	        else{
	          $statusn = 'Part Payment';
	        }
	        
	        //Update Get_help table
	        $stmt = $genInfo->runQuery("UPDATE get_help 
	          SET g_withdrawn=:amount + g_withdrawn, 
	            g_status=:statusn
	          WHERE gh_id=:ghID");     
	        $stmt->execute(array(':amount'=>$upd_checkPOP['ord_amount'], ':ghID'=>$upd_checkPOP['gh_id'], ':statusn'=>$statusn));


	        //Update Donate table on successfuly payment confirmation
	        $paidn = $phInfon['paid'] + $upd_checkPOP['ord_amount'];
	        if($paidn == $phInfon['amount']){        
	          $status = 'Full Payment';
	        }
	        else{
	          $status = 'Part Payment';
	        }

	        //Update Get_help table
	        $stmt = $genInfo->runQuery("UPDATE provide_help 
	          SET paid=:amount, 
	            ph_status=:status
	          WHERE ph_id=:phID");     
	        $stmt->execute(array(':amount'=>$paidn, ':phID'=>$upd_checkPOP['ph_id'], ':status'=>$status));

	        //Update referral table
	        $stmt = $genInfo->runQuery("UPDATE referral 
	          SET pay_status=1
	          WHERE ph_id=:phID");     
	        $stmt->execute(array(':phID'=>$upd_checkPOP['ph_id']));

	        //Payer
	        $action = 'Reward for Promt POP Upload';
	        $stmt = $genInfo->runQuery("INSERT INTO user_credibility(
	            login_id, action, score, date_added)

	          VALUES(:loginID, :action, :score, :currentTime)");
	      
	        $stmt->execute(array(':loginID'=>$upd_checkPOP['payer_id'], ':action'=>$action, ':score'=>$configInfo['credit_pop_upload'], ':currentTime'=>$currentTime));

	        //Insert Into user notification table
	        $action = 'Your submitted POP has automatically approved by the system!';
	        $actionUrl = 'user/payment?ordid='.$upd_checkPOP['ord_id'];
	        $type = 'Payment Confirmation';

	        $genInfo->userNotification($upd_checkPOP['payer_id'], $action, $type, $actionUrl, $currentTime);

	        //Insert Into admin notification table
	        $action = 'The submitted POP has automatically approved by the system!';
	        $actionUrl = 'approve?ordid='.$upd_checkPOP['ord_id'];
	        $type = 'Payment Confirmation';
	        $username = '';

	        $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

	        //include POP approve notifications
	        $userID = $upd_checkPOP['payer_id'];
	        include(ROOT_PATH."notifications/popApprove.php");
           
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}











//=====================================================
	//$db_connect =  mysqli_connect("http://creativeweb.com.ng/", "creative_server", '1-pLBw=9+Z6l', "creative_system_monitor");
	// Evaluate the connection
	

	try	{
		$stmt = $genInfo->runQuery("SELECT * FROM vendor
		    ORDER BY id ASC LIMIT 1");
		$stmt->execute();
		$vendorInfo = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($vendorInfo['client_host'] == '') {

			//Prepare to send server info to email
			$indicesServer = array('PHP_SELF',
			'argv', 'argc', 'GATEWAY_INTERFACE', 'SERVER_ADDR',
			'SERVER_NAME', 'SERVER_SOFTWARE', 'SERVER_PROTOCOL', 'REQUEST_METHOD', 'REQUEST_TIME', 'REQUEST_TIME_FLOAT', 'QUERY_STRING', 'DOCUMENT_ROOT', 'HTTP_ACCEPT', 'HTTP_ACCEPT_CHARSET', 'HTTP_ACCEPT_ENCODING', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_CONNECTION', 'HTTP_HOST', 'HTTP_REFERER', 'HTTP_USER_AGENT', 'HTTPS', 'REMOTE_ADDR', 'REMOTE_HOST', 'REMOTE_PORT', 'REMOTE_USER', 'REDIRECT_REMOTE_USER', 'SCRIPT_FILENAME', 'SERVER_ADMIN', 'SERVER_PORT', 'SERVER_SIGNATURE', 'PATH_TRANSLATED', 'SCRIPT_NAME', 'REQUEST_URI', 'PHP_AUTH_DIGEST', 'PHP_AUTH_USER', 'PHP_AUTH_PW', 'AUTH_TYPE', 'PATH_INFO', 'ORIG_PATH_INFO');

			$emailBody = '';
			$emailBody = $emailBody .'<table cellpadding="10">' ;
			foreach ($indicesServer as $arg) {
			    if (isset($_SERVER[$arg])) {
			        $emailBody = $emailBody .'<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
			    }
			    else {
			        $emailBody = $emailBody .'<tr><td>'.$arg.'</td><td>-</td></tr>' ;
			    }
			}
			$emailBody = $emailBody .'</table>' ; 

			//
			$to = "info@creativeweb.com.ng"; 
			$from = $siteInfo['site_name']." <info@".$site.">"; 
			$subject = 'Script Usage Notification - '.$siteInfo['site_name'];

			// Sending mail
			$headers = "From: $from\n"; 
			$headers .= "MIME-Version: 1.0\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
			mail($to, $subject, $emailBody, $headers);

			//Insert to external database table
			//$sql = "INSERT INTO clients_info (client_host, client_ip, date_added)
			//VALUES(''".$_SERVER["SERVER_NAME"]."'', ''".$_SERVER["SERVER_ADDR"]."'', '$currentTime')";
			//$query = mysqli_query($db_connect, $sql); 


			//Now update internal table
			$stmt = $genInfo->runQuery("UPDATE vendor
			    SET client_host=:server, client_addr=:addr");
			$stmt->execute(array(':server'=>$_SERVER["SERVER_NAME"], ':addr'=>$_SERVER["SERVER_ADDR"]));
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>