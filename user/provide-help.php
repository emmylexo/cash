<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");  
  require_once(ROOT_PATH . "core/session.php");
  require_once(ROOT_PATH . "user/includes/requiredActions.php");
  $myPHs = $front->myPHs($loginID);
  $countPHs = $front->countPHs($loginID);
  
  $pageTitle = "Provide Help Request";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'addresses';

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
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo BASE_URL;?>user/dashboard">Dashboard</a></li>
              <li class="active">Provide Help Request</li>
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
      <i class="fa fa-check-square"></i> &nbsp; PH request submitted!
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
     <a href="<?php echo BASE_URL?>user/packages" class="btn btn-default btn-md waves-effect waves-light m-b-30"  data-overlayColor="#36404a"><i class="md md-add"></i> Make PH Request</a>
  </div>
</div>
<div class="table-responsive">
<?php if(!empty($myPHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th></th>
        <th>PH Amount</th>
        <th>Paid</th>
        <th>Unpaid</th>
        <th>Status</th>
        <th>Last Modified</th>
        <th style="min-width: 90px;">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php $i=0;
        foreach ($myPHs as $ph) {
          $i++;
          $sumPaidPHs = $front->sum_paidPHs($ph['ph_id']);?>
      <tr>  
        <td><?php echo $i; ?></td>
        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['amount'], 2, '.', ',');?></td> 

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$sumPaidPHs, 2, '.', ',');?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['amount'] - $sumPaidPHs, 2, '.', ',');?></td>

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
  <?php }?> 
</div>
</div>
        
    </div> <!-- end col -->                
</div>

            
            
            

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


<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>