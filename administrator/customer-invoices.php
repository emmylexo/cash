<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  //incluse script run in related pages
  include(ROOT_PATH."administrator/includes/customersScript.php");

  $invoices = $adm->customerInvoices($uID);

  $pageTitle = "Admin: Invoices";
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
  <table class="table table-actions-bar">
      <thead>
        <tr>
            <th>Invoice #</th>
            <th>Invoice Date</th>
            <th>Date Paid</th>
            <th>Total</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th style="min-width: 80px;">Action</th>
        </tr>
      </thead>

      <tbody>
      <?php if(!empty($invoices)){
              foreach ($invoices as $invoice) {
                $inTotal = $adm->invoiceTotal($invoice['order_number']);
                $orderInfo = $adm->orderInfo($invoice['order_number']);?>
          <tr>
              <td><a href="<?php echo BASE_URL.'administrator/invoice-view?invid='.$invoice['invoice_id'];?>">
                <?php echo $invoice['invoice_id'];?></a></td>

              <td><?php echo strftime("%B %d, %Y", strtotime($invoice["invoice_date"]));?></td>

              <td><?php if($invoice['date_paid'] != ''){?>
                    <?php echo strftime("%B %d, %Y", strtotime($invoice["date_paid"]));?>
                  <?php }else{?>
                    -
                  <?php }?>                
              </td>

              <td><?php echo $defaultCurrency['c_symbol'].number_format($inTotal);?>
              </td>

              <td><?php echo $orderInfo['payment_method'];?></td>
              <td><?php if($invoice['invoice_status'] == '1'){?>
                    <span class="label label-success">Paid</span>

                  <?php }else{?>
                    <span class="label label-danger">Unpaid</span>
                  <?php }?>
              </td>
              <td>
                <a href="<?php echo BASE_URL.'administrator/invoice-view?ordnum='.$invoice['order_number'];?>" class="table-action-btn" title="View Invoice">
                <i class="md md-visibility"></i></a>
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