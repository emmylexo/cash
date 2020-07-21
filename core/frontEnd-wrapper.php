<?php	
	require_once(ROOT_PATH . "core/class.general.php");
	require_once(ROOT_PATH . "core/class.user.php");
  	require_once(ROOT_PATH . "core/updator.php");
	
	//Create an Object of USER class
	$front = new USER();

	//Grab user ID from session, if logged in
	if(isset($_SESSION['user_id'])){
		$loginID = intval($_SESSION['user_id']);
		//store single user info in an array
		$userInfo = $front->userInfo($loginID);
		if(!isset($userInfo['status']) 
			OR $userInfo['status'] == 'Blocked'){
			$front->doLogout();
			$genInfo->redirect(BASE_URL.'user/login');
			exit();
		}
		//
		$myRecentOrder = $front->myRecentOrder($loginID);
		//
		$countMessages = $front->countMessages($loginID);

		//Notification count
		$cntNotify = $front->cntNotifiers($loginID);

		//Notifications
		$topNotifications = $front->topNotifications($loginID);

		//Update notifications
		if(isset($_POST['marknotfRead']) OR isset($_GET['marknotfRead'])){
			if(isset($_POST['marknotfRead'])){
				$marknotfRead = intval($_POST['marknotfRead']);
			}else{
				$marknotfRead = intval($_GET['marknotfRead']);
			}
			try {
				//Mark as read
				$stmt = $genInfo->runQuery("UPDATE user_notification
					SET status=1
					WHERE id=:marknotfRead LIMIT 1");
			      $stmt->execute(array(':marknotfRead'=>$marknotfRead));
		    }
		    catch(PDOException $e) {
		      echo $e->getMessage();
		    }
		}

		if(isset($_POST['marknotfUnread'])){
			$marknotfUnread = intval($_POST['marknotfUnread']);
			try {
				//Mark as read
				$stmt = $genInfo->runQuery("UPDATE user_notification
					SET status=0
					WHERE id=:marknotfUnread LIMIT 1");
			      $stmt->execute(array(':marknotfUnread'=>$marknotfUnread));
		    }
		    catch(PDOException $e) {
		      echo $e->getMessage();
		    }
		}

		//Update last access on user login activity table
		try {
			//First Grab last login ID
			$stmt = $genInfo->runQuery("SELECT * FROM user_login_activity
				WHERE login_id=:loginID
				ORDER BY last_access DESC LIMIT 1");
		      $stmt->execute(array(':loginID'=>$loginID));
		      $loginActvty = $stmt->fetch(PDO::FETCH_ASSOC);
		    //update login activity table
	      	$stmt = $genInfo->runQuery("UPDATE user_login_activity
	      		SET last_access=:cTime WHERE id=:id");
	      	$stmt->execute(array(':cTime'=>$currentTime, ':id'=>$loginActvty['id']));
	      	//update user table
	      	$stmt = $genInfo->runQuery("UPDATE users SET last_login=:cTime
	      		WHERE login_id=:loginID");
	      	$stmt->execute(array(':cTime'=>$currentTime, ':loginID'=>$loginID));
	    }
	    catch(PDOException $e) {
	      echo $e->getMessage();
	    }
	}

	//Clean site url
	$siteUrll = str_replace('https://', '', str_replace('http://', '', str_replace('www.', '', $siteInfo['site_url'])));

	//Grab and insert site visitor info into table
	if(!isset($_SESSION['visitorIP'])){
		try {
			$locaHereOnly = $gen_state.', '.$gen_country;
	      	$stmt = $genInfo->runQuery("INSERT INTO visitors (ip, client , os, location, v_date) 
	      		VALUES(:userIP, :userBrowser, :userOS, :locaHereOnly, :currentTime)");

	      	$stmt->execute(array(
	      		':userIP'=>$gen_userIP, 
	      		':userBrowser'=>$gen_userBrowser,
	      		':userOS'=>$gen_userOS, 
	      		':locaHereOnly'=>$locaHereOnly, 
	      		':currentTime'=>$currentTime));
	    }catch(PDOException $e) {
	      echo $e->getMessage();
	    }

	    $_SESSION['visitorIP'] = $gen_userIP;
	}
?>