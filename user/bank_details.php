<?php
require("../includes/config.php");
require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
require_once(ROOT_PATH . "core/session.php");
require_once(ROOT_PATH . "user/includes/requiredActions.php");
//  require_once(ROOT_PATH . "administrator/includes/bankDetails.php");


$activationOrder = $genInfo->runQuery("SELECT * FROM orders");
$activationOrder->execute();
$activationOrder = $activationOrder->fetch(PDO::FETCH_ASSOC);

$userTable = $genInfo->runQuery("SELECT * FROM users");
$userTable->execute();
$userTable = $userTable->fetch(PDO::FETCH_ASSOC);

$user_account_number = $bankInfo['account_number'];
$adminTurn = $genInfo->runQuery("SELECT * FROM payment_pairs WHERE user_account_number = $user_account_number");
$adminTurn->execute();
$adminTurn = $adminTurn->fetch(PDO::FETCH_ASSOC);


$userLoginID = $userTable['login_id'];

//Receiver info
  $payeeInfo = $front->userInfo($order['payee_id']);
//  $bankInfo = $front->bankInfo($order['payee_id']);

//Update pop
if (isset($_FILES['pop']['name']) and $_FILES['pop']['name'] != "") {

    if ($order["pop"] != '') {
        $toDelete = ROOT_PATH . str_replace('../', '', $order['pop']);
        if (file_exists($toDelete)) {
            unlink($toDelete);
        }
    }

    $target_path = "../uploads/pop/";
    $validextensions = array("jpeg", "jpg", "png", "doc", "txt", "pdf");
    $ext = explode('.', basename($_FILES['pop']['name']));
    $file_extension = end($ext);
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
    if (($_FILES["pop"]["size"] < 300000000)
        && in_array($file_extension, $validextensions)) {
        if (move_uploaded_file($_FILES['pop']['tmp_name'], $target_path)) {
            // Update
            //Set mature date, 6hours by default
            $popDate = date('Y-m-d H:i:s', strtotime($configInfo['pop_confirm'], strtotime(date("Y-m-d H:i:s"))));
            $stmt = $genInfo->runQuery("UPDATE orders 
          SET pop=:pop, ord_status=:ord_status, pop_date=:popDate
          WHERE ord_id=:ordID");
            $ordID = $activationOrder['ord_id'];

            $stmt->execute(array(':pop' => $target_path, ':ordID' => $ordID, ':ord_status' => 2, ':popDate' => $popDate));

//            Send Payee SMS
            $payerId = $activationOrder['payer_id'];
            $approvalLink = BASE_URL.'userActivation';
            $payerEmail = $userTable['email'];
            $phone = $adminTurn['admin_mobile'];

            $front->requestApproval($payerId, $approvalLink, $payerEmail, $phone);

            //Insert Into user notification table
            $action = $userInfo['first_name'] . ' ' . substr($userInfo['last_name'], 0, 1) . '. had uploaded POP for your GH order';
            $actionUrl = 'user/approve?ordid=' . $ordID;
            $type = 'POP Submitted';

            $genInfo->userNotification($userLoginID, $action, $type, $actionUrl, $currentTime);

            //Insert Into admin notification table
            $action = $userInfo['first_name'] . ' ' . $userInfo['last_name'] . '. has uploaded POP for PH order';
            $actionUrl = 'approve?ordid=' . $ordID;
            $type = 'POP Submitted';
            $username = '';

            $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

          $genInfo->redirect(BASE_URL.'user/bank_details');

//        $genInfo->redirect(BASE_URL.'user/payment?ordid='.$ordID.'&pop=submitted');
//        $genInfo->redirect(BASE_URL.'user/bank-details?updated');
        } else {     //  If File Was Not Moved.
            $error[] = '). please try again!.<br/>';
        }
    } else {     //   If File Size And File Type Was Incorrect.
        $error[] = '). ***Invalid file Size or Type***<br/>';
    }
}


//grab user account info
$bankInfo = $front->bankInfo($loginID);

//Update Information
if (isset($_POST['AcctName'])) {
    $AcctName = strip_tags($_POST['AcctName']);
    $acctNumber = strip_tags($_POST['acctNumber']);
    $bank = strip_tags($_POST['bank']);

    if ($AcctName == "") {
        $error[] = 'Please enter your Account Name!';
    }
    if ($acctNumber == "") {
        $error[] = 'Please enter your Account Number!';
    }
    if (strlen($acctNumber) < 10 and strlen($acctNumber) > 12) {
        $error[] = 'Please enter a valid Account Number!';
    }
    if ($bank == "") {
        $error[] = 'Please enter the name of your Bank!';
    }

    if (!isset($error)) {
        try {
            $stmt = $genInfo->runQuery("SELECT * FROM bank_info 
          WHERE account_number=:acctNumber AND bank=:bank");
            $stmt->execute(array(':acctNumber' => $acctNumber, ':bank' => $bank));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['account_number'] == $acctNumber) {
                $error[] = "Opps! Account Number already exisit in the system!";
            } else {
                $stmt = $genInfo->runQuery("INSERT INTO bank_info (login_id, account_name, account_number, bank, date_added)
            
            VALUES(:loginID, :AcctName, :acctNumber, :bank, :currentTime)");
                $stmt->execute(array(':loginID' => $loginID, ':AcctName' => $AcctName, ':acctNumber' => $acctNumber, ':bank' => $bank, ':currentTime' => $currentTime));


                $genInfo->redirect(BASE_URL . 'user/bank-details?updated');
                $genInfo->redirect(BASE_URL . 'user/payment?ordid=' . $ordID . '&pop=submitted');

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

$pageTitle = "Payment";
$pageDesc = "Description";
$pageKeywords = "Keywords";

include(ROOT_PATH . "user/includes/header.php");
include(ROOT_PATH . "user/includes/navMenu.php");
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
                        <li><a href="<?php echo BASE_URL; ?>user">Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL; ?>user/provide-help">Provide Help</a></li>
                        <li class="active">Payment</li>
                    </ol>
                </div>
            </div>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                    </div>
                <?php }
            } elseif (isset($_GET['pop'])) {
                ?>
                <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; POP Submitted!
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-4">
                    <div class="portlet"><!-- /primary heading -->
                        <div class="portlet-heading">
                            <h1 class="portlet-title text-dark text-uppercase">
                                <span style="color: red;"> Pay Activation Fee to the Account Details Below </span>
                            </h1>
                            <div class="portlet-widgets">
                                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#staff" href="#staff"><i
                                            class="ion-minus-round"></i></a>
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
                                                <?php if ($payeeInfo['photo'] != '') { ?>
                                                    <img style="border-radius:50%;"
                                                         src="<?php echo $payeeInfo['photo']; ?>"
                                                         alt="profile Photo" class="thumb-lg pull-left m-r-10">
                                                <?php } else { ?>
                                                    <i style="font-size:80px;" class="ti-user"></i>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <?php

                                        //                  $datetime = new DateTime();
                                        //                  $timerT = $datetime->format('M d, Y  H:i:s');
                                        //
                                        //                  echo $timerT;
                                        //
                                        //                  exit();

                                        if (isset($_SESSION['user-logged-in'])) {
                                            try {
                                                $stmt = $genInfo->runQuery("SELECT * FROM admin_turns WHERE next = 1");
                                                $stmt->execute();
                                                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                                            } catch (PDOException $e) {
                                                echo $e->getMessage();
                                            }

                                            $stmt2 = $genInfo->runQuery("INSERT INTO payment_pairs (admin_name, admin_account_number, admin_bank_name, admin_mobile, user_name, user_account_number, user_bank_name) 
				      		VALUES(:admin_name, :admin_account_number, :admin_bank_name, :admin_mobile, :user_name, :user_account_number, :user_bank_name)");

                                            $stmt2->bindparam(":admin_name", $admin['account_name']);
                                            $stmt2->bindparam(":admin_account_number", $admin['account_number']);
                                            $stmt2->bindparam(":admin_bank_name", $admin['bank_name']);
                                            $stmt2->bindparam(":admin_mobile", $admin['phone_number']);
                                            $stmt2->bindparam(":user_name", $bankInfo['account_name']);
                                            $stmt2->bindparam(":user_account_number", $bankInfo['account_number']);
                                            $stmt2->bindparam(":user_bank_name", $bankInfo['bank']);
                                            $stmt2->execute();

                                            $admin_name = $admin['account_number'];
                                            $updateCurrentNext = $genInfo->runQuery("UPDATE admin_turns SET next='0' WHERE account_number=$admin_name");
                                            $updateCurrentNext->execute();

                                            $i = $admin['id'];

                                            if ($i >= 11) {
                                                $i = 0;
                                            }
                                            $updateNextNext = $genInfo->runQuery("UPDATE admin_turns SET next = '1' WHERE id > $i ORDER BY id ASC LIMIT 1");
                                            $updateNextNext->execute();

                                            // Populate the order table.


                                            $orderAmount = 1000;
                                            $orderStatus = 0;
                                            $periodTimer = 'Jul 24, 2020 15:37:25';
                                            $orderDate = date("Y-m-d H:i:s");

                                            $orderTable = $genInfo->runQuery("INSERT INTO orders (admin_id, payer_id, ord_amount, ord_status, period_timer, ord_date) VALUES(:admin_id, :payer_id, :ord_amount, :ord_status, :period_timer, :ord_date)");
                                            $orderTable->bindparam(":payer_id", $loginID);
                                            $orderTable->bindparam("admin_id", $admin['id']);
                                            $orderTable->bindparam(":ord_amount", $orderAmount);
                                            $orderTable->bindparam(":ord_status", $orderStatus);
                                            $orderTable->bindparam(":period_timer", $periodTimer);
                                            $orderTable->bindparam(":ord_date", $orderDate);
                                            $orderTable->execute();

                                            unset($_SESSION['user-logged-in']);
                                        } else {

                                            $user_account_number = $bankInfo['account_number'];
                                            $stmt = $genInfo->runQuery("SELECT * FROM payment_pairs WHERE user_account_number = $user_account_number");
                                            $stmt->execute();
                                            $paymentPair = $stmt->fetch(PDO::FETCH_ASSOC);

                                            $admin['account_name'] = $paymentPair['admin_name'];
                                            $admin['account_number'] = $paymentPair['admin_account_number'];
                                            $admin['bank_name'] = $paymentPair['admin_bank_name'];
                                            $admin['phone_number'] = $paymentPair['admin_mobile'];
                                        }
                                        ?>
                                        <tr>
                                            <td>Account Name: <?php echo $admin['account_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Account Number: <?php echo $admin['account_number']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Name of Bank: <?php echo $admin['bank_name']; ?></td>
                                        <tr>
                                            <td>Tel: <?php echo $admin['phone_number']; ?></td>
                                        </tr>
                                        <?php
                                        ?>
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
                                Payment OF Activation Fee Payment Instruction
                            </h3>
                            <div class="portlet-widgets">
                                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#adminLogin" href="#adminLogin"><i
                                            class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="adminLogin" class="panel-collapse collapse in">
                            <div class="portlet-body" style="height: 280px;">
                                <div class="col-lg-12">
                                    Amount: <b><?php echo $defaultCurrency['c_symbol'] ?>1000</p></b><br>
                                    Date Matched: <?php echo $activationOrder["ord_date"]; ?><br>
                                    Status:
                                    <b><?php if ($order['ord_status'] == 1) { ?>
                                            <span style="color: green">Paid</span>
                                        <?php } else { ?>
                                            <span style="color: red;">Unpaid</span>
                                        <?php } ?>
                                    </b>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <?php if ($activationOrder['pop'] == '') { ?>
                                        <b>Remaining Time:</b>
                                        <span id="paymentTimer" style="font-size:20px; color:red;"></span>
                                    <?php } ?>

                                    <?php if ($activationOrder['pop'] != '' and $activationOrder['ord_status'] == 2) { ?>
                                        <b>POP Uploaded - </b>
                                        <span style="font-size:20px; color:red;">Awaiting Confirmation</span>
                                    <?php } ?>

                                    <?php if ($activationOrder['ord_status'] == 1) { ?>
                                        <b>POP Uploaded - </b>
                                        <span style="font-size:20px; color:green;">Payment Confirmed!</span>
                                    <?php } ?>
                                    <br><br>
                                    <span style="font-size:20px; color:red; margin-bottom: 10px; display: block;"> Activation fee is to be Paid to the Account to begin donation after payments upload prove of payment using the button below </span>
                                    <?php if ($activationOrder['ord_status'] == 0) { ?>
                                    <label for="pop" class="btn btn-success btn-sm">Upload Prove of Payment </label>
                                    <form role="form" method="post" action="" enctype="multipart/form-data"
                                          style="float:left;"><br>
                                        <input style="display:none" type="file" name="pop" id="pop"
                                               onchange="this.form.submit();">
                                    </form>
                                    <?php } ?>
<!--                                    --><?php //if ($activationOrder['pop'] != '') { ?>
<!--                                        <a style="margin:20px 10px 20px 0; display: block; width: 30%;" class="btn btn-default btn-sm" target="_blank"-->
<!--                                           href="--><?php //echo $order['pop']; ?><!--">View POP</a><br>-->
<!--                                    --><?php //} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div> <!-- end row -->

            <?php
            $dbTimer = $order['period_timer'];
            include(ROOT_PATH . "user/includes/paymentTimer.php");
            ?>

        </div> <!-- container -->
        <div class="content">

            <div class="wraper container-fluid">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                        </div>
                    <?php }
                } elseif (isset($_GET['updated'])) {
                    ?>
                    <div class="alert alert-success">
                        <i class="fa fa-check-square"></i> &nbsp; Profile is updated successfully!
                    </div>
                <?php } ?>

                <div class="row">

                    <div class="col-md-6">

                        <form action="" method="post">
                            <div class="card-box m-t-20">
                                <h4 class="m-t-0 header-title"><b>Bank Information</b></h4>
                                <p>Fill in your Your bank information Carefully (Account to be Used in recieving
                                    Donations) </p>
                                <?php if (isset($bankInfo['bank']) and $bankInfo['bank'] != '') { ?>
                                    <div class="p-20">
                                        <div class="about-info-p">
                                            <strong>Account Name</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="AcctName" type="text" readonly
                                                       value="<?php echo $bankInfo['account_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="about-info-p">
                                            <strong>Account Number</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="acctNumber" type="text" readonly
                                                       value="<?php echo $bankInfo['account_number']; ?>">
                                            </div>
                                        </div>

                                        <div class="about-info-p">
                                            <strong>Name of Bank</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="bank" type="text" readonly
                                                       value="<?php echo $bankInfo['bank']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="p-20">
                                        <div class="about-info-p">
                                            <strong>Account Name</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="AcctName" type="text" required
                                                       minlength="7">
                                            </div>
                                        </div>
                                        <div class="about-info-p">
                                            <strong>Account Number</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="acctNumber" type="text" required
                                                       minlength="10">
                                            </div>
                                        </div>

                                        <div class="about-info-p">
                                            <strong>Name of Bank</strong>
                                            <br>
                                            <div class="form-group">
                                                <input class="form-control" name="bank" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>


                        </form>
                    </div>


                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div> <!-- content -->
    <?php include(ROOT_PATH . "user/includes/footer.php"); ?>
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
        jQuery(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });

            $(".knob").knob();

        });
    </script>