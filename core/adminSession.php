<?php
	// Redirect to login page if not logged in
	if(!$adm->is_loggedin()){
		//both session not set redirects to login page
		$genInfo->redirect(BASE_URL.'administrator/login?returnUrl=http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
	//Screen Lock
	if(isset($_SESSION['adm_username']) 
		AND !isset($_SESSION['adm_session'])){
		//only adm_username session set redirects to screen lock page
		$genInfo->redirect(BASE_URL.'administrator/screen-lock');
		exit();
	}

	//Admin Privilege handling
	if(isset($editor) AND isset($accounting)){
		if($admInfo['role'] == 'Editor' AND $editor != "true"){
			$genInfo->redirect(BASE_URL.'administrator/screen-lock');
			exit();
		}
		
		if($admInfo['role'] == 'Accounting' AND $accounting != "true"){
			$genInfo->redirect(BASE_URL.'administrator/screen-lock');
			exit();
		}
	}
	elseif($admInfo['role'] != 'Administrator'){
		$genInfo->redirect(BASE_URL.'administrator/screen-lock');
		exit();
	}
?>