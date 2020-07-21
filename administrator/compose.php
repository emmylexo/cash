<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  $users = $adm->customers();

  //Grab user info
  if(isset($_POST['to'])) {
    $to = strip_tags($_POST['to']);
    $subject = strip_tags($_POST['subject']);
    $message = $_POST['message'];
    
    //Validate
    if($to == "") {
      $error[] = 'Please select receiving user!';
    }
    if($subject == "") {
      $error[] = 'Please enter your message subject!';
    }
    if(strlen($subject) < 3 OR strlen($subject) > 100) {
      $error[] = 'Please let your subject be precise!';
    }
    if($message == "") {
      $error[] = 'You can not send empty message, please enter message!';
    } 

    if(!isset($error)){
      try {
        //Set order number
        $msgNumber = mt_rand();

        if($to == "all"){
          foreach ($users as $user) {
            //INSERT INTO MESSAGE TABLE
            $stmt = $genInfo->runQuery("INSERT INTO messaging (msg_number, admin_id, receiver_id, subject, message, date_sent)

                VALUES (:msgNumber, :adminID, :userID, :subject, :message, :currentTime)");

            $stmt->execute(array(
              ':msgNumber'=>$msgNumber,
              ':adminID'=>$admInfo['id'],
              ':userID'=>$user['login_id'],
              ':subject'=>$subject, 
              ':message'=>$message,
              ':currentTime'=>$currentTime));
            $msgID = $genInfo->lastInsertId();
            
            //include merge notifications
            $userID = $user['login_id'];
            //include(ROOT_PATH."notifications/message.php");

            //Insert Into user notification table
            $action = 'You have recieved a new message from the administrator';
            $actionUrl = 'user/message?msgid='.$msgID;
            $type = 'New Message';

            $genInfo->userNotification($user['login_id'], $action, $type, $actionUrl, $currentTime);
          }
        }
        else{
          //INSERT INTO MESSAGE TABLE
          $stmt = $genInfo->runQuery("INSERT INTO messaging (msg_number, admin_id, receiver_id, subject, message, date_sent)

                VALUES (:msgNumber, :adminID, :userID, :subject, :message, :currentTime)");

            $stmt->execute(array(
              ':msgNumber'=>$msgNumber,
              ':adminID'=>$admInfo['id'],
              ':userID'=>$to,
              ':subject'=>$subject, 
              ':message'=>$message,
              ':currentTime'=>$currentTime));
            $msgID = $genInfo->lastInsertId();

          //Insert Into user notification table
          $action = 'You have recieved a new message from the administrator';
          $actionUrl = 'user/message?msgid='.$msgID;
          $type = 'New Message';

          $genInfo->userNotification($to, $action, $type, $actionUrl, $currentTime);
          
          //include merge notifications
          $userID = $to;
          include(ROOT_PATH."notifications/message.php");
        }
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/compose?message-sent');
      exit();
    }
  }

  $pageTitle = "Admin: Message";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
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
  <li><a href="<?php echo BASE_URL;?>administrator/messages">Messages</a></li>
  <li class="active">Compose Mail</li>
</ol>
</div>
</div>

<?php
    if(isset($error)){
        foreach($error as $error){?>
         <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
         </div>
<?php } }elseif(isset($_GET['message-sent'])){?>
 <div class="alert alert-success">
    <i class="fa fa-check-square"></i> &nbsp; Message sent!
 </div>
<?php }?>
<div class="row">

<!-- Left sidebar -->
<div class="col-lg-3 col-md-4">
  <?php include(ROOT_PATH."administrator/includes/messageNav.php");?>
</div>
<!-- End Left sidebar -->

<!-- Right Sidebar -->
<div class="col-lg-9 col-md-8">

<div class="row">
<div class="col-sm-12">
  <div class="card-box m-t-20">
    <div class="p-20">
      <form role="form" action="" method="post">
        <div class="form-group">
          <label for="to">To*</label>
          <select class="selectpicker" data-live-search="true" 
            data-style="btn-white" required name="to">
            <option value="">--Select User--</option>
            <?php if(!empty($users)){
              foreach ($users as $user){?>
              <option value="<?php echo $user['login_id'];?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></option>
            <?php }}?>
            <option value="all">SEND TO ALL</option>
          </select>
        </div>
        <div style="clear: both;"></div>
        <br><br>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?php if(isset($subject)){echo $subject;}?>">
        </div>
        <div class="form-group">
          <textarea class="summernote" name="message"><?php if(isset($message)){echo $message;}?></textarea>
        </div>         
        <div class="btn-toolbar form-group m-b-0">
          <div class="pull-right">
            <button type="submit" class="btn btn-purple waves-effect waves-light"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
          </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>

<!-- End row -->
</div> <!-- end Col-9 -->
</div><!-- End row -->
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


<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!--form validation init-->
<script src="assets/plugins/summernote/dist/summernote.min.js"></script>

<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote 
        });
    });
</script>

<script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="assets/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


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