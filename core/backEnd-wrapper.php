<?php	
	require_once(ROOT_PATH . "core/class.general.php");
  	require_once(ROOT_PATH . "core/class.admin.php");
  	require_once(ROOT_PATH . "core/updator.php");
	 
	//Create an Object of ADMIN class
  	$adm = new ADMIN();

	//Grab user ID from session, if logged in
	if(isset($_SESSION['adm_session'])){
		$admID = intval($_SESSION['adm_session']);
		//store single user info in an array
		$admInfo = $adm->admInfo($admID);

		//Notification count
		$last7Days = date('Y-m-d H:i:s',strtotime('-7 days',strtotime(date("Y-m-d H:i:s"))));
		$cntNotify = $adm->cntNotifiers($admInfo['username'], $last7Days);

		//Notifications
		$topNotifications = $adm->topNotifications($admInfo['username'], $last7Days);
		//
		$countMessages = $adm->countMessages($admID);


		//Update notifications
		if(isset($_POST['marknotfRead']) OR isset($_GET['marknotfRead'])){
			if(isset($_POST['marknotfRead'])){
				$marknotfRead = intval($_POST['marknotfRead']);
			}else{
				$marknotfRead = intval($_GET['marknotfRead']);
			}
			try {
				//Mark as read
				$stmt = $genInfo->runQuery("UPDATE notifications
					SET status=1, readers=:username
					WHERE id=:marknotfRead LIMIT 1");
			      $stmt->execute(array(':marknotfRead'=>$marknotfRead, ':username'=>$admInfo['username']));
		    }
		    catch(PDOException $e) {
		      echo $e->getMessage();
		    }
		}

		if(isset($_POST['marknotfUnread'])){
			$marknotfUnread = intval($_POST['marknotfUnread']);
			try {
				//Mark as read
				$stmt = $genInfo->runQuery("UPDATE notifications
					SET status=0, readers=:username
					WHERE id=:marknotfUnread LIMIT 1");
			      $stmt->execute(array(':marknotfUnread'=>$marknotfUnread, ':username'=>$admInfo['username']));
		    }
		    catch(PDOException $e) {
		      echo $e->getMessage();
		    }
		}

		//Update last access on admin login activity table
		try {
			//First Grab last login ID
			$stmt = $genInfo->runQuery("SELECT * FROM admin_login_activity
				WHERE admin=:adu
				ORDER BY last_access DESC LIMIT 1");
		      $stmt->execute(array(':adu'=>$admInfo['username']));
		      $loginActvty = $stmt->fetch(PDO::FETCH_ASSOC);

	      	$stmt = $genInfo->runQuery("UPDATE admin_login_activity 
	      		SET last_access=:cTime WHERE id =:id");
	      	$stmt->execute(array(':cTime'=>$currentTime, ':id'=>$loginActvty['id']));
	    }catch(PDOException $e) {
	      echo $e->getMessage();
	    }
	}

	//Clean site url
	$siteUrll = str_replace('https://', '', str_replace('http://', '', str_replace('www.', '', $siteInfo['site_url'])));
?>