<?php
  	require("../includes/config.php");
  	require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
	//require_once(ROOT_PATH . "core/adminSession.php");

	if($front->is_loggedin() !="" )	{
		$front->doLogout();
		$genInfo->redirect(BASE_URL.'user/login');
		exit();
	}else{
		$genInfo->redirect(BASE_URL.'user/login');
		exit();
	}
?>