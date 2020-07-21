<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php"); 
  require_once(ROOT_PATH . "core/session.php");
  require_once(ROOT_PATH . "user/includes/requiredActions.php");

  //Update Information
  if(isset($_POST['firstName'])) {
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $location = strip_tags($_POST['location']);
    $bio = strip_tags($_POST['bio']);

    if($firstName == "") {
      $error[] = 'Please enter your First Name!';
    }
    if($lastName == "") {
      $error[] = 'Please enter your Last Name!';
    }
    if($location == "") {
      $error[] = 'Please enter your Location!';
    }
    
    if(!isset($error)){
      try {
        $stmt = $genInfo->runQuery("UPDATE users 
          SET first_name=:firstName, last_name=:lastName, location=:location, bio=:bio
          WHERE login_id=:loginID");     
        $stmt->execute(array(':loginID'=>$loginID, ':firstName'=>$firstName, ':lastName'=>$lastName, ':location'=>$location, ':bio'=>$bio));
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'user/profile?updated');
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
          $stmt = $genInfo->runQuery("UPDATE users 
            SET password=:password 
            WHERE login_id=:loginID");     
          $stmt->execute(array(':loginID'=>$loginID, ':password'=>$new_password));

          $genInfo->redirect(BASE_URL.'user/logout');
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


   //Update Photo
  if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != "") {

    if($userInfo["photo"] != ''){
      $toDelete = ROOT_PATH.str_replace('../', '', $userInfo['photo']);
      if(file_exists($toDelete)){
        unlink($toDelete);
      }
    }

    $target_path = "../uploads/users/";
    $validextensions = array("jpeg", "jpg", "png");
    $ext = explode('.', basename($_FILES['photo']['name'])); 
    $file_extension = end($ext); 
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
    if (($_FILES["photo"]["size"] < 300000000)
    && in_array($file_extension, $validextensions)) {
      if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
        // Update
        $stmt = $genInfo->runQuery("UPDATE users 
          SET photo=:photo WHERE login_id=:loginID");
        $stmt->execute(array(':photo'=>$target_path, ':loginID'=>$loginID));

        
       $genInfo->redirect(BASE_URL.'user/profile?Uploaded');
        exit();
      } else {     //  If File Was Not Moved.
        $error[] = '). please try again!.<br/>';
      }
    } else {     //   If File Size And File Type Was Incorrect.
      $error[] = '). ***Invalid file Size or Type***<br/>';
    }     
  }

  $pageTitle = "Edit Profile";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
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
            <div class="col-sm-12">
                <div class="bg-picture text-center">
                    <div class="bg-picture-overlay"></div>
                    <div class="profile-info-name">
                        <?php if($userInfo['photo'] != ''){?>
                          <img src="<?php echo $userInfo['photo'];?>" 
                          alt="profile Photo" width="95" height="95">
                        <?php }else{?>
                          <i style="font-size:90px;" class="ti-user"></i> 
                        <?php }?>

                        <form role="form" method="post" action="" enctype="multipart/form-data"><br>
                          <label for="photo" class="btn btn-success btn-sm">Change Photo</label>
                          <input style="display:none" type="file" name="photo" id="photo" onchange="this.form.submit()";>
                        </form>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
    <div class="row">

    <div class="col-md-6">
    
    <form action="" method="post">
      <div class="card-box m-t-20">
      <h4 class="m-t-0 header-title"><b>Personal Information</b></h4>
      <div class="p-20">
        <div class="about-info-p">
          <strong>First Name</strong>
          <br>
           <div class="form-group">
            <input class="form-control" name="firstName" type="text" required value="<?php echo $userInfo['first_name'];?>">
          </div>
        </div>
        <div class="about-info-p">
          <strong>Last Name</strong>
          <br>
           <div class="form-group">
            <input class="form-control" name="lastName" type="text"
            required value="<?php echo $userInfo['last_name'];?>">
          </div>
        </div>
        <div class="about-info-p">
            <strong>Mobile</strong>
           <div class="form-group">
            <input class="form-control" type="text" name="phone" readonly value="<?php echo $userInfo['phone'];?>">
          </div>
        </div>
        <div class="about-info-p">
            <strong>Email</strong>
           <div class="form-group">
            <input class="form-control" type="text" name="email" readonly value="<?php echo $userInfo['email'];?>">
          </div>
        </div>
        <div class="about-info-p m-b-0">
            <strong>Location</strong>
            <br>
           <div class="form-group">
            <input class="form-control" type="text" name="location" value="<?php echo $userInfo['location'];?>">
          </div>
        </div>
      </div>
    </div>
    
    <!-- Personal-Information -->
    <div class="card-box">
      <h4 class="m-t-0 header-title"><b>Biography</b></h4>    
      <div class="p-20">
        <div class="form-group">
          <textarea class="form-control" name="bio"><?php echo nl2br($userInfo['bio']);?></textarea>
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