<?php 
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
    
    //Check if already login, if true, redirect to user account
    if($front->is_loggedin() != ""){
        $genInfo->redirect(BASE_URL.'user');
    }

    //Set return url
    if(isset($_REQUEST['returnUrl'])){
        $returnUrl = str_replace('logout', '', $_REQUEST['returnUrl']);
    }else{
        $returnUrl = "";
    }

    //
    if(isset($_POST['email'])){
        $email = strip_tags($_POST['email']);

        //Php Validation
        if($email == "")  {
          $error[] = "Please enter your Email Address"; 
        } 
        else{
            $stmt = $genInfo->runQuery("SELECT * FROM users 
              WHERE email=:email");
            $stmt->execute(array(':email'=>$email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(isset($row['email']) AND $row['email'] == $email){
              $loginID = $row['login_id'];
              //Send password reset email
              include(ROOT_PATH . "emailTemplates/verify.php");
              $genInfo->redirect(BASE_URL.'user/password-reset?link-sent');
              exit();
            }else{
              $error[] = 'Opps! Email does not exist in the system!';
            }
        }   
    }

    $pageTitle = "Login ";
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
                Secured Login
                </h3>
                <?php
                if(isset($error)){
                    foreach($error as $error){?>
                     <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                     </div>
            <?php } }?>
            </div> 


<div class="panel-body">
<form method="post" action="#" role="form" class="text-center">
    <?php if(isset($_GET['link-sent'])){?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×
        </button>
        An email has been sent to your email with a <b>link</b>  to reset your Password.
    </div>
    <?php }else{?>
    <div class="alert alert-default alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×
        </button>
        Enter your <b>Email</b> and instructions will be sent to you!
    </div>
    <?php }?>
    <div class="form-group m-b-0">
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Enter Email" required="">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
                    Reset
                </button> 
            </span>
        </div>
    </div>

</form>
</div>
 
            </div> 
<div class="row">
    <div class="col-sm-12 text-center">
        <p>
            New User?
            <a href="<?php echo BASE_URL?>user/register" class="text-primary m-l-5"><b>Signup</b></a>
        </p>
    </div>
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