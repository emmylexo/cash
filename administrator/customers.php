<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  $customers = $adm->customers();

  $pageTitle = "Admin: Customers";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

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
                                    <li class="active">All Customers</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">
                              
<div class="row m-t-10 m-b-10">
  <div class="col-sm-6 col-lg-8">
    <form role="form">
            <div class="form-group contact-search m-b-30">
              <input type="text" id="search" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
            </div> <!-- form-group -->
        </form>
  </div>

          <div class="col-sm-6 col-lg-4">
              <div class="h5 m-0">
                  <span class="vertical-middle">Sort By:</span>
                  <div class="btn-group vertical-middle" data-toggle="buttons">
                       <label class="btn btn-white btn-md waves-effect active">
                          <input type="radio" autocomplete="off" checked=""> Status
                       </label>
                       <label class="btn btn-white btn-md waves-effect">
                          <input type="radio" autocomplete="off"> Type
                       </label>
                       <label class="btn btn-white btn-md waves-effect">
                          <input type="radio" autocomplete="off"> Name
                       </label>
                  </div>
              </div>
          </div>
</div>

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
              <th style="min-width: 50px;">Action</th>
          </tr>
      </thead>

      <tbody>
      <?php $i =0; 
            if(!empty($customers)){
              foreach ($customers as $customer) {
                $i++;?>
          <tr>
              <td><?php echo $i;?></td>
              <td><i style="font-size:30px" class="ti-user"></i></td>

              <td><?php echo $customer['first_name'];?></td>

              <td><?php echo $customer['last_name'];?></td>

              <td><?php echo $customer['gender'];?></td>

              <td><?php echo $customer['phone'];?></td>

              <td><?php echo strftime("%B %d, %Y", strtotime($customer["signup_date"]));?></td>
              <td><?php if($customer['status'] == 1 
                      OR $customer['status'] == 'Active'){?>
                    <span class="label label-success">Active</span>
                  <?php }else{?>
                    <span class="label label-danger"><?php echo $customer['status'];?></span>
                  <?php }?>
              </td>
              <td>
                <a href="<?php echo BASE_URL.'administrator/customer-summary?uid='.$customer['login_id'];?>" class="table-action-btn"><i class="md md-edit"></i></a>

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