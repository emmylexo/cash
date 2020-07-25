<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  //incluse script run in related pages
  include(ROOT_PATH."administrator/includes/customersScript.php");

  $customerPHs = $adm->customerPHs($uID);

  //Delete  order
  if(isset($_GET['delid'])){
    $delID = intval($_GET['delid']);
    
    try {
      if($adm->orderDelete($delID)){ 
        $genInfo->redirect(BASE_URL.'administrator/orders?Deleted');
        exit();
      }
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }


  $pageTitle = "Admin: Orders";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'orders';

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
                                  <li><a href="<?php echo BASE_URL;?>administrator">
                                  Dashboard</a></li>            
                                  <li><a href="<?php echo BASE_URL;?>administrator/customers">
                                  Customers</a></li>
                                  <li class="active"><?php echo '#'.$uID.' - '.$uInfo['first_name'].' '.$uInfo['last_name'];?></li>
                              </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">

<?php include(ROOT_PATH."administrator/includes/customerNav.php");?>

<div class="table-responsive">
<?php if(!empty($customerPHs)){?>
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
        foreach ($customerPHs as $ph) {
          $i++;
          $sumPaidPHs = $adm->sum_paidPHs($ph['ph_id']);?>
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