<?php
	// Redirect to login page if not logged in
	if(!$front->is_loggedin()){
		// session not set redirects to login page
		$genInfo->redirect(BASE_URL.'user/login?returnUrl=http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
?>