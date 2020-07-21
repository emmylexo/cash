<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");

  $myPHs = $front->myPHs($loginID);
  $countPHs = $front->countPHs($loginID);

  //
  if(isset($_POST['orderNow'])){
    if(isset($_POST['Copper'])){
      $plan = 'Copper';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    if(isset($_POST['Bronze'])){
      $plan = 'Bronze';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    elseif(isset($_POST['Silver'])){
      $plan = 'Silver';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    elseif(isset($_POST['Gold'])){
      $plan = 'Gold';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    elseif(isset($_POST['Platinum'])){
      $plan = 'Platinum';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    else{
      $plan = 'Copper';
      $phAmt = strip_tags($_POST['phAmt']);
    }
    
    //Php Validation
    if($phAmt == 0 AND $plan == '') {
      $error[] = "Opps! Something went wrong!"; 
    }
    

    if(count($myPHs) > 0){
      $phi = 0;
      foreach ($myPHs as $ph) {
        if($phi==1) break;
        //Check if previous PH amount is greater
        if($ph['amount'] > $phAmt){
          $error[] = 'Oppps! Your previous PH Package is: <u>'.$siteInfo['site_name'].'-'.$ph['plan'].': '.$defaultCurrency['c_symbol'].number_format($ph['amount']).'</u>, you can not order lower package!';
        }

        //Check if previous PH is fully paid
        if($ph['amount'] != $ph['paid']){
          $error[] = "Oppps! It seems your previous PH amount has not be fully paid, you can only have one pending PH at a time!";
        }

        $phi++;
       } 
    }

    if(!isset($error)){
      try {
        //Set mature date, 7 days by default
        $matureDate = date('Y-m-d H:i:s', strtotime($configInfo['ph_maturity'], strtotime(date("Y-m-d H:i:s"))));

        //Set Interest
        $interest = $configInfo['ph_percentage'] * $phAmt / 100;
        //Set Signup bonus
        $bonus = 0;
        if($countPHs < 1){
          $bonus = $configInfo['signup_bonus'] * $phAmt / 100;
        }
        
        //add to request amount
        $requestAmt = $interest + $phAmt + $bonus;

        //
        $stmt = $genInfo->runQuery("INSERT INTO provide_help(
            login_id, plan, amount, interest, bonus, request_amt, ph_status, matured_date, date_added, last_modified, ph_control)

          VALUES(:loginID, :plan, :amount, :interest, :bonus, :requestAmt, 'Pending', :matureDate, :currentTime, :currentTime, 1)");
      
        $stmt->execute(array(':loginID'=>$loginID, ':plan'=>$plan, ':amount'=>$phAmt, ':interest'=>$interest, ':bonus'=>$bonus, ':requestAmt'=>$requestAmt, ':matureDate'=>$matureDate, ':currentTime'=>$currentTime));
        $phID = $genInfo->lastInsertId();


        //Check if its first time PH
        if(count($myPHs) < 1){
          //Check if its has referral
          if($userInfo['referral'] != '' 
            OR $userInfo['referral'] != 0){
            //Calculate referral bonus (5% by default)
            $refBonus = $configInfo['referral_bonus'] * $phAmt / 100;
            //
            $stmt = $genInfo->runQuery("INSERT INTO referral(
                ph_id, referree_id, referral_id, ph_amount, bonus, date_added)

              VALUES(:phID, :loginID, :referralID, :amount, :refBonus, :currentTime)");
          
            $stmt->execute(array(':phID'=>$phID, ':loginID'=>$loginID, ':referralID'=>$userInfo['referral'], ':amount'=>$phAmt, ':refBonus'=>$refBonus, ':currentTime'=>$currentTime));
          }
        }

        $genInfo->redirect(BASE_URL.'user/provide-help?submitted');
        exit();

      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  $pageTitle = "Packages";
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

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Packages</h4>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo BASE_URL;?>user/">Dashoboard</a></li>
                        <li class="active">Packages</li>
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
      <i class="fa fa-check-square"></i> &nbsp; PH request submitted!
   </div>
  <?php }?>
        <div class="row pricing-plan">
            <div class="col-md-12">
                <div class="row">
                	<div class="col-md-6">
                		
  <div class="card-box m-t-20">
    <h4 class="m-t-0 header-title"><b>Change Password</b></h4>
    <div class="p-20">
    	<ul class="price-features">
                                <li><?php echo $configInfo['ph_percentage'].'% Return In '.$configInfo['ph_maturity']?> </li>
                                <li>20% Instant Merging</li>
                                <li>100% Automated</li>
                                <li>24x7 Support</li>
                            </ul>
      <form action="" method="post">
        <div class="form-group">
          <input class="form-control" type="number" name="phAmt" placeholder="Enter your order">
        </div>

        <div class="form-group">
          <button type="submit" name="orderNow" class="btn btn-success w-md waves-effect waves-light">
          Order Now</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  
                    
                    

                </div> <!-- end row -->
            </div> <!-- end Col-10 -->
        </div> <!-- end row -->
 
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