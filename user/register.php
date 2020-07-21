<?php 
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
    
    //Grab Referral ID from COOKIE
    if(isset($_COOKIE["refEmail"]) ){
        $refEmail = intval($_COOKIE['refEmail']);
    }else{
        $refEmail = '';
    }

    if($front->is_loggedin()!=""){
        $genInfo->redirect(BASE_URL.'user');
    }

    if(isset($_POST['firstName'])){
        $firstName = strip_tags($_POST['firstName']);
        $lastName = strip_tags($_POST['lastName']);
        $gender = strip_tags($_POST['gender']); 
        $phone = strip_tags($_POST['phone']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $refEmail = strip_tags($_POST['referral']);

        //check if referral email exist
        try {
            $stmt = $genInfo->runQuery("SELECT * FROM users 
              WHERE email=:refEmail LIMIT 1");
            $stmt->execute(array(':refEmail'=>$refEmail));
            $refInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        //
        $refID = '';
        if(isset($refInfo['email']) 
            AND $refInfo['email'] == $refEmail){
            $refEmail = $refEmail;
            $refID = $refInfo['login_id'];
        }
//        else{
//            $error[] = "Opps! No record found for the referral username provided!";
//        }
        
        //Php Validation
//        if($refEmail == "") {
//            $error[] = "Referral email is required!";
//        }

        if($firstName == "") {
            $error[] = "Please enter your First Name!"; 
        }
        
        if($lastName == "")  {
            $error[] = "Please enter your Last Name!"; 
        }
        
        if(strlen($phone) < 6)  {
            $error[] = "Please enter a valid Mobile Number!"; 
        }
        
        
        if(strlen($password) < 6){
          $error[] = "Password must be atleast 6 characters"; 
        }
 
        if(!isset($error)){
          try {
            $stmt = $genInfo->runQuery("SELECT * FROM users 
              WHERE email=:email OR phone=:phone");
            $stmt->execute(array(':email'=>$email, ':phone'=>$phone));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['email'] == $email){
              $error[] = "Sorry, Username already in use in the system!";
            }
            elseif($row['phone'] == $phone){
              $error[] = "Opps! Phone Number already in use in the system!";
            }
            else{
                //Check if email or SMS notification is enabled
                if((isset($configInfo['email_note']) 
                    AND $configInfo['email_note'] == 'Enabled')
                    OR isset($configInfo['sms_note']) 
                    AND $configInfo['sms_note'] == 'Enabled'){

                    $status = 'Pending';
                }else{
                    $status = 'Active';
                }

                //Generate Unique Email and SMS code
                $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $emailCode = substr(str_shuffle($alphanum), 0, 6);
                $SMSCode = substr(str_shuffle($alphanum), 0, 6);
                //
                if($front->register($firstName, $lastName, $phone, $email, $password, $gender, $refID, $currentTime, $gen_city, $gen_state, $gen_country, $gen_userIP, $emailCode, $SMSCode, $status)){
                
                    //include signup notifications
                    include(ROOT_PATH."notifications/signup.php");

                    $genInfo->redirect(BASE_URL.'user/login?joined');
                    exit();
                }
            }
          }
          catch(PDOException $e) {
            echo $e->getMessage();
          }
        } 
    }

    $pageTitle = 'Signup To '.$siteInfo['site_name'];
    $pageDesc = 'Create an Account  | '.$siteInfo['site_name'];
    $pageKeywords = ' | '.$siteInfo['site_name'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ojaolawebsolution.com">
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
                <h3 class="text-center">Signup to 
                <strong class="text-custom">
                    <?php echo $siteInfo['site_name'];?>
                </strong>
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
    <form class="form-horizontal m-t-20" action="" method="post">

        <div class="form-group ">
            <div class="col-xs-6">
                <input class="form-control" type="text" name="firstName" required placeholder="First Name" value="<?php if(isset($firstName)){echo $firstName;}?>">
            </div>

            <div class="col-xs-6">
                <input class="form-control" type="text" name="lastName" required placeholder="Last Name" value="<?php if(isset($lastName)){echo $lastName;}?>">
            </div>
        </div>

        <div class="form-group ">
            <div class="col-xs-12">
                <select required class="form-control" name="gender">
                <?php if(isset($gender)){?>
                    <option value="<?php echo $gender;?>"><?php echo $gender;?></option>
                <?php }?>
                    <option value="">--Select Gender--</option>
                    <option value="Male">Male</option>
                    <option value="Male">Female</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="phone" name="phone" required placeholder="Phone Number (eg: +2348100000000)" value="<?php if(isset($phone)){echo $phone;}?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="email"  placeholder="username" value="<?php if(isset($email)){echo $email;}?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" name="password" required placeholder="Password" value="<?php if(isset($password)){echo $password;}?>">
            </div>
        </div>

        
        <?php if($refEmail != ''){?>
        <div class="form-group">
            <div class="col-xs-12">
                <label>Referral Username</label>
                <input class="form-control" type="text" name="referral" placeholder="Referral email" value="<?php echo $refEmail;?>">
            </div>
        </div>
        <?php }else{?>
        <div class="form-group">
            <div class="col-xs-12">
                <label>Referral Username</label>
                <input class="form-control" type="text" name="referral" placeholder="Referral email (optional)" value="">
            </div>
        </div>        
        <?php }?>

        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox" checked="checked">
                    <label for="checkbox-signup">I accept 
                    <a target="_blank" href="<?php echo BASE_URL;?>terms">Terms and Conditions</a></label>
                </div>
            </div>
        </div>

        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-pink btn-block text-uppercase waves-effect waves-light">
                    Register
                </button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-sm-12 text-center">
        <p>
            Already have account?
            <a href="<?php echo BASE_URL?>user/login" class="text-primary m-l-5"><b>Sign In</b></a>
        </p>
    </div>
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