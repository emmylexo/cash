<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");  
  require_once(ROOT_PATH . "core/session.php");
  require_once(ROOT_PATH . "user/includes/requiredActions.php");

  $myGHs = $front->myGHs($loginID);
  $myPHs = $front->myPHs($loginID);
  $countPHs = $front->countPHs($loginID);

  //
  if(isset($_POST['ghRequest'])){
    $phID = intval($_POST['phID']);

    $ph = $front->myPHsingle($phID);

    //Php Validation
    if($ph["amount"] > $ph["paid"]) {
      $error[] = "PH Still maturing...!"; 
    }

    if($ph["gh_status"] == 1) {
      $error[] = "You can not make GH request twice!";
    }

    if(!isset($bankInfo['bank']) OR $bankInfo['bank'] == ''){
      $genInfo->redirect(BASE_URL.'user/bank-details');
      exit();
    }

    //Now check for recommitment
    $recomitInfo = $front->recommitChks($loginID, $ph["ph_id"]);
    $rcomitAmt = ($recomitInfo['amount'] * $configInfo['recommit_perc']) / 100;

    if(!$recomitInfo['paid'] >= $rcomitAmt){
      $error[] = "Oops! ".$configInfo['recommit_perc']."% recommitment payment is required to enable you make a successful GH request! <a href='".BASE_URL."user/packages'>Click here</a> to recommit.";
    }


    if(!isset($error) AND $ph['gh_status'] != 1){
      try {
        $stmt = $genInfo->runQuery("INSERT INTO get_help(
          login_id, g_amount, g_status, req_date)

          VALUES(:loginID, :amount, 'Pending', :currentTime)");
      
        $stmt->execute(array(':loginID'=>$loginID, ':amount'=>$ph['request_amt'], ':currentTime'=>$currentTime));

        //update
        $stmt = $genInfo->runQuery("UPDATE provide_help 
          SET gh_status=1 WHERE ph_id=:phID");      
        $stmt->execute(array(':phID'=>$ph['ph_id']));

        //
        $genInfo->redirect(BASE_URL.'user/get-help?submitted');
        exit();
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  $pageTitle = "Get Help";
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
              <li class="active">Get Help</li>
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
      <i class="fa fa-check-square"></i> &nbsp; GH request Sent!
   </div>
  <?php } if(isset($_GET['recommit'])){?>
   <div class="alert alert-success" style="color:green">
      <i class="fa fa-check-square"></i> &nbsp; <b>Good News!</b> <?php echo $defaultCurrency['c_symbol'].number_format($_GET['recommit']); ?> has been recommited from your expected GH Amount.
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
     <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Make GH Request</a>
  </div>
</div>
<div class="table-responsive">
<?php if(!empty($myGHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>#</th>
        <th>GH Amount</th>
        <th>Recieved</th>
        <th>Balance</th>
        <th>Status</th>
        <th>Request Date</th>
        <th style="min-width: 90px;">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php $i=0;
        foreach ($myGHs as $gh) {
          $i++;
          $sumPaidGHs = $front->sum_paidGHs($gh['gh_id']);?>
      <tr>  
        <td><?php echo $i; ?></td>
        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$gh['g_amount'], 2, '.', ',');?></td> 

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$sumPaidGHs, 2, '.', ',');?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$gh['g_amount'] - $sumPaidGHs, 2, '.', ',');?></td>

        <td><?php if($gh['g_amount'] == $sumPaidGHs){?>
            <span style="color: green">Fully Paid</span>
          <?php }elseif($sumPaidGHs > 0 AND $gh['g_amount'] > $sumPaidGHs){?>
            <span style="color: brown">Part Payment</span>
            <?php }else{?>
            <span style="color:red">Awaiting Donor</span>
            <?php }?>
        </td>
        <td><?php echo $genInfo->timeAgo($gh['req_date']);?></td>
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
        
    </div> <!-- end col -->                
</div>

            
            
            

  </div> <!-- container -->
</div> <!-- content -->
<?php include(ROOT_PATH."user/includes/gh-request.php");?>

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