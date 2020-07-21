<?php 
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/backEnd-wrapper.php");
    //Privilege Settings
    $accounting = 'true';
    $editor = 'false';
    require_once(ROOT_PATH . "core/adminSession.php");

    //incluse script run in related pages
    include(ROOT_PATH."administrator/includes/customersScript.php");

    //Update Profile
    if(isset($_POST['fName'])){
        $fName = strip_tags($_POST['fName']);
        $lName = strip_tags($_POST['lName']);
        $gender = strip_tags($_POST['gender']);
        $email = strip_tags($_POST['email']);
        $phone = strip_tags($_POST['phone']); 
        $location = strip_tags($_POST['location']);
        
        try {
          if($adm->updateCustomerInfo($fName, $lName, $gender, $email, $phone, $location, $uID, $currentTime)){ 
            $genInfo->redirect(BASE_URL.'administrator/customer-profile?uid='.$uID.'&updated');
            exit();
          }
        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
    }

    $pageTitle = "Admin: Customer Profile";
    $pageDesc = "Description";
    $pageKeywords = "Keywords";
    $pageSec = 'profile';

    include(ROOT_PATH."administrator/includes/header.php"); 
    include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
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
            <li><a href="<?php echo BASE_URL;?>administrator">
            Dashboard</a></li>            
            <li><a href="<?php echo BASE_URL;?>administrator/customers">
            Customers</a></li>
            <li class="active"><?php echo '#'.$uID.' - '.$uInfo['first_name'].' '.$uInfo['last_name'];?></li>
        </ol>
    </div>
</div>



<div class="row">
<div class="col-sm-12">
  <?php
    if(isset($error)){
      foreach($error as $error){?>
       <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
       </div>
  <?php } }elseif(isset($_GET['updated'])){?>
       <div class="alert alert-success">
        <i class="fa fa-check-square"></i> &nbsp; Order Updated successfully!
       </div>
  <?php }elseif(isset($_GET['removed'])){?>
       <div class="alert alert-success">
        <i class="fa fa-check-square"></i> &nbsp; Item removed!
       </div>
  <?php }?>
<div class="card-box">
<?php include(ROOT_PATH."administrator/includes/customerNav.php");?>

<form method="post" action="">
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box" style="background:#F8F8F8;">
                <div class="form-group m-b-20">
                    <label for="fName">First Name</label>
                    <input type="text" class="form-control"
                    name="fName" id="fName" value="<?php if(isset($fName)){echo $fName;}else{echo $uInfo['first_name'];}?>">
                </div>

                <div class="form-group m-b-20">
                    <label for="lName">Last Name</label>
                    <input type="text" class="form-control"
                    name="lName" id="lName" value="<?php if(isset($lName)){echo $lName;}else{echo $uInfo['last_name'];}?>">
                </div>

                <div class="form-group m-b-20">
                    <label for="gender">Gender</label>
                    <select class="form-control select2" name="gender" id="gender">
                        <?php if(isset($gender)){?>
                            <option value="<?php echo $gender;?>">
                            <?php echo $gender;?></option>
                        <?php }else{?>
                            <option value="<?php echo $uInfo['gender'];?>">
                            <?php echo $uInfo['gender'];?></option>
                        <?php }?>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group m-b-20">
                    <label for="email">Email</label>
                    <input type="email" class="form-control"
                    name="email" id="email" value="<?php if(isset($email)){echo $email;}else{echo $uInfo['email'];}?>">
                </div>

                <div class="form-group m-b-20">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control"
                    name="phone" id="phone" value="<?php if(isset($phone)){echo $phone;}else{echo $uInfo['phone'];}?>">
                </div>

            </div>
        </div>


        <div class="col-lg-6">
            <div class="card-box" style="background:#F8F8F8;">
               <div class="form-group m-b-20">
                    <label for="location">Location</label>
                    <input type="text" class="form-control"
                    name="location" id="location" value="<?php if(isset($location)){echo $location;}else{echo $uInfo['location'];}?>">
                </div>

                

            </div>
        </div>

            
        </div>


    </div>


    <div class="row">
        <div class="col-sm-12">
            <hr />
            <div class="text-center p-20">
                <a class="btn w-sm btn-white waves-effect" href="<?php echo BASE_URL.'administrator/customer-summary?uid='.$uID;?>">Go Back</a>

                 <button type="submit" class="btn w-sm btn-default waves-effect waves-light">Save Changes</button>

            </div>
        </div>
    </div>
</form>
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

        <script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>

        <script>
            jQuery(document).ready(function() {
                // Select2
                $(".select2").select2();
            });
        </script>




    </body>
</html>