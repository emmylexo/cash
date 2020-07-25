<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php"); 
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  //Update Information
  if(isset($_POST['email'])) {
    $email = strip_tags($_POST['email']);
    $phone = strip_tags($_POST['phone']);
    $bio = strip_tags($_POST['bio']);

    if($email == "") {
      $error[] = 'Please enter a valid Email Address!';
    }
    elseif($phone == ""){
      $error[] = 'Please enter Phone Number!';
    }
    else{
      try {
        $stmt = $genInfo->runQuery("UPDATE admin 
          SET email=:email, phone=:phone, bio=:bio
          WHERE id=:admID");     
        $stmt->execute(array(':admID'=>$admInfo['id'], ':email'=>$email, ':phone'=>$phone, ':bio'=>$bio));

        //INSERT NOTIFICATION TABLE
        $userActn = $admInfo['username'].' has updated his profile information!';
        $actUrl = 'admin-profile?admu='.$admInfo['username'];
        $stmt = $genInfo->runQuery("INSERT INTO notifications (admin, action, type, action_url, date_added)
          VALUES (:userName, :userActn, 'Profile Update', :actUrl, :currentTime)");

        $stmt->execute(array(':userName'=>$admInfo['username'], ':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/admin-profile-edit?updated');
      exit();
    }
  }

  //Change password
  if(isset($_POST['currentPass'])) {
    $currentPass = strip_tags($_POST['currentPass']);
    $newPass = strip_tags($_POST['newPass']);
    $confirmPass = strip_tags($_POST['confirmPass']);

    if($currentPass == "") {
      $error[] = 'Please enter your Current Password!';
    }
    elseif($newPass == ""){
      $error[] = 'Please enter a New Password!';
    }
    elseif(strlen($newPass) < 6){
      $error[] = "Password must be atleast 6 characters"; 
    }
    elseif($confirmPass != $newPass)  {
      $error[] = "Password does not match, please try again!";
    }
    else{
      try {
        //Verify current Password
        if(password_verify($currentPass, $admInfo['password'])){
          $new_password = password_hash($newPass, PASSWORD_DEFAULT);
          //Update new password
          $stmt = $genInfo->runQuery("UPDATE admin 
            SET password=:password WHERE id=:admID");     
          $stmt->execute(array(':admID'=>$admInfo['id'], ':password'=>$new_password));

          //INSERT NOTIFICATION TABLE
          $userActn = $admInfo['username'].' has changed his account password!';
          $actUrl = 'admin-profile?admu='.$admInfo['username'];
          $stmt = $genInfo->runQuery("INSERT INTO notifications (admin, action, type, action_url, date_added)
            VALUES (:userName, :userActn, 'Change of Password', :actUrl, :currentTime)");

          $stmt->execute(array(':userName'=>$admInfo['username'], ':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));

          $genInfo->redirect(BASE_URL.'administrator/logout');
          exit();
        }
        else{
          $error[] = "Incorrect Current Password, please try again!";
        }        
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  $pageTitle = "Edit Admin Profile";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
  <!-- Start content -->
  <div class="content">

    <div class="wraper container-fluid">
        <?php
            if(isset($error)){
                foreach($error as $error){?>
                 <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                 </div>
        <?php } }elseif(isset($_GET['updated'])){?>
         <div class="alert alert-success">
            <i class="fa fa-check-square"></i> &nbsp; Profile is updated successfully!
         </div>
    <?php }?>
    <div class="row">

    <div class="col-md-6">
    
    <form action="" method="post">
      <div class="card-box m-t-20">
      <h4 class="m-t-0 header-title"><b>Personal Information</b></h4>
      <div class="p-20">
        <div class="about-info-p">
          <strong>Username</strong>
          <br>
           <div class="form-group">
            <input class="form-control" type="text"
            readonly value="<?php echo $admInfo['username'];?>">
          </div>

        </div>
        <div class="about-info-p">
          <strong>Full Name</strong>
          <br>
           <div class="form-group">
            <input class="form-control" type="text"
            readonly value="<?php echo $admInfo['full_name'];?>">
          </div>

        </div>
        <div class="about-info-p">
            <strong>Mobile</strong>
           <div class="form-group">
            <input class="form-control" type="text" name="phone"
            value="<?php echo $admInfo['phone'];?>">
          </div>
        </div>
        <div class="about-info-p">
            <strong>Email</strong>
           <div class="form-group">
            <input class="form-control" type="text" name="email"
            value="<?php echo $admInfo['email'];?>">
          </div>
        </div>
        <div class="about-info-p m-b-0">
            <strong>Location</strong>
            <br>
           <div class="form-group">
            <input class="form-control" type="text" readonly value="<?php echo $admInfo['state'].' '.$admInfo['country'];?>">
          </div>
        </div>
      </div>
    </div>
    
    <!-- Personal-Information -->
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Biography</b></h4>    
      <div class="p-20">
        <div class="form-group">
          <textarea class="form-control" name="bio"><?php echo nl2br($admInfo['bio']);?></textarea>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-sm">
        Update Information</button>
      </div>
    </div>
    <!-- Personal-Information -->
    
</form>
 </div>


 <div class="col-md-6">
  <div class="card-box m-t-20">
    <h4 class="m-t-0 header-title"><b>Change Password</b></h4>
    <div class="p-20">
      <form action="" method="post">
        <div class="form-group">
          <input class="form-control" type="password" name="currentPass" placeholder="Enter Current Password">
        </div>

        <div class="form-group">
          <input class="form-control" type="password" name="newPass" placeholder="Enter New Password">
        </div>

        <div class="form-group">
          <input class="form-control" type="password" name="confirmPass" placeholder="Confirm New Password">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-sm">
          Change Password</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</div> <!-- container -->
               
</div> <!-- content -->

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<?php include(ROOT_PATH."administrator/includes/footer.php");?>
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