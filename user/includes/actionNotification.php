<?php if(isset($myRecentOrder['payer_id']) AND $myRecentOrder['payer_id'] == $loginID AND $myRecentOrder['pop'] == ''){?>
  <div style="width:100%; background:#FFF5EE; border: 2px dashed brown; border-radius:10px;margin-bottom:15px; height:auto; padding:15px;">
    <div class="row">
      <div class="col-sm-5">
        <h3>Your new PH order Timer:</h3>
      </div>
      <div class="col-sm-4">
        <span id="paymentTimer" style="font-size:30px; color:red;"></span>
      </div>
      <div class="col-sm-3">
        <h3 align="left"><a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'user/payment?ordid='.$myRecentOrder['ord_id']?>">Pay Now!</a></h3>
      </div>
    </div>
  </div>

<?php   
  $dbTimer = $myRecentOrder['period_timer'];
  include(ROOT_PATH."user/includes/paymentTimer.php");
?>

<!-- Payment confirmation action -->
<?php }elseif(isset($myRecentOrder['payee_id']) AND $myRecentOrder['payee_id'] == $loginID AND $myRecentOrder['pop'] != '' AND $myRecentOrder['ord_status'] != 1){?>
  <div style="width:100%; background:#EAF7EA; border: 2px dashed green; border-radius:10px;margin-bottom:15px; height:auto; padding:15px;">
    <div class="row">
      <div class="col-sm-6">
        <h3 style="font-size:16px">POP Uploaded for your GH order, confirmation timer:</h3>
      </div>
      <div class="col-sm-4">
        <span id="paymentTimer" style="font-size:30px; color:red;"></span>
      </div>
      <div class="col-sm-2">
        <h3><a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'user/approve?ordid='.$myRecentOrder['ord_id']?>">Approve Now!</a></h3>
      </div>
    </div>
  </div>

<?php   
  $dbTimer = $myRecentOrder['pop_date'];
  include(ROOT_PATH."user/includes/paymentTimer.php");
?>
<?php }?>