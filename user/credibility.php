<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");
  require_once(ROOT_PATH . "user/includes/requiredActions.php");

  $credibility = $front->credibility($loginID);
  $sumAllScore = $front->sumAllScore($loginID);
  $sumAvailableScore = $front->sumAvailableScore($loginID);

  $allScoreValue = $sumAllScore * $configInfo['creditbility'] / 100;
  $availableValue = $sumAvailableScore * $configInfo['creditbility'] / 100;


  //
  if(isset($_POST['payout'])){

    //Php Validation
    if($availableValue < $configInfo['min_credit_payout']){
      $error[] = "Credibility Minimum Payout Amount is ".$defaultCurrency['c_symbol'].$configInfo['min_credit_payout'].". Your available credit value is: <b>".$defaultCurrency['c_symbol'].number_format($availableValue)."</b>"; 
    }
    
    if(!isset($error)){
      try {        
        $stmt = $genInfo->runQuery("INSERT INTO get_help(
            login_id, g_amount, g_status, req_date)

          VALUES(:loginID, :amount, 'Pending', :currentTime)");
      
        $stmt->execute(array(':loginID'=>$loginID, ':amount'=>$availableValue, ':currentTime'=>$currentTime));

        //
        $stmt = $genInfo->runQuery("UPDATE user_credibility 
          SET credit_status=1 
          WHERE login_id=:loginID
          AND credit_status=0");      
        $stmt->execute(array(':loginID'=>$loginID));
        
        $genInfo->redirect(BASE_URL.'user/credibility?submitted');
        exit();
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  $pageTitle = "Credibility Scores";
  $pageDesc = "Description";
  $pageKeywords = "Kuser/eywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>
<link href="assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
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
              <li><a href="<?php echo BASE_URL;?>user">Dashboard</a></li>
              <li class="active">Credibility Scores</li>
          </ol>
      </div>
  </div>


<?php
    if(isset($error)){
        foreach($error as $error){?>
         <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
         </div>
<?php } }elseif(isset($_GET['submitted'])){?>
 <div class="alert alert-success">
    <i class="fa fa-check-square"></i> &nbsp; Payout request submitted!
 </div>
<?php }?>


<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="text-info" style="font-style:normal;"><?php echo $defaultCurrency['c_symbol'];?></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">
                <?php echo number_format($allScoreValue);?></b></h3>
                <p class="text-muted">Total Score</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-success pull-left">
                <i class="text-success" style="font-style:normal;"><?php echo $defaultCurrency['c_symbol'];?></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">
                <?php echo number_format($availableValue);?></b></h3>
                <p class="text-muted">Available for Payout</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<!-- end row -->
  
  <div class="row">
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
     <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Request Payout</a>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-actions-bar">
      <thead>
          <tr>
              <th>#</th>
              <th>Action</th>
              <th>Score</th>
              <th>Score Value</th>
              <th>Status</th>
              <th>Date</th>
          </tr>
      </thead>

      <tbody>
      <?php $i =0; 
            if(!empty($credibility)){
              foreach ($credibility as $score) {
                $i++;
                $refCredit = $front->referralCredit($score['login_id']);?>
          <tr>
              <td><?php echo $i;?></td>

              <td><?php echo $score['action'];?></td>

              <td><?php echo $score['score'];?></td>

              <td>
                <?php echo $defaultCurrency['c_symbol'].number_format((float)(($score['score'] * $configInfo['creditbility'] / 100)), 2, '.', ',');?>                
              </td>
              
              <?php if($score['credit_status'] == 0){?>
                <td>
                  <span class="label label-success">Available</span>
                </td>
              <?php }else{?>
                <td>
                  <span class="label label-danger">Used</span>
                </td>
              <?php }?>

              <td><?php echo strftime("%B %d, %Y", strtotime($score["date_added"]));?></td>
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
<!-- Modal -->
<div id="custom-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
  </button>
  <h4 class="custom-modal-title">Request Referral Credit Payout</h4>
  <div class="custom-modal-text text-left">
      <form role="form" action="" method="post">
        <div class="row">
          
          <div class="col-lg-12">
            <div class="form-group">
              <label for="payout">GH Amount (in <?php echo $defaultCurrency['c_symbol'].' - '.$defaultCurrency['c_code'];?>) </label>
              <input type="number" class="form-control" id="payout" readonly required name="payout"
              value="<?php echo number_format($availableValue);?>">
            </div>
          </div>
          <div class="col-lg-12">
            <p style="font-size:12px; font-style: italic;color: red;">Please kindly note that there is no reversal on successful request. </p>
            <div class="form-group">
              <label>
                <input type="checkbox" required name="agree"> I agreed to the <a href="<?php echo BASE_URL;?>terms">Terms and Conditions</a>
              </label>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-default waves-effect waves-light">Submitt Request</button>

        <button type="reset" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">Cancel</button>
      </form>
  </div>
</div>
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