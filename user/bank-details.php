<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php"); 
  require_once(ROOT_PATH . "core/session.php");
  //grab user account info
  $bankInfo = $front->bankInfo($loginID);
$payeeInfo = $front->userInfo($order['payee_id']);

  //Update Information
  if(isset($_POST['AcctName'])) {
    $AcctName = strip_tags($_POST['AcctName']);
    $acctNumber = strip_tags($_POST['account-number']);
    $bank = strip_tags($_POST['bank-name-new']);

    if($AcctName == "") {
      $error[] = 'Please enter your Account Name!';
    }
    if($acctNumber == "") {
      $error[] = 'Please enter your Account Number!';
    }
    if(strlen($acctNumber) < 10 AND strlen($acctNumber) > 12) {
      $error[] = 'Please enter a valid Account Number!';
    }
    if($bank == "") {
      $error[] = 'Please enter the name of your Bank!';
    }
    
    if(!isset($error)){
      try {
        $stmt = $genInfo->runQuery("SELECT * FROM bank_info 
          WHERE account_number=:acctNumber AND bank=:bank");
        $stmt->execute(array(':acctNumber'=>$acctNumber, ':bank'=>$bank));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['account_number'] == $acctNumber){
          $error[] = "Opps! Account Number already exisit in the system!";
        }
        else{
          $stmt = $genInfo->runQuery("INSERT INTO bank_info (login_id, account_name, account_number, bank, date_added)
            
            VALUES(:loginID, :AcctName, :acctNumber, :bank, :currentTime)");     
          $stmt->execute(array(':loginID'=>$loginID, ':AcctName'=>$AcctName, ':acctNumber'=>$acctNumber, ':bank'=>$bank, ':currentTime'=>$currentTime));

            $_SESSION['user-logged-in'] = true;


          $genInfo->redirect(BASE_URL.'user/bank_details');
          exit();
        }
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }
  }


  $pageTitle = "Bank Information";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
  <!-- Start content -->
  <div class="content">

    <div class="wraper container-fluid">
        <?php
            if(isset($error)){
                foreach($error as $error){?>
                 <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                 </div>
        <?php } }elseif(isset($_GET['updated'])){?>
         <div class="alert alert-success">
            <i class="fa fa-check-square"></i> &nbsp; Profile is updated successfully!
         </div>
    <?php }?>

    <div class="row">

    <div class="col-md-6">
    
    <form id="getUserName" method="post">
      <div class="card-box m-t-20">
      <h4 class="m-t-0 header-title"><b>Bank Information</b></h4>
      <p>Your bank information is required!</p>
      <?php if(isset($bankInfo['bank']) AND $bankInfo['bank'] != ''){?>
      <div class="p-20">
        <div class="about-info-p">
          <strong>Account Name</strong>
          <br>
           <div class="form-group">
            <input class="form-control" name="AcctName" type="text" readonly required value="<?php echo $bankInfo['account_name'];?>">
          </div>
        </div>
        <div class="about-info-p">
          <strong>Account Number</strong>
          <br>
           <div class="form-group">
            <input class="form-control" name="acctNumber" type="text" readonly required value="<?php echo $bankInfo['account_number'];?>">
          </div>
        </div>

        <div class="about-info-p">
          <strong>Name of Bank</strong>
          <br>
           <div class="form-group">
            <input class="form-control" name="bank" type="text" readonly required value="<?php echo $bankInfo['bank'];?>">
          </div>
        </div>
      </div>
    <?php }else{?>
      <div class="p-20">
        <div class="about-info-p">
          <strong>Account Number</strong>
          <br>
           <div class="form-group">
            <input id="account" class="form-control" name="account-number" type="text" required minlength="10">
            <input id="bankNameNew" class="form-control" name="bank-name-new" type="text" style="display: none" required>
          </div>
        </div>

        <div class="about-info-p">
          <strong>Name of Bank</strong>
          <br>
           <div class="form-group">
<!--             --><?php //getUserBank() ?>
             <select id="bankName" class="form-control" name="bank-name">
               <option>Select Bank</option>
             <?php
             $curl = curl_init();

             curl_setopt_array($curl, array(
                 CURLOPT_URL => "https://api.paystack.co/bank",
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => "",
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 30,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => "GET",
                 CURLOPT_HTTPHEADER => array(
                     "Authorization: Bearer SECRET_KEY",
                     "Cache-Control: no-cache",
                 ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);
             curl_close($curl);

             if ($err) {
               return "cURL Error #:" . $err;
             } else {
               $response = json_decode($response, true);
               foreach ($response['data'] as $data) { ?>
                 <option value="<?php echo $data['code']; ?>"><?php echo $data['name']; ?></option>
              <?php }

             }
             ?>
             </select>
          </div>
          <div class="about-info-p">
            <strong>Account Name</strong>
            <br>
            <div class="form-group">
              <input class="form-control" id="accountName" name="AcctName" type="text" required readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-success btn-sm">
        Submit</button>
      </div>
        <?php if(isset($format)) {echo $format;} ?>
      </div>
    <?php }?>
    </div>
</form>
 </div>


 
  </div>
</div> <!-- container -->
               
</div> <!-- content -->

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
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

  <script>
    $("#bankName").change((e) => {
      e.preventDefault();
        $.ajax({
          type: 'GET',
          url: "get-user-bank-detail.php",
          data: $("#getUserName").serialize(),
          success: function (response) {
            response = JSON.parse(response);
            let accountName = response.data.account_name;
            $("#accountName").val(accountName);
            $("#bankNameNew").val($( "#bankName option:selected" ).text());
          },
          error: function (xhr) {
            console.log('Error!  Status = ' + xhr.status + " Message = " + xhr.statusText);
            //console.log('Error!  Status = ' + xhr.status + " Message = " +  xhr.statusText);
          }
        });
      // }
    });
  </script>