<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'false';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  if(isset($_GET['admid']) AND $_GET['admid'] != '') {
    $admID = intval($_GET['admid']);
  }
  else{
    $genInfo->redirect(BASE_URL.'administrator/admin-manager');
    exit();
  }

  $admin = $adm->admInfo($admID);

  if(empty($admin)){
    $genInfo->redirect(BASE_URL.'administrator/admin-manager');
    exit();
  }

  //Update Information
  if(isset($_POST['role'])) {
    $role = strip_tags($_POST['role']);
    $fullName = strip_tags($_POST['fullName']);
    $phone = strip_tags($_POST['phone']);
    $bio = strip_tags($_POST['bio']);
    $email = strip_tags($_POST['email']);
    $address = strip_tags($_POST['address']);
    $city = strip_tags($_POST['city']);
    $state = strip_tags($_POST['state']);
    $country = strip_tags($_POST['country']);

    if($email == "") {
      $error[] = 'Please enter a valid Email Address!';
    }
    elseif($phone == ""){
      $error[] = 'Please enter Phone Number!';
    }
    elseif($role == ""){
      $error[] = 'Please select Admin Role!';
    }
    else{
      try {
        $stmt = $genInfo->runQuery("UPDATE admin 
          SET role=:role, 
            full_name=:fullName, 
            phone=:phone, 
            email=:email, 
            address=:address, 
            city=:city, 
            state=:state, 
            country=:country,
            bio=:bio
          WHERE id=:admID");     
        $stmt->execute(array(':admID'=>$admID, ':role'=>$role, ':fullName'=>$fullName, ':phone'=>$phone, ':email'=>$email, ':address'=>$address, ':city'=>$city, ':state'=>$state, ':country'=>$country, ':bio'=>$bio));
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/admin-manager-edit?admid='.$admID.'&updated');
      exit();
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
    <form action="" method="post">
    <br>
    <h4 class="m-t-0 header-title" align="center">
    <b>Admin Information</b></h4>
    <div class="col-md-6">
      <div class="card-box m-t-20">
      <div class="p-20">
        <div class="about-info-p">
          <strong>Username</strong>
          <br>
           <div class="form-group">
            <input class="form-control" type="text"
            readonly value="<?php echo $admin['username'];?>">
          </div>

        </div>
        <div class="about-info-p">
          <div class="form-group">
            <label for="role">Admin Role</label>
            <select class="form-control" name="role" id="role" required>
              <?php if(isset($role)){?>
                <option value="<?php echo $role;?>">
                <?php echo $role;?></option>
              <?php }else{?>
              <option value="<?php echo $admin['role'];?>">
              <?php echo $admin['role'];?></option>
              <?php }?>
              <option value="">---Select---</option>
              <option value="Accounting">Accounting</option>
              <option value="Editor">Editor</option>
            </select>
          </div>
        </div>
        <div class="about-info-p">
          <strong>Full Name</strong>
          <br>
           <div class="form-group">
            <input class="form-control" type="text" name="fullName"
             value="<?php echo $admin['full_name'];?>">
          </div>

        </div>
        <div class="about-info-p">
            <strong>Phone</strong>
           <div class="form-group">
            <input class="form-control" type="text" name="phone"
            value="<?php echo $admin['phone'];?>">
          </div>
        </div>

        <div class="about-info-p">
          <div class="form-group">
              <textarea class="form-control" name="bio"><?php echo nl2br($admin['bio']);?></textarea>
            </div>
        </div>
        
      </div>
    </div>
 </div>


 <div class="col-md-6">
  <div class="card-box m-t-20">
    <div class="p-20">
        <div class="about-info-p">
              <strong>Email</strong>
             <div class="form-group">
              <input class="form-control" type="text" name="email"
              value="<?php echo $admin['email'];?>">
            </div>
        </div>
        <div class="about-info-p m-b-0">
            <strong>Address</strong>
            <br>
           <div class="form-group">
            <input class="form-control" type="text" name="address"
            value="<?php echo $admin['address'];?>">
          </div>
        </div>

        <div class="about-info-p m-b-0">
            <strong>City</strong>
            <br>
           <div class="form-group">
            <input class="form-control" type="text" name="city"
            value="<?php echo $admin['city'];?>">
          </div>
        </div>

        <div class="about-info-p m-b-0">
            <strong>State</strong>
            <br>
           <div class="form-group">
            <input class="form-control" type="text" name="state"
            value="<?php echo $admin['state'];?>">
          </div>
        </div>

        <div class="about-info-p m-b-0">
          <div class="form-group">
           <label for="country">Country</label>
            <select class="form-control" name="country" id="country" required>
              <?php if(isset($country)){?>
                <option value="<?php echo $country;?>">
                <?php echo $country;?></option>
              <?php }else{?>
                <option value="<?php echo $admin['country'];?>">
                <?php echo $admin['country'];?></option>
              <?php }?>
              <option value="">---Select---</option>
              <?php include(ROOT_PATH."includes/countries.php");?>
            </select>
          </div>
        </div>

    </div>
  </div>
  </div>
  <div class="clearfix"></div>
  <hr>
  <div align="center">
    <button type="submit" class="btn btn-default waves-effect waves-light">Update Information</button>
  </div>
  </form>
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