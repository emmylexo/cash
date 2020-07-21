<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  //incluse script run in related pages
  include(ROOT_PATH."administrator/includes/customersScript.php");

  $referrals = $adm->customerReferrals($uID);

  $pageTitle = "Admin: Customers";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'referral';

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
<link href="assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

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
                                    <li><a href="<?php echo BASE_URL;?>administrator/customers">Customers</a></li>
                                    <li class="active">
<?php echo '#'.$uID.' - '.$uInfo['first_name'].' '.$uInfo['last_name'];?></li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">

<?php include(ROOT_PATH."administrator/includes/customerNav.php");?>

<div class="table-responsive">
  <table class="table table-actions-bar">
      <thead>
          <tr>
              <th>#</th>
              <th></th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Signup Date</th>
              <th>Status</th>
              <th style="min-width: 80px;">Action</th>
          </tr>
      </thead>

      <tbody>
      <?php $i =0; 
            if(!empty($referrals)){
              foreach ($referrals as $ref) {
                $i++;?>
          <tr>
              <td><?php echo $i;?></td>
              <td><i style="font-size:30px" class="ti-user"></i></td>

              <td><?php echo $ref['first_name'];?></td>

              <td><?php echo $ref['last_name'];?></td>

              <td><?php echo $ref['gender'];?></td>

              <td><?php echo $ref['phone'];?></td>

              <td><?php echo strftime("%B %d, %Y", strtotime($ref["signup_date"]));?></td>
              <td><?php if($ref['status'] == 1){?>
                    <span class="label label-success">Active</span>
                  <?php }else{?>
                    <span class="label label-danger">Inactive</span>
                  <?php }?>
              </td>
              <td>
                <a href="<?php echo BASE_URL.'administrator/customer-summary?uid='.$ref['login_id'];?>" class="table-action-btn" title="View Profile">
                <i style="font-size:30px;" class="md md-visibility"></i></a></a>
              </td>
          </tr>
        <?php }}else{?>
          <tr>
            <td><p align="center">No record found</p></td>
          </tr>
        <?php }?>
      </tbody>
  </table>
</div>
                            </div>
                            </div> <!-- end col -->   
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