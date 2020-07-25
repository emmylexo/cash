<?php
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");
  
  //
  if(isset($_POST['emailCode'])){
    $emailCode = strip_tags($_POST['emailCode']);
    
    //Php Validation
    if($emailCode != $userInfo["email_code"])  {
      $error[] = "Invalid Code! Please check verification code sent to your email.";  
    }else{
      try {
        $stmt = $genInfo->runQuery("UPDATE users 
          SET email_verify='1', last_updated=:currentTime 
          WHERE login_id=:loginID");
        $stmt->execute(array(':loginID'=>$loginID, ':currentTime'=>$currentTime));

        //check if only email notification is enabled
        if((isset($configInfo['email_note']) 
          AND $configInfo['email_note'] == 'Enabled')
          AND (isset($configInfo['sms_note']) 
          AND $configInfo['sms_note'] != 'Enabled')){

          //
          $stmt = $genInfo->runQuery("UPDATE users 
            SET status='Active' 
            WHERE login_id=:loginID");
          $stmt->execute(array(':loginID'=>$loginID));
        }
        else{
          if($userInfo["sms_verify"] == 1){
            $stmt = $genInfo->runQuery("UPDATE users 
              SET status='Active' 
              WHERE login_id=:loginID");
            $stmt->execute(array(':loginID'=>$loginID));
          }
        }

        

        $genInfo->redirect(BASE_URL.'user/verification?email-verified');
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    } 
  }
  //
  if(isset($_POST['phoneCode'])){
    $phoneCode = strip_tags($_POST['phoneCode']);
    
    //Php Validation
    if($phoneCode != $userInfo["sms_code"])  {
      $error[] = "Invalid Code! Please check verification code sent to your Phone.";  
    }else{
      try {
        $stmt = $genInfo->runQuery("UPDATE users 
          SET sms_verify=1, last_updated=:currentTime 
          WHERE login_id=:loginID");
        $stmt->execute(array(':loginID'=>$loginID, ':currentTime'=>$currentTime));

        //check if only SMS notification is enabled
        /*if((isset($configInfo['email_note']) */
//          AND $configInfo['email_note'] != 'Enabled')
          /*AND*/ /*(isset($configInfo['sms_note'])
          AND $configInfo['sms_note'] == 'Enabled')){

          //
          $stmt = $genInfo->runQuery("UPDATE users 
            SET status='Active' 
            WHERE login_id=:loginID");
          $stmt->execute(array(':loginID'=>$loginID));
        }*/
        /*else{
          if($userInfo["email_verify"] == 1){
            $stmt = $genInfo->runQuery("UPDATE users 
              SET status='Active' 
              WHERE login_id=:loginID");
            $stmt->execute(array(':loginID'=>$loginID));
          }
        }*/
        $genInfo->redirect(BASE_URL.'user/bank-details');
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    } 
  }

  $pageTitle = "Verification";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>
<link href="assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo BASE_URL;?>user/dashboard">Dashboard</a></li>
              <li class="active">Latest News</li>
          </ol>
        </div>  
    </div>
        
<div class="row">

  <?php
    if(isset($error)){
      foreach($error as $error){?>
       <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
       </div>
  <?php } } elseif(isset($_GET['email-verified'])){?>
       <div class="alert alert-success">
          <i class="fa fa-check-square"></i> &nbsp; Email Addres successfully verified!
       </div>
  <?php }elseif(isset($_GET['phone-verified'])){?>
       <div class="alert alert-success">
          <i class="fa fa-check-square"></i> &nbsp; Phone Number successfully verified!
       </div>
  <?php } ?>

  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#Profile" data-toggle="tab">Account Verification</a>
                </li>
            </ul>

            <div>
                <div class="tab-pane fade active in" id="Profile">
                  <div style="border:1px solid #FF6767;">
                    <div style="background: #FF6767; color: #FFF; padding: 10px">
                      <i class="fa fa-user"></i> Verification
                    </div>
                    <div style="padding: 5px">

          <div class="row">
<!--          --><?php //if(isset($configInfo['email_note'])
//                AND $configInfo['email_note'] == 'Enabled'){?>
<!--          <div class="col-md-6">-->
<!--            <form role="form" method="post" action="">-->
<!--            <div class="form-group">-->
<!--              <label for="email">Email Address-->
<!--                --><?php //if($userInfo["email_verify"] == 1){?>
<!--                  <span style="color:green; font-style:italic;">Verified</span>-->
<!--                --><?php //}else{?>
<!--                  <span style="color:red; font-style:italic;">Unverified</span>-->
<!--                --><?php //}?>
<!--              </label>-->
<!--              <input type="text" class="form-control" id="email" readonly  -->
<!--              value="--><?php //echo $userInfo["email"];?><!--">-->
<!--            </div>-->
<!--            --><?php //if($userInfo["email_verify"] != 1){?>
<!--            <div class="form-group">-->
<!--              <label for="emailCode">Enter verification code sent to your email</label>-->
<!--            <input type="text" class="form-control" id="emailCode" -->
<!--            name="emailCode" value="--><?php //if(isset($emailCode)){echo $emailCode;}?><!--">-->
<!--            </div>-->
<!---->
<!--            <button type="submit" class="btn btn-success btn-small">-->
<!--            Verify Email</button>-->
<!--            --><?php //}?>
<!--            </form>-->
<!--          </div>-->
<!--          --><?php //}?>

          <?php if(isset($configInfo['sms_note']) 
                AND $configInfo['sms_note'] == 'Enabled'){?>
          <div class="col-md-6">
            <form role="form" method="post" action="">
              <div class="form-group">
                <label for="phone">Phone
                <?php if($userInfo["sms_verify"] == 1){?>
                  <span style="color:green; font-style:italic;">Verified</span>
                <?php }else{?>
                  <span style="color:red; font-style:italic;">Unverified</span>
                <?php }?>
                </label>
                <input type="text" class="form-control" id="phone" readonly value="<?php echo $userInfo["phone"];?>">
              </div>
              <?php if($userInfo["sms_verify"] != 1){?>
              <div class="form-group">
                <label for="phoneCode">
                Enter verification code sent to your Phone</label>
                <input type="text" class="form-control" name="phoneCode" id="phoneCode" value="<?php if(isset($phoneCode)){echo $phoneCode;}?>">
              </div>

              <button type="submit" name="accountBtn" class="btn btn-success btn-small">Verify Phone</button>
              <?php }?>
          </form>
          </div>
          <?php }?>
        </div>
        <br><br>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
        
    </div> <!-- end col -->                
</div>

            
            
            

  </div> <!-- container -->
</div> <!-- content -->

<?php include(ROOT_PATH."user/includes/footer.php");?>
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

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>