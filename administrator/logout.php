<?php
  	require("../includes/config.php");
  	require_once(ROOT_PATH . "core/backEnd-wrapper.php");
	//require_once(ROOT_PATH . "core/adminSession.php");

	if($adm->is_loggedin() !="" )	{
		//INSERT NOTIFICATION TABLE
		$userActn = $_SESSION['adm_username'].' has logged out!';
		$actUrl = 'admin-profile?admu='.$_SESSION['adm_username'];
		$stmt = $genInfo->runQuery("INSERT INTO notifications (admin, action, type, action_url, date_added)
			VALUES (:userName, :userActn, 'Logout', :actUrl, :currentTime)");

		$stmt->execute(array(':userName'=>$_SESSION['adm_username'], ':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));

		//Now logout
		$adm->doLogout();
		$genInfo->redirect(BASE_URL.'administrator/login');
		exit();
	}else{
		$genInfo->redirect(BASE_URL.'administrator/login');
		exit();
	}
?>