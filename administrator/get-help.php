<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  $myGHs = $adm->myGHs();
  $customers = $adm->customers();

  //$countPHs = $front->countPHs($loginID);



  //
  if(isset($_POST['userID'])){
    $userID = strip_tags($_POST['userID']);
    $amount = strip_tags($_POST['amount']);
    
    //Php Validation
    if($userID == "") {
      $error[] = "Please valid user to add to Receive list";
    } 
    else if($amount == "") {
      $error[] = "Please enter Receive Amount!";
    }else{
      //
      try {
        //Check if user adds account
         $stmt = $genInfo->runQuery("SELECT COUNT(*) AS checkAcct FROM bank_info 
          WHERE login_id=:userID");
        $stmt->execute(array(':userID'=>$userID));
        $acctChecks = $stmt->fetch(PDO::FETCH_ASSOC);

        if($acctChecks['checkAcct'] < 1){
          $error[] = "This user has not added Bank Account Information!";
        }else{
          $stmt = $genInfo->runQuery("INSERT INTO get_help (login_id, g_amount, g_status, req_date)
          VALUES(:userID, :amount, 'Available', :currentTime)");          
          $stmt->execute(array(':userID'=>$userID, ':amount'=>$amount, ':currentTime'=>$currentTime));

          $genInfo->redirect(BASE_URL.'administrator/get-help?added');
          exit();
        }
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    } 
  }

  //
  if(isset($_POST['ghRequest'])){
    $phID = intval($_POST['phID']);

    $ph = $adm->myPHsingle($phID);
    
    //Php Validation
    if($ph["matured_date"] > $currentTime) {
      $error[] = "Donate Still maturing...!";
    }

    if($ph["gh_status"] == 1) {
      $error[] = "You can not make Receive request twice!";
    }
    
    if(!isset($error)){
      try {        
        $stmt = $genInfo->runQuery("INSERT INTO get_help(
            login_id, g_amount, g_status, req_date)

          VALUES(:loginID, :amount, 'Pending', :currentTime)");
      
      $stmt->execute(array(':loginID'=>$loginID, ':amount'=>$ph['amount'], ':currentTime'=>$currentTime));

      //
      $stmt = $genInfo->runQuery("UPDATE provide_help 
        SET gh_status=1 WHERE ph_id=:phID");      
      $stmt->execute(array(':phID'=>$ph['ph_id']));

      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }

    $genInfo->redirect(BASE_URL.'administrator/get-help?submitted');
    exit();
  }

  $pageTitle = "Get Help";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'addresses';

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
<link href="assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css">

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

  <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
  <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
  <link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- for Add more dynamic Input -->
<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
              <li><a href="<?php echo BASE_URL;?>administrator/dashboard">Dashboard</a></li>
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
  <?php } }elseif(isset($_GET['added'])){?>
   <div class="alert alert-success">
      <i class="fa fa-check-square"></i> &nbsp; User added!
   </div>
  <?php }elseif(isset($_GET['warning']) AND $_GET['un'] != ''){?>
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you really want to delete this Admin User: 
        <b><?php echo $_GET['un'];?></b>? 
        <a href="<?php echo BASE_URL.'administrator/admin-manager?un='.$_GET['un'].'&true';?>">Yes</a> | 

        <a href="<?php echo BASE_URL.'administrator/admin-manager';?>">No</a>
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
     <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Add to list</a>
  </div>
</div>

<div class="table-responsive">
<?php if(!empty($myGHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>#</th>
        <th>User</th>
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
          $sumPaidGHs = $adm->sum_paidGHs($gh['gh_id']);
          $uInfo = $adm->userInfo($gh['login_id']);?>
      <tr>  
        <td><?php echo $i; ?></td>
        <td><a target="_blank" style="color:#0099CC" href="<?php echo BASE_URL.'administrator/customer-summary?uid='.$gh['login_id'];?>"><?php echo $uInfo['first_name'].' '.substr($uInfo['last_name'], 0, 1);?>.</a></td>
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
        <td><?php echo strftime("%b %d, %Y", strtotime($gh['req_date']));?></td>
        <td><a title="View History" href="<?php echo BASE_URL.'administrator/gh-orders?ghid='.$gh['gh_id'];?>" class="table-action-btn">
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

<!-- Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Active Users</h4>
    <div class="custom-modal-text text-left">
        <form role="form" action="" method="post">
          <div class="row">
            <div class="col-lg-12">
<div class="form-group">
  <label for="role">Select User</label>
  <select class="form-control" name="userID" id="userID" required>
    <?php if(isset($userID)){?>
      <option value="<?php echo $userID;?>">
      <?php echo $userID;?></option>
    <?php }?>

    <option value="">---Select---</option>
  <?php $ii=0; foreach($customers as $cust){ $ii++;?>
    <?php if($cust['status'] == 'Active'){?>
      <option value="<?php echo $cust['login_id'];?>"><?php echo $ii.'). '.$cust['first_name'].' '.$cust['last_name'];?></option>
    <?php }?>
  <?php }?>
  </select>
</div>

              <div class="form-group">
                <label for="amount">GH Amount</label>
                <input type="number" class="form-control" placeholder="Enter amount" id="amount" name="amount" required
                value="<?php if(isset($amount)){echo $amount;}?>">
              </div>

            </div>
          </div>
          
          <button type="submit" class="btn btn-default waves-effect waves-light">Add To GH</button>

          <button type="reset" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">Cancel</button>
        </form>
    </div>
</div>

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


<script>
    jQuery(document).ready(function() {

        //advance multiselect start
        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        // Select2
        $(".select2").select2();
        
        $(".select2-limiting").select2({
  maximumSelectionLength: 2
});

 $('.selectpicker').selectpicker();
      $(":file").filestyle({input: false});
      });
      
      //Bootstrap-TouchSpin
      $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'ion-plus-round',
        verticaldownclass: 'ion-minus-round'
    });
    var vspinTrue = $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    if (vspinTrue) {
        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
    }

    $("input[name='demo1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
    $("input[name='demo2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: '$'
    });
    $("input[name='demo3']").TouchSpin();
    $("input[name='demo3_21']").TouchSpin({
        initval: 40
    });
    $("input[name='demo3_22']").TouchSpin({
        initval: 40
    });

    $("input[name='demo5']").TouchSpin({
        prefix: "pre",
        postfix: "post"
    });
    $("input[name='demo0']").TouchSpin({});
    
    
    //Bootstrap-MaxLength
    $('input#defaultconfig').maxlength()
    
    $('input#thresholdconfig').maxlength({
        threshold: 20
    });

    $('input#moreoptions').maxlength({
        alwaysShow: true,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger"
    });

    $('input#alloptions').maxlength({
        alwaysShow: true,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger",
        separator: ' out of ',
        preText: 'You typed ',
        postText: ' chars available.',
        validate: true
    });

    $('textarea#textarea').maxlength({
        alwaysShow: true
    });

    $('input#placement') .maxlength({
            alwaysShow: true,
            placement: 'top-left'
        });
</script>