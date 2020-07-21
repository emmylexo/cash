<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  if(isset($_GET['ordid']) AND $_GET['ordid'] != ''){
    $ordID = intval($_GET['ordid']);
  }else{
    $genInfo->redirect(BASE_URL.'administrator/get-help');
    exit();
  }

  $order = $adm->orderSingle($ordID);
  if(empty($order)){
    $genInfo->redirect(BASE_URL.'administrator/get-help');
    exit();
  }
  
  //Payer info
  $payerInfo = $adm->userInfo($order['payer_id']);
  $payeeInfo = $adm->userInfo($order['payee_id']);
  $ghInfo = $adm->myGHsingle($order['gh_id']);
  $phInfo = $adm->myPHsingle($order['ph_id']);

  //Approval Warning
  if(isset($_POST['approve'])) {
    $genInfo->redirect(BASE_URL.'administrator/approve?ordid='.$ordID.'&warning');
    exit();
  }
  if(isset($_GET['true']) AND $order['ord_status'] != 1) {
    try {
      //Update order table
      $stmt = $genInfo->runQuery("UPDATE orders 
        SET ord_status=1, date_paid=:currentTime
        WHERE ord_id=:ordID");     
      $stmt->execute(array(':currentTime'=>$currentTime, ':ordID'=>$ordID));  

      //Update GH table on successfuly payment confirmation
      $withdrawn = $ghInfo['g_withdrawn'] + $order['ord_amount'];
      if($withdrawn == $ghInfo['g_amount']){        
        $status = 'Full Payment';
      }
      else{
        $status = 'Part Payment';
      }
      //Update Get_help table
      $stmt = $genInfo->runQuery("UPDATE get_help 
        SET g_withdrawn=:amount + g_withdrawn, 
          g_status=:status
        WHERE gh_id=:ghID");     
      $stmt->execute(array(':amount'=>$order['ord_amount'], ':ghID'=>$order['gh_id'], ':status'=>$status));


      //Update PH table on successfuly payment confirmation
      $paid = $phInfo['paid'] + $order['ord_amount'];
      if($paid == $ghInfo['g_amount']){        
        $status = 'Full Payment';
      }
      else{
        $status = 'Part Payment';
      }
      //
      $mergeIn = date('Y-m-d H:i:s', strtotime($configInfo['ph_auto_merge_timer'], strtotime(date("Y-m-d H:i:s"))));

      //Update Get_help table
      $stmt = $genInfo->runQuery("UPDATE provide_help 
        SET paid=:paid, 
          ph_status=:status, 
          ph_on=0, 
          ph_auto_merge_timer=:mergeIn
        WHERE ph_id=:phID");     
      $stmt->execute(array(':paid'=>$paid, ':phID'=>$order['ph_id'], ':status'=>$status, ':mergeIn'=>$mergeIn));

      //Payer
      $action = 'Reward for Promt POP Upload';
      $stmt = $genInfo->runQuery("INSERT INTO user_credibility(
          login_id, action, score, date_added)

        VALUES(:loginID, :action, :score, :currentTime)");
    
      $stmt->execute(array(':loginID'=>$order['payer_id'], ':action'=>$action, ':score'=>$configInfo['credit_pop_upload'], ':currentTime'=>$currentTime));


      //Insert Into user notification table
      $action = 'The Administrator has approved your payment!';
      $actionUrl = 'user/payment?ordid='.$ordID;
      $type = 'Payment Confirmation';

      $genInfo->userNotification($payerInfo['login_id'], $action, $type, $actionUrl, $currentTime);

      //Insert Into admin notification table
        $action = $admInfo['username'].'. has approved uploaded POP!';
        $actionUrl = 'payment?ordid='.$ordID;
        $type = 'Payment Confirmation';
        $username = $admInfo['username'];

        $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

        //include POP approve notifications
        $userID = $payerInfo['login_id'];
        include(ROOT_PATH."notifications/popApprove.php");

      $genInfo->redirect(BASE_URL.'administrator/approve?ordid='.$ordID.'&confirmed');
      exit();      
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  //block defaulter 
  if(isset($_POST['block'])) {
    //Update user table
    $stmt = $genInfo->runQuery("UPDATE users 
      SET status='Blocked'
      WHERE login_id=:payerID");     
    $stmt->execute(array(':payerID'=>$order['payer_id']));

    //Update PH table
    $stmt = $genInfo->runQuery("UPDATE provide_help 
      SET ph_status='Frozen'
      WHERE ph_id=:phID");     
    $stmt->execute(array(':phID'=>$order['ph_id']));

    //Delete order
    $stmt = $genInfo->runQuery("DELETE FROM orders
      WHERE ord_id=:ordID");     
    $stmt->execute(array(':ordID'=>$ordID)); 

    //Insert Into user notification table
    $action = 'The administrator has deleted reported order and you will receive a new order asap!';
    $actionUrl = 'user/notifications?che';
    $type = 'Actions taken';

    $genInfo->userNotification($payeeInfo['login_id'], $action, $type, $actionUrl, $currentTime);

    //Insert Into user notification table
    $action = 'The administrator has deleted your PH order which was reported by the receiver and your account has been restricted.';
    $actionUrl = 'user/notifications?che';
    $type = 'Account restriction';

    $genInfo->userNotification($payerInfo['login_id'], $action, $type, $actionUrl, $currentTime);

    //Insert Into admin notification table
      $action = $admInfo['username'].' has taken actions on reported POP!';
      $actionUrl = 'approve?ordid='.$ordID;
      $type = 'Actions Taken';
      $username = $admInfo['username'];

      $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

      //include block notifications
      $userID = $payerInfo['login_id'];
      include(ROOT_PATH."notifications/block.php");

    $genInfo->redirect(BASE_URL.'administrator/approve?ordid='.$ordID.'&reported');
    exit();
  }

  $pageTitle = "Payment Confirmation";
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
            <ol class="breadcrumb">
              <li><a href="<?php echo BASE_URL;?>administrator">Dashboard</a></li>
              <li><a href="<?php echo BASE_URL;?>administrator/get-help">Get Help</a></li>
              <li class="active">Payment Confirmation</li>
          </ol>
        </div>
    </div>

    <?php
        if(isset($error)){
            foreach($error as $error){?>
             <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
             </div>
    <?php } }elseif(isset($_GET['pop'])){?>
     <div class="alert alert-success">
        <i class="fa fa-check-square"></i> &nbsp; POP Submitted!
     </div>
<?php }if(isset($_GET['warning'])){?>
     <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you want to Approve this Payment? <a href="<?php echo BASE_URL.'administrator/approve?ordid='.$ordID.'&true';?>">Yes</a>  | 
        <a href="<?php echo BASE_URL.'administrator/approve?ordid='.$ordID;?>">No</a> 
     </div>
<?php }if(isset($_GET['confirmed'])){?>
     <div class="alert alert-success">
        <i class="fa fa-check-square"></i> &nbsp; Payment successfully confirmed!
     </div>
<?php }?>

<div class="row">
  <div class="col-lg-4">
    <div class="portlet"><!-- /primary heading -->
      <div class="portlet-heading">
        <h3 class="portlet-title text-dark text-uppercase">
          Payer Info
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
        <div class="portlet-body" style="height: 280px;">
          <div class="table-responsive">
            <table class="table table-actions-bar m-b-0">
                <tbody>
                  <tr>
                      <td>
                     <?php if($payerInfo['photo'] != ''){?>
                        <img style="border-radius:50%;" src="<?php echo $payerInfo['photo'];?>" 
                        alt="profile Photo" class="thumb-lg pull-left m-r-10">
                      <?php }else{?>
                        <i style="font-size:80px;" class="ti-user"></i> 
                      <?php }?>
                      </td>
                  </tr> 

                  <tr>
                    <td>First Name: <?php echo $payerInfo['first_name'];?></td>
                  </tr> 
                  <tr>
                    <td>Last Name: <?php echo $payerInfo['last_name'];?></td>
                  </tr> 
                  <tr>
                    <td>Tel: <?php echo $payerInfo['phone'];?></td>
                  </tr>
                  <?php if($order['ord_status'] != 1){?>
                  <tr>
                    <td>
                    <form role="form" method="post" action="" enctype="multipart/form-data" style="float:left;"><br>
                      &nbsp; <button type="submit" name="block" class="btn btn-danger btn-sm">Delete Order & Block Defaulter</button>
                    </form>
                    </td>
                  </tr> 
                  <?php }?>
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
          Your Actions
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
        <div class="portlet-body" style="height: 280px;">
          <div class="col-lg-12">
            Amount: <b><?php echo $defaultCurrency['c_symbol'].number_format((float)$order['ord_amount'], 2, '.', ',');?></b><br>
            Date Matched: <?php echo strftime("%d-%m-%Y %I:%M", strtotime($order["ord_date"]))?><br>
            Status: 
            <b><?php if($order['ord_status'] == 1){?>
              <span style="color: green">Paid</span>
            <?php }else{?>
              <span style="color: red;">Unpaid</span>
            <?php }?>
            </b>
          </div>
          <div class="col-lg-12">
            <br>
            <?php if($order['pop'] == ''){?>
                <b>Remaining Time:</b> 
                <span id="paymentTimer" style="font-size:20px; color:red;"></span>
            <?php }?>

            <?php if($order['pop'] != '' AND $order['ord_status'] != 1){?>
                <b>POP Uploaded - </b> 
                <span style="font-size:20px; color:brown;">Awaing Confirmation</span>
            <?php }?>

            <?php if($order['flag'] == 1){?>
                <br>
                <span style="font-size:20px; color:red;">POP Reported</span>
            <?php }?>

            <?php if($order['ord_status'] == 1){?>
                <b>POP Uploaded - </b> 
                <span style="font-size:20px; color:green;">Payment Confirmed!</span>
            <?php }?>
            <br><br>
            <p><?php echo $configInfo['pay_confirmation_instr'];?></p>
            <?php if($order['ord_status'] != 1){?>
            <form role="form" method="post" action="" enctype="multipart/form-data" style="float:left;"><br>
              <button type="submit" name="approve" class="btn btn-success btn-sm">Approve Payment</button>
            </form>
            <?php }?>
            <?php if($order['pop'] != ''){?>
              <a style="margin:20px 10px 0px" class="btn btn-default btn-sm" target="_blank" href="<?php echo $order['pop'];?>">View POP</a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- end col -->

</div> <!-- end row -->

<?php //include(ROOT_PATH."user/includes/paymentTimer.php");?>
<?php   
  $dbTimer = $order['period_timer'];
  include(ROOT_PATH."user/includes/paymentTimer.php");
?>
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
