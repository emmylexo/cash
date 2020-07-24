<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  if(isset($_GET['ghid']) AND $_GET['ghid'] != ''){
    $ghID = intval($_GET['ghid']);
  }else{
    $genInfo->redirect(BASE_URL.'administrator/get-help');
    exit();
  }

  $orders = $adm->myGHorders($ghID);
  
  $pageTitle = "GH Order History";
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
              <li><a href="<?php echo BASE_URL;?>administrator/dashboard">Dashboard</a></li>
              <li><a href="<?php echo BASE_URL;?>administrator/get-help">Get Help</a></li>
              <li class="active">Orders History</li>
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
  <?php } }elseif(isset($_GET['submitted'])){?>
   <div class="alert alert-success">
      <i class="fa fa-check-square"></i> &nbsp; Donate request submitted!
   </div>
  <?php }?>

  <div class="col-lg-12">
    <div class="card-box">

<div class="table-responsive">
<?php if(!empty($orders)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>#</th>
        <th>Payer</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date Assigned</th>
        <th>Date Paid</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php $i =0;
        foreach ($orders as $gh) {
          $i++;
          $payerInfo = $adm->userInfo($gh['payer_id']);?>
      <tr>  
        <td><?php echo $i;?></td>

        <td><?php echo $payerInfo['first_name'].' '.substr($payerInfo['last_name'], 0, 1);?>.</td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$gh['ord_amount'], 2, '.', ',');?></td>

        <td><?php if($gh['ord_status'] == 1){?>
            <span style="color:green;">Paid</span>
          <?php }else{?>
            <span style="color:red;">Unpaid</span>
          <?php }?>
        </td>
        <td><?php echo $genInfo->timeAgo($gh['ord_date']);?></td>
        <td><?php if($gh['date_paid'] != ''){?>
          <?php echo $genInfo->timeAgo($gh['date_paid']);?>
          <?php }else{echo '-';}?>
        </td>
        <td><a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'administrator/approve?ordid='.$gh['ord_id'] ?>">View Details</a> </td>
      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>      
      <p>No record found!</p>
  <?php }?>  
</div>
</div>
        
    </div> <!-- end col -->                
</div>

            
            
            

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


<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>