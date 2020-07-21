<?php
	if(isset($_GET['uid']) AND $_GET['uid'] != ''){
	    $uID = intval($_GET['uid']);
	}
	//Grab single user info
	$uInfo = $adm->userInfo($uID);
	if(empty($uInfo)){
	    $genInfo->redirect(BASE_URL.'administrator/customers');
		exit();
	}
?>