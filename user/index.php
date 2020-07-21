<?php 
  require("../includes/config.php"); 
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");
  //
  $genInfo->redirect(BASE_URL.'user/dashboard');
  exit();
?>