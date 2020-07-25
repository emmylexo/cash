<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  $orders = $adm->recentOrders();
  //$products = $adm->recentProducts();
  $cntActive_users = $adm->cntActive_users();
  $sumAllPH = $adm->sumAllPH();
  $sumAllGH = $adm->sumAllGH();
  $allPHs = $adm->allPHs();
  $myGHs = $adm->myGHs();
  $vendor = $adm->vendor();
  //Check for online staffs
  $recentVisit = date('Y-m-d H:i:s',strtotime('-24 hours',strtotime(date("Y-m-d H:i:s"))));
  
  $todayVisitors = $adm->todayVisitors($recentVisit);
  $recentAdminAccess = $adm->recentAdminAccess();

  //Check for online staffs
  $activeTime = date('Y-m-d H:i:s',strtotime('-5 minutes',strtotime(date("Y-m-d H:i:s"))));
  $staffOnline = $adm->staffOnline($activeTime);

  $pageTitle = "Admin Dashboard";
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
      <div class="container">

          <!-- Page-Title -->
          <div class="row">
              <div class="col-sm-12">
                  <h4 class="page-title">Dashboard</h4>
                  <p class="text-muted page-title-alt">
                  Welcome to <?php echo $siteInfo['site_name'];?> 
                  admin panel !</p>
              </div>
          </div>

          <div class="row">

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-purple pull-left">
                          <i class="ti-user text-purple"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><b class="counter">
                          <?php echo number_format($cntActive_users);?></b></h3>
                          <p class="text-muted">Active Users</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>


              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box fadeInDown animated">
                      <div class="bg-icon bg-icon-pink pull-left">
                          <i class="text-pink" style="font-style:normal;"><?php echo $defaultCurrency['c_symbol'];?></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><b class="counter">
                          <?php echo number_format($sumAllPH);?></b></h3>
                          <p class="text-muted">Total PH</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-success pull-left">
                          <i class="text-success" style="font-style:normal;"><?php echo $defaultCurrency['c_symbol'];?></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><b class="counter">
                          <?php echo number_format($sumAllGH);?></b></h3>
                          <p class="text-muted">Total GH</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-info pull-left">
                          <i class="md md-remove-red-eye text-info"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><b class="counter">
                          <?php echo number_format($todayVisitors);?></b></h3>
                          <p class="text-muted">Today's Visits</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <!-- end row -->


<div class="row">
  <div class="col-lg-6">
  <div class="card-box">
          <a href="<?php echo BASE_URL;?>administrator/provide-help" class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
    <h4 class="text-dark header-title m-t-0">Recent Provide Help</h4>
    <p class="text-muted m-b-30 font-13"> - </p>

    <div class="table-responsive">
      <?php if(!empty($allPHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Paid</th>
        <th>Unpaid</th>
        <th>Status</th>
        <th style="min-width: 100px;">Last Modified</th>
        <th style="min-width: 10px;">Action</th>
      </tr>
    </thead>
    <tbody style="font-size:13px;">
  <?php foreach ($allPHs as $ph) {
          $sumPaidPHs = $adm->sum_paidPHs($ph['ph_id']);?>
      <tr>
        <td><?php echo $defaultCurrency['c_symbol'].number_format($ph['amount']);?></td> 

        <td><?php echo $defaultCurrency['c_symbol'].number_format($sumPaidPHs);?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format($ph['amount'] - $sumPaidPHs);?></td>

        <td><?php if($ph['amount'] == $sumPaidPHs){?>
            <span style="color: green">Fully Paid</span>
          <?php }elseif($sumPaidPHs > 0 AND $ph['amount'] > $sumPaidPHs){?>
            <span style="color: brown">Part Payment</span>
            <?php }else{?>
            <span style="color:red"><?php echo $ph['ph_status'];?></span>
            <?php }?>
        </td>
        <td><?php echo $genInfo->timeAgo($ph['last_modified']);?></td>
        <td><a title="View History" href="<?php echo BASE_URL.'administrator/ph-orders?phid='.$ph['ph_id'];?>" class="table-action-btn">
        <i class="ti ti-eye"></i></a></td>
      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>      
      <p>No record found!</p>
  <?php }?> 
  </div>

  </div>
</div>
<!-- end col -->

  <div class="col-lg-6">
    <div class="card-box">
            <a href="<?php echo BASE_URL;?>administrator/get-help" class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
      <h4 class="text-dark header-title m-t-0">Recent Get Help</h4>
      <p class="text-muted m-b-30 font-13"> - </p>

      <div class="table-responsive">
        <?php if(!empty($myGHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Recieved</th>
        <th>Balance</th>
        <th>Status</th>
        <th style="min-width: 100px;">Date</th>
        <th style="min-width: 10px;">Action</th>
      </tr>
    </thead>
    <tbody style="font-size:13px;">
  <?php $i=0;
        foreach ($myGHs as $gh) {
          $i++;
          $sumPaidGHs = $adm->sum_paidGHs($gh['gh_id']);?>
      <tr>
        <td><?php echo $defaultCurrency['c_symbol'].number_format($gh['g_amount']);?></td> 

        <td><?php echo $defaultCurrency['c_symbol'].number_format($sumPaidGHs);?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format($gh['g_amount'] - $sumPaidGHs);?></td>

        <td><?php if($gh['g_amount'] == $sumPaidGHs){?>
            <span style="color: green">Fully Paid</span>
          <?php }elseif($sumPaidGHs > 0 AND $gh['g_amount'] > $sumPaidGHs){?>
            <span style="color: brown">Part Payment</span>
            <?php }else{?>
            <span style="color:red">Awaiting Donor</span>
            <?php }?>
        </td>
        <td><?php echo strftime("%b %d, %Y %I:%M", strtotime($gh['req_date']));?></td>
        <td><a title="View History" href="<?php echo BASE_URL.'administrator/gh-orders?ghid='.$gh['gh_id'];?>" class="table-action-btn">
        <i class="ti ti-eye"></i></a></td>
      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>      
      <p>No record found!</p>
  <?php }?> 
    </div>

    </div>
  </div>
  <!-- end col -->
</div>
<!-- end row -->






<div class="row">
  <div class="col-lg-4">
    <div class="portlet"><!-- /primary heading -->
      <div class="portlet-heading">
        <h3 class="portlet-title text-dark text-uppercase">
          Staff Online
        </h3>
        <div class="portlet-widgets">
          <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
          <span class="divider"></span>
          <a data-toggle="collapse" data-parent="#staff" href="#staff"><i class="ion-minus-round"></i></a>
          <span class="divider"></span>
          <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div id="staff" class="panel-collapse collapse in">
        <div class="portlet-body" style="height: 210px;">
          <div class="table-responsive" style="max-height: 180px; overflow-y: scroll;">
            <table class="table table-actions-bar m-b-0">
                <tbody>
              <?php if(!empty($staffOnline)){
                  foreach ($staffOnline as $staff) {
                    $admPic = $adm->admInfoU($staff['admin']);?>
                  <tr>
                      <td>
                     <?php if($admPic['photo'] != ''){?>
                        <img src="<?php echo $admPic['photo'];?>" 
                        alt="profile Photo" class="thumb-sm pull-left m-r-10">
                      <?php }else{?>
                        <i style="font-size:25px;" class="ti-user"></i> 
                      <?php }?>
                      </td>

                      <td>
                      <div>
                        <?php echo $staff['admin'];?> <br>
                        <span class="text-muted m-b-30 font-13">
                          <?php echo $genInfo->timeAgo($staff['last_access']);?>
                        </span>
                        
                      </div>
                      </td>
                      
                  </tr>
              <?php }}?>                      
                </tbody>
            </table>
        </div>
        </div>
      </div>
    </div>
  </div> <!-- end col -->


  <div class="col-lg-8">
    <div class="portlet"><!-- /primary heading -->
      <div class="portlet-heading">
        <h3 class="portlet-title text-dark text-uppercase">
          Recent Admin Activity
        </h3>
        <div class="portlet-widgets">
          <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
          <span class="divider"></span>
          <a data-toggle="collapse" data-parent="#adminLogin" href="#adminLogin"><i class="ion-minus-round"></i></a>
          <span class="divider"></span>
          <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div id="adminLogin" class="panel-collapse collapse in">
        <div class="portlet-body" style="height: 210px;">         
        <div class="table-responsive" style="max-height: 180px; overflow-y: scroll;"><br>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Admin</th>
                <th>IP Address</th>
                <th>Browser</th>
                <th>OS</th>
                <th>Last Access</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recentAdminAccess)) {
                    foreach($recentAdminAccess as $AdminAccess) {?>
              <tr>
                <td><?php echo $AdminAccess["admin"];?></td>
                <td><?php echo $AdminAccess["ip"];?></td>
                <td><?php echo $AdminAccess["browser"];?></td>
                <td><?php echo $AdminAccess["os"];?></td>
                <td><?php echo $genInfo->timeAgo($AdminAccess["last_access"]);?></td>
              </tr>
              <?php }}?>

            </tbody>
          </table>
        </div>



        </div>
      </div>
    </div>
  </div> <!-- end col -->

</div> <!-- end row -->






<div class="row">
  <div class="col-lg-6">
    <div class="portlet"><!-- /primary heading -->
      <div class="portlet-heading">
        <h3 class="portlet-title text-dark text-uppercase">
          Vendor's Information
        </h3>
        <div class="portlet-widgets">
          <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
          <span class="divider"></span>
          <a data-toggle="collapse" data-parent="#vendor" href="#vendor"><i class="ion-minus-round"></i></a>
          <span class="divider"></span>
          <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div id="vendor" class="panel-collapse collapse in">
        <div class="portlet-body">
          <p><b>Developer:</b> <?php echo $vendor['name'];?>
          <hr style="margin: 0px 0px 10px;">
          <b>Website:</b> <a target="_blank" href="http://<?php echo $vendor['website'];?>"><?php echo $vendor['website'];?></a> 
          <hr style="margin: 20px 0px 10px;">
          <b>Date Released:</b> <?php echo strftime("%d/%m/%Y", strtotime($vendor["version_date"]));?>
          <hr style="margin: 20px 0px 10px;">
          <b>Current Version:</b> <?php echo $vendor['curr_version'];?></p>
        </div>
      </div>
    </div>
  </div> <!-- end col -->


  <div class="col-lg-6">
    <div class="portlet"><!-- /primary heading -->
      <div class="portlet-heading">
        <h3 class="portlet-title text-dark text-uppercase">
          Client's Information
        </h3>
        <div class="portlet-widgets">
          <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
          <span class="divider"></span>
          <a data-toggle="collapse" data-parent="#client" href="#client"><i class="ion-minus-round"></i></a>
          <span class="divider"></span>
          <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div id="client" class="panel-collapse collapse in">
        <div class="portlet-body">
          <p><b>Client Name:</b> <?php echo $siteInfo['site_name'];?>
          <hr style="margin: 0px 0px 10px;">
          <b>Server:</b> www.<?php echo $siteUrll;?>
          <hr style="margin: 20px 0px 10px;">

          <b>Server IP Address:</b> <?php echo gethostbyname($siteUrll);?>
          <hr style="margin: 20px 0px 10px;">
          <b>&nbsp;</b>
          </p>
        </div>
      </div>
    </div>
  </div> <!-- end col -->
  
</div> <!-- end row -->





    </div> <!-- container -->
</div> <!-- content -->
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

      <script src="assets/plugins/peity/jquery.peity.min.js"></script>

      <!-- jQuery  -->
      <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
      <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>



      <script src="assets/plugins/morris/morris.min.js"></script>
      <script src="assets/plugins/raphael/raphael-min.js"></script>

      <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

      <script src="assets/pages/jquery.dashboard.js"></script>

      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>

      <!-- Todojs  -->
      <script src="assets/pages/jquery.todo.js"></script>

      <!-- chatjs  -->
      <script src="assets/pages/jquery.chat.js"></script>

      <script type="text/javascript">
          jQuery(document).ready(function($) {
              $('.counter').counterUp({
                  delay: 100,
                  time: 1200
              });

              $(".knob").knob();

          });
      </script>
