<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");  
  //Privilege Settings
  $accounting = 'false';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  $administrators = $adm->administrators();

  if(isset($_POST['role'])){
    $role = strip_tags($_POST['role']);
    $username = strip_tags($_POST['username']);
    $fullName = strip_tags($_POST['fullName']); 
    $phone = strip_tags($_POST['phone']);
    $password = strip_tags($_POST['password']);
    $email = strip_tags($_POST['email']);
    $address = strip_tags($_POST['address']);
    $city = strip_tags($_POST['city']);
    $state = strip_tags($_POST['state']);
    $country = strip_tags($_POST['country']);
    
    //Php Validation
    if($role == "") {
      $error[] = "Please select Admin Role!"; 
    }
    elseif($username == "")  {
      $error[] = "Please choose Username!"; 
    }
    elseif($fullName == "")  {
      $error[] = "Please enter Full Name!"; 
    }
    elseif($phone == "")  {
      $error[] = "Your Phone Number is required!"; 
    }
    elseif($email == "")  {
      $error[] = "Your Email Address is required!"; 
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
    }
    else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters"; 
    }  
    else{
      try {
        $stmt = $genInfo->runQuery("SELECT * FROM admin 
          WHERE email=:email OR username=:username");
        $stmt->execute(array(':email'=>$email, ':username'=>$username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['email'] == $email) {
          $error[] = "Sorry, Email Address already in use in the system!";
        }
        elseif($row['username'] == $username){
          $error[] = "Sorry, Username already in use in the system!";
        }
        else{
          if($adm->addAdmin($role, $username, $fullName, $phone, $password, $email, $address, $city, $state, $country, $currentTime)){ 
            $genInfo->redirect(BASE_URL.'administrator/admin-manager?added');
            exit();
          }
        }
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    } 
  }

  //Send delete warning
  if(isset($_GET['delete']) AND $_GET['un'] != ''){
    $genInfo->redirect(BASE_URL.'administrator/admin-manager?un='.$_GET['un'].'&warning');
    exit();
  }

  //Delete from table
  if(isset($_GET['true']) AND $_GET['un'] != ''){
    $admUsername = strip_tags($_GET['un']);
    try {
      $stmt = $genInfo->runQuery("DELETE FROM admin 
        WHERE username=:username AND NOT username='administrator'");
      $stmt->execute(array(':username'=>$admUsername));
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/admin-manager?Deleted');
    exit();
  }


  $pageTitle = "Manage Admins";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'addresses';

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
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
              <li><a href="<?php echo BASE_URL;?>administrator">Dashboard</a></li>
              <li class="active">Admin Manager</li>
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
  <?php } }elseif(isset($_GET['added'])){?>
   <div class="alert alert-success">
      <i class="fa fa-check-square"></i> &nbsp; Admin role added successfully!
   </div>
  <?php }elseif(isset($_GET['warning']) AND $_GET['un'] != ''){?>
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you really want to delete this Admin User: 
        <b><?php echo $_GET['un'];?></b>? 
        <a href="<?php echo BASE_URL.'administrator/admin-manager?un='.$_GET['un'].'&true';?>">Yes</a> | 

        <a href="<?php echo BASE_URL.'administrator/admin-manager';?>">No</a>
     </div>
  <?php }?>

  <div class="col-lg-12">
    <div class="card-box">
<div class="row">
  <div class="col-sm-8">
    <form role="form" action="" method="get">
      <div class="form-group contact-search m-b-30">
        <input type="text" id="search" class="form-control" 
        placeholder="Search...">
          <button type="submit" class="btn btn-white">
          <i class="fa fa-search"></i></button>
      </div> <!-- form-group -->
  </form>
  </div>
  <div class="col-sm-4">
     <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Add New Admin</a>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th></th>
        <th>Role</th>
        <th>Username</th>
        <th>Email</th>
        <th>Last Login</th>
        <th>Date Added</th>
        <th>Status</th>
        <th style="min-width: 90px;">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php if(!empty($administrators)){
          foreach ($administrators as $admin) {?>
      <tr <?php if($admin['role'] == 'Administrator'){echo 'class="active"';}?>>  
        <td>
          <?php if($admin['photo'] != ''){?>
            <img src="<?php echo $admin['photo'];?>" 
            alt="profile Photo" class="img-circle thumb-sm">
          <?php }else{?>
            <i style="font-size:25px;" class="ti-user"></i> 
          <?php }?>
        </td>        
        <td><?php echo $admin['role'];?></td>        
        <td><?php echo $admin['username'];?></td>
        <td><?php echo $admin['email'];?></td>
        <td><?php echo $genInfo->timeAgo($admin['last_login']);?></td>
        <td><?php echo strftime("%B %d, %Y", strtotime($admin['date_added']));?></td>
        <td><?php if($admin['status'] == 1){?>
              <span style="color:#009966">Active</span>
            <?php }else{?>
              <span style="color:#660000">Inactive</span>
            <?php }?>
        </td>
        <td><?php if($admin['role'] != 'Administrator'){?>
          <a href="<?php echo BASE_URL.'administrator/admin-manager-edit?admid='.$admin['id'];?>" class="table-action-btn"><i class="md md-edit"></i></a>

          <a href="<?php echo BASE_URL.'administrator/admin-manager?un='.$admin['username'].'&delete';?>" class="table-action-btn"><i class="md md-close"></i></a>
          <?php }?>
        </td>
      </tr>
      <?php }}?>      
    </tbody>
  </table>
</div>
</div>
        
    </div> <!-- end col -->                
</div>

            
            
            

  </div> <!-- container -->
</div> <!-- content -->
<!-- Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Admin</h4>
    <div class="custom-modal-text text-left">
        <form role="form" action="" method="post">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="role">Admin Role</label>
                <select class="form-control" name="role" id="role" required>
                  <?php if(isset($role)){?>
                    <option value="<?php echo $role;?>">
                    <?php echo $role;?></option>
                  <?php }?>
                  <option value="">---Select---</option>
                  <option value="Accounting">Accounting</option>
                  <option value="Editor">Editor</option>
                </select>
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Enter username" id="username" name="username" required
                value="<?php if(isset($username)){echo $username;}?>">
              </div>

              <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" 
                placeholder="Enter name" required name="fullName"
                value="<?php if(isset($fullName)){echo $fullName;}?>">
              </div>

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" 
                placeholder="Enter phone" required name="phone"
                value="<?php if(isset($phone)){echo $phone;}?>">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" 
                placeholder="Enter password" required name="password"
                value="<?php if(isset($password)){echo $password;}?>">
              </div>

            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" 
                placeholder="Enter email" required name="email"
                value="<?php if(isset($email)){echo $email;}?>">
              </div>
                      
              <div class="form-group">
                  <label for="address">Office Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required
                  value="<?php if(isset($address)){echo $address;}?>">
              </div>

              <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required 
                  value="<?php if(isset($city)){echo $city;}?>">
              </div>
                      
              <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" required
                  value="<?php if(isset($state)){echo $state;}?>">
              </div>

              <div class="form-group">
               <label for="country">Country</label>
                <select class="form-control" name="country" id="country" required>
                  <?php if(isset($country)){?>
                    <option value="<?php echo $country;?>">
                    <?php echo $country;?></option>
                  <?php }?>
                  <option value="">---Select---</option>
                  <?php include(ROOT_PATH."includes/countries.php");?>
                </select>
              </div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-default waves-effect waves-light">Add Admin</button>

          <button type="reset" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">Cancel</button>
        </form>
    </div>
</div>
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