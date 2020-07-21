<?php
	if(isset($_POST['match'])){
		$ghID = $_POST['payee'];
		$cntPayer = array();
		$cntPayee = array();
		$cntPayer = count($_POST['payers']);
		$cntPayee = count($_POST['payee']);
		//
		if($ghID == "" OR $cntPayee > 1){
			$error[] = "Opps: Please select single Receiver!";
		}
		elseif($cntPayer < 1){
			$error[] = "Opps: Please select at least one Payer!";
		}
		elseif($cntPayer > 7){
			$error[] = "Opps: You can only select up to 7 Payers at a time!";
		}
		else{
			for($i = 0; $i < $cntPayer; $i++) {
				$phID = $_POST['payers'][$i];
				try	{
					//Grab GH Info
					$ghInfo = $adm->myGHsingle($ghID);

					//Check remaining amount of payee
                    $ghOrder = $adm->matchingOrder($ghID);

                    //Balance
                    $bal = $ghInfo["g_amount"] - $ghOrder;

					//Grab Payer Info
					$phInfo = $adm->myPHsingle($phID);

					//Check remaining amount of Payer
                    $mOrderPayer = $adm->mOrderPayer($phID);

                    //Balance                    
					$phBal = $phInfo["amount"] - $mOrderPayer;


					//Check Payee remaining amt 
					//if the receiving amt is added
					$remning = $ghInfo["g_amount"] - ($ghOrder + $phBal);
					
					//Check Payer remaining amt if the paying amt is added
					$remainPayer = $phInfo["amount"] - ($mOrderPayer + $bal);

					//Compare for Cross Merging 
					if($phBal > $bal){
						$payingAmt = $bal;
						$remning = $remainPayer;
					}else{
						$payingAmt = $phBal;
					}

					if($remning != 0 AND $remning < $configInfo['min_ph']){
						$error[] = "Oops! Outstanding amount will fall below the minimum PH Amount!";	
					}elseif($phInfo["login_id"] == $ghInfo["login_id"])	{
						$error[] = "Opps: It seems one of more of your selected Payers is Merging to itself as Receiver!";	
					}else{
						//set Timer
		      			$timer = date('Y-m-d H:i:s', strtotime($configInfo['ph_timer'], strtotime(date("Y-m-d H:i:s"))));

						// Insert into orders Table
						$stmt = $genInfo->runQuery("INSERT INTO orders(gh_id, ph_id, payer_id, payee_id, ord_amount, ord_date, period_timer) 

						VALUES(:ghID, :phID, :payerID, :payeeID, :payingAmt, :currentTime, :timer)");
						
						$stmt->execute(array(':ghID'=>$ghID, ':phID'=>$phID, ':payerID'=>$phInfo["login_id"], ':payeeID'=>$ghInfo["login_id"], ':payingAmt'=>$payingAmt, ':currentTime'=>$currentTime, ':timer'=>$timer));
						$ordID = $genInfo->lastInsertId();

						//include merge notifications
                    	//include(ROOT_PATH."notifications/merge.php");
					}
				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}			
			}
			if(!isset($error)){
				$genInfo->redirect(BASE_URL.'administrator/manual-merging?merged');
				exit();
			}
		}	
	}
?>