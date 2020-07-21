<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  //incluse script run in related pages
  include(ROOT_PATH."administrator/includes/customersScript.php");

  //Sum all Paid,Unpaid, Cancelled, Refunded invoice total
  $totalPaid = $adm->paidOrderTotal($uID);
  $totalUnpaid = $adm->unpaidOrderTotal($uID);

  //Count 
  $countPHOrder = $adm->countPHOrder($uID);
  $countUnpaidPH = $adm->countUnpaidPH($uID);
  //
  $sumTotalGH = $adm->sumTotalGH($uID);
  $countCompletedGH = $adm->countCompletedGH($uID);
  //
  $sumTotalGHbanlance = $adm->sumTotalGHbanlance($uID);
  $countUncompletedGH = $adm->countUncompletedGH($uID);
  //
  $sumAllpaidGH = $adm->sumAllpaidGH($uID);
  $sumAllpaidPH = $adm->sumAllpaidPH($uID);

  //Unblock User
  if(isset($_POST['unBlock'])) {
    //Update user table
    $stmt = $genInfo->runQuery("UPDATE users 
      SET status='Active'
      WHERE login_id=:uID");     
    $stmt->execute(array(':uID'=>$uID));

    //Insert Into user notification table
    $action = 'The administrator has Unblocked your account!';
    $actionUrl = 'user/';
    $type = 'Account Unblocked';

    $genInfo->userNotification($uID, $action, $type, $actionUrl, $currentTime);

    //Insert Into admin notification table
    $action = $admInfo['username'].', has unblocked user account';
    $actionUrl = 'customer-summary?uid='.$uID;
    $type = 'Account unrestricted';
    $username = $admInfo['username'];

    $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

    //include block notifications
    $userID = $uID;
    include(ROOT_PATH."notifications/unblock.php");

    $genInfo->redirect(BASE_URL.'administrator/customer-summary?uid='.$uID.'&unblocked');
    exit();
  }

  //Block User
  if(isset($_POST['block'])) {
    //Update user table
    $stmt = $genInfo->runQuery("UPDATE users 
      SET status='Blocked'
      WHERE login_id=:uID");     
    $stmt->execute(array(':uID'=>$uID));

    //Insert Into user notification table
    $action = 'The administrator has UnBlocked your account!';
    $actionUrl = 'user/';
    $type = 'Account Blocked';

    $genInfo->userNotification($uID, $action, $type, $actionUrl, $currentTime);

    //Insert Into admin notification table
    $action = $admInfo['username'].', has blocked user account';
    $actionUrl = 'customer-summary?uid='.$uID;
    $type = 'Account Restricted';
    $username = $admInfo['username'];

    $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

    //include block notifications
    $userID = $uID;
    include(ROOT_PATH."notifications/block.php");

    $genInfo->redirect(BASE_URL.'administrator/customer-summary?uid='.$uID.'&blocked');
    exit();
  }

  //delete User
  if(isset($_POST['delete'])) {
    //Update user table
    $stmt = $genInfo->runQuery("DELETE FROM users
      WHERE login_id=:uID");     
    $stmt->execute(array(':uID'=>$uID));

    //Insert Into admin notification table
    $action = $admInfo['username'].', has deleted user account';
    $actionUrl = 'customer-summary?uid='.$uID;
    $type = 'Account deleted';
    $username = $admInfo['username'];

    $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);

    $genInfo->redirect(BASE_URL.'administrator/customer-summary?uid='.$uID.'&blocked');
    exit();
  }

  $pageTitle = "Admin: Profile summary";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'summary';

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
        <li><a href="<?php echo BASE_URL;?>administrator">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL;?>administrator/customers">Customers</a></li>
        <li class="active"> <?php echo '#'.$uID.' - '.$uInfo['first_name'].' '.$uInfo['last_name'];?></li>
    </ol>
</div>
</div>
                        
<div class="row">
  <div class="col-lg-12">
    <div class="card-box">
                              
<?php include(ROOT_PATH."administrator/includes/customerNav.php");?>

  <div class="row">
    <div class="col-lg-4">
      <div class="panel panel-default" style="border:1px solid #f5f5f5;">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <h3 class="panel-title">Customer Information</h3>
        </div>

        <!-- Table -->
        <table class="table">
          <tbody>
            <tr>
              <td>First Name: </td>
              <td><?php echo $uInfo['first_name'];?></td>
            </tr>
            <tr>
              <td>Last Name: </td>
              <td><?php echo $uInfo['last_name'];?></td>
            </tr>
            <tr>
              <td>Gender: </td>
              <td><?php echo $uInfo['gender'];?></td>
            </tr>
            <tr>
              <td>Email: </td>
              <td><?php echo $uInfo['email'];?></td>
            </tr>
            <tr>
              <td>Phone: </td>
              <td><?php echo $uInfo['phone'];?></td>
            </tr>
            <tr>
              <td>Location: </td>
              <td><?php echo $uInfo['location'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="panel panel-default" style="border:1px solid #f5f5f5;">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <h3 class="panel-title">Provide Help orders</h3>
        </div>

        <!-- Table -->
        <table class="table">
          <tbody>
            <tr>
              <td>Paid: </td>
              <td><?php echo $defaultCurrency['c_symbol'].number_format($totalPaid);?>
                (<?php echo number_format($countPHOrder);?>)
              </td>
            </tr>
            <tr>
              <td>Unpaid/Due: </td>
              <td><?php echo $defaultCurrency['c_symbol'].number_format($totalUnpaid);?>
                (<?php echo number_format($countUnpaidPH);?>)
              </td>
            </tr>
            <tr>
              <td>Total PH: </td>
              <td><b><?php echo $defaultCurrency['c_symbol'].number_format($sumAllpaidPH);?></b></td>
            </tr>
            
          </tbody>
        </table>
        <div class="panel-body">
          <a href="<?php echo BASE_URL.'administrator/customer-orders?uid='.$uID;?>">View all</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="panel panel-default" style="border:1px solid #f5f5f5;">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <h3 class="panel-title">Get Help Orders</h3>
        </div>

        <!-- Table -->
        <table class="table">
          <tbody>
            <tr>
              <td>Completed: </td>
              <td><b><?php echo $defaultCurrency['c_symbol'].number_format($sumTotalGH);?></b> 
              (<?php echo number_format($countCompletedGH);?>)</td>
            </tr>
            <tr>
              <td>Uncompleted: </td>
              <td><b><?php echo $defaultCurrency['c_symbol'].number_format($sumTotalGHbanlance);?></b> (<?php echo number_format($countUncompletedGH);?>)</td>
            </tr>
            
            <tr>
              <td>Total GH: </td>
              <td><b><?php echo $defaultCurrency['c_symbol'].number_format($sumAllpaidGH);?></b></td>
            </tr>
            
          </tbody>
        </table>
        <div class="panel-body">
          <a href="<?php echo BASE_URL.'administrator/customer-gh-orders?uid='.$uID;?>">View all</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-4">
      <div class="panel panel-default" style="border:1px solid #f5f5f5;">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <h3 class="panel-title">Other Information</h3>
        </div>
        <!-- Table -->
        <table class="table">
          <tbody>
            <tr>
              <td>Status: </td>
              <td><?php if($uInfo['status'] == '1' 
                  OR $uInfo['status'] == 'Active'){echo 'Active';}else{echo $uInfo['status'];}?></td>
            </tr>
            <tr>
              <td>Signup Date: </td>
              <td><?php echo strftime("%B %d, %Y", strtotime($uInfo["signup_date"]));?></td>
            </tr>
            <tr>
              <td>Last Login: </td>
              <td>
                Date: <?php echo  $genInfo->timeAgo($uInfo["last_login"]);?><br>
                IP Address: 41.184.178.86
              </td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="panel panel-default" style="border:1px solid #f5f5f5;">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <h3 class="panel-title">Other Actions</h3>
        </div>
        <div class="panel-body">
        <?php if($uInfo["status"] == 1 
              OR $uInfo["status"] == 'Active'){?>
          <form action="" method="post">
            <button name="block" class="btn btn-default btn-sm">Block User Account</button>
          </form>
        <?php }else{?>
          <form action="" method="post">
            <button name="unBlock" class="btn btn-warning btn-sm">Unblock User Account</button>
          </form>
        <?php }?>
        <br>
        <form action="" method="post">
          <button name="delete" class="btn btn-danger btn-sm">Delete User Account</button>
        </form>
        </div>
      </div>
    </div>

  </div>
  <!-- end row -->

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