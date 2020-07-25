<?php 
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/frontEnd-wrapper.php");

  //Check if already login, if true, redirect to user account
    if($front->is_loggedin() != ""){
        $genInfo->redirect(BASE_URL.'user');
    exit();
    }

  //Set return url
  if(isset($_REQUEST['returnUrl'])){
    $returnUrl = $_REQUEST['returnUrl'];
  }else{
    $returnUrl = "";
  }

  //Grab login ID from verification link and check if exist in the system
  if(isset($_GET['true']) AND $_GET['true'] != ""){
    $loginID = intval($_GET['true']);
    try {
      $stmt = $genInfo->runQuery("SELECT * FROM users 
        WHERE login_id=:loginID");
      $stmt->execute(array(':loginID'=>$loginID));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if(isset($row['login_id']) AND $row['login_id'] == $loginID AND $row['login_id'] != 0){
        $genInfo->redirect(BASE_URL.'user/verify?id='.$loginID.'&change-password');
        exit();
      }else{
        $errorMsg = 'Opps! Something went wrong, please try again!';
      }
    }catch(PDOException $e) {
      echo $e->getMessage();
    } 
  }
  elseif(!isset($_GET['change-password']) 
    AND !isset($_GET['success'])){
    $errorMsg = 'Opps! Something went wrong, please try again!';
  }


  //Update new password
  if(isset($_POST['loginID'])){
    $loginID = intval($_POST['loginID']);
    $password = strip_tags($_POST['password']);
    $confirmPass = strip_tags($_POST['confirmPass']);

    if($password == ""){
      $error[] = 'Please enter new password!';
    }elseif(strlen($password) < 6){
      $error[] = "Password must be at least 6 characters";  
    }elseif($confirmPass != $password){
      $error[] = "Password does not match, please try again!";
    }else{
       if($front->changePassword($password, $loginID)){ 
          $genInfo->redirect(BASE_URL.'user/verify?success');
          exit();
        }
    }
  }

    $pageTitle = "Change Password | ".$siteInfo['site_name'];
    $pageDesc = "Description";
    $pageKeywords = "Keywords";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="CreativeWeb Nigeria">
        <title><?php echo $pageTitle.' - '; if(isset($siteInfo['site_name'])){echo $siteInfo['site_name'];}?></title>

        <?php if(isset($siteInfo['favicon_url'])){ 
            $faviconURL = BASE_URL.str_replace('../', '', $siteInfo['favicon_url']);?>
        <link rel='shortcut icon' href='<?php echo $faviconURL;?>' type='image/x-icon'/ >
        <?php }?>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center">
                <strong class="text-custom">
                    <?php echo $siteInfo['site_name'] ?>                  
                </strong><br>
                Password Reset
                </h3>
            </div> 

    <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success">
                  <i class="fa fa-check-square"></i> &nbsp; Password reset is successful, 
                  <a href="<?php echo BASE_URL;?>user/login">click to login</a>
                </div>
    <?php }elseif(isset($errorMsg)){?>
              <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> &nbsp; 
                <?php echo $errorMsg;?>
              </div>
    <?php }else{?>

            <?php if(isset($error)){
                  foreach($error as $error){ ?>
                   <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                   </div>
                <?php } } ?>


            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="" method="post">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="Password" name="password">

                        <input class="form-control" type="hidden" name="loginID" value="<?php echo $_GET['id'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="Confirm Password" name="confirmPass">
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
            </form> 
            
            </div> 
    <?php }?>
            </div> 
        </div>

        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>
</html>