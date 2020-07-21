<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");
  require_once(ROOT_PATH . "user/includes/requiredActions.php");

  $myGHs = $front->myGHs($loginID);
  $myPHs = $front->myPHs($loginID);
  $sumPHs = $front->sumPHs($loginID);
  $sumGHs = $front->sumGHs($loginID);
  $sumRef = $front->sumRef($loginID);
  $newsUnread = $front->newsUnread($loginID);

  $sumAllScore = $front->sumAllScore($loginID);
  $allScoreValue = $sumAllScore * $configInfo['creditbility'] / 100;
  
  $pageTitle = "User Dashboard";
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
        <?php include(ROOT_PATH."user/includes/newsNotification.php");?>
        <?php include(ROOT_PATH."user/includes/actionNotification.php");?>
          <!-- Page-Title -->
          <div class="row">
          
              <div class="col-sm-12">
                  <h4 class="page-title">Dashboard</h4>
                  <p class="text-muted page-title-alt">
                  Welcome to <?php echo $siteInfo['site_name'];?> 
                  user dashboard! 
                  <span style="color:red;" class="pull-right">Your Referral Link: <?php echo $siteInfo['site_url'].'/?ref_id='.$userInfo['email'];?></span></p>
              </div>
          </div>

          <div class="row">

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-purple pull-left">
                          <i class="ti-cup text-purple"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><?php echo $defaultCurrency['c_symbol'];?><b class="counter">
                          <?php echo number_format($allScoreValue);?></b></h3>
                          <p class="text-muted">Credibility  Value</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-info pull-left">
                          <i class="ti-crown text-info"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><?php echo $defaultCurrency['c_symbol'];?><b class="counter">
                          <?php echo number_format($sumRef);?></b></h3>
                          <p class="text-muted">Referral Credit</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box">
                      <div class="bg-icon bg-icon-pink pull-left">
                        <i class="ti-filter text-pink"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><?php echo $defaultCurrency['c_symbol'];?><b class="counter">
                          <?php echo number_format($sumPHs);?></b></h3>
                          <p class="text-muted">Total PH</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3">
                  <div class="widget-bg-color-icon card-box fadeInDown animated">
                      <div class="bg-icon bg-icon-success pull-left">
                        <i class="ti-gift text-success"></i>
                      </div>
                      <div class="text-right">
                          <h3 class="text-dark"><?php echo $defaultCurrency['c_symbol'];?><b class="counter">
                          <?php echo number_format($sumGHs);?></b></h3>
                          <p class="text-muted">Total GH</p>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>

          </div>
          <!-- end row -->


<div class="row">
  <div class="col-lg-6">
  <div class="card-box">
          <a href="<?php echo BASE_URL;?>user/provide-help" class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
    <h4 class="text-dark header-title m-t-0">Recent Provide Help</h4>
    <p class="text-muted m-b-30 font-13"> - </p>

    <div class="table-responsive">
      <?php if(!empty($myPHs)){?>
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
  <?php foreach ($myPHs as $ph) {
          $sumPaidPHs = $front->sum_paidPHs($ph['ph_id']);?>
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
        <td><a title="View History" href="<?php echo BASE_URL.'user/ph-orders?phid='.$ph['ph_id'];?>" class="table-action-btn">
        <i class="ti ti-eye"></i></a></td>
      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>      
      <p>No record found!</p>
      <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Make PH Request</a>
  <?php }?> 
  </div>

  </div>
</div>
<!-- end col -->

  <div class="col-lg-6">
  	<div class="card-box">
            <a href="<?php echo BASE_URL;?>user/get-help" class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
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
          $sumPaidGHs = $front->sum_paidGHs($gh['gh_id']);?>
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
        <td><a title="View History" href="<?php echo BASE_URL.'user/gh-orders?ghid='.$gh['gh_id'];?>" class="table-action-btn">
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

</div> <!-- end row -->



    </div> <!-- container -->
</div> <!-- content -->
<?php include(ROOT_PATH."user/includes/ph-request.php");?>

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
<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>
