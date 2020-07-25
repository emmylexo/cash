<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  if(isset($_GET['msgid']) AND $_GET['msgid'] != ''){
    $msgID = intval($_GET['msgid']);
  }else{
    $genInfo->redirect(BASE_URL.'administrator/messages');
    exit();
  }

  $msg = $adm->messageSingle($msgID);
  $userID = $msg['sender_id'];
  //
  $admInfo = $adm->admInfo($msg['admin_id']);
  if(empty($msg)){
    $genInfo->redirect(BASE_URL.'administrator/messages');
    exit();
  }

  //Update message, set as read
  try {
    $stmt = $genInfo->runQuery("UPDATE messaging SET status=1
      WHERE msg_id=:msgID");
    $stmt->execute(array(':msgID'=>$msgID));
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }

  //Grab user info
  if(isset($_POST['message'])) {
    $message = $_POST['message'];
    
    //Validate
    if($message == "") {
      $error[] = 'You can not send empty message, please enter message!';
    } 

    if(!isset($error)){
      try {
        //Set order number
        $msgNumber = mt_rand();

        //INSERT INTO MESSAGE TABLE
        $subject = 'Re: '.$msg['subject'];
        $stmt = $genInfo->runQuery("INSERT INTO messaging (msg_number, admin_id, receiver_id, subject, message, date_sent, attachment)

            VALUES (:msgNumber, :adminID, :receiverID, :subject, :message, :currentTime, :attachment)");

        $stmt->execute(array(
          ':msgNumber'=>$msgNumber,
          ':adminID'=>$adminID,
          ':receiverID'=>$userID,
          ':subject'=>$subject, 
          ':message'=>$message,
          ':currentTime'=>$currentTime,
          ':attachment'=>$target_path));
        $msgID = $genInfo->lastInsertId();
        
        //include merge notifications
        include(ROOT_PATH."notifications/message.php");

        //Insert Into user notification table
        $action = 'administrator has responded to your message';
        $actionUrl = 'user/message?msgid='.$msgID;
        $type = 'New Message';

        $genInfo->userNotification($payeeInfo['login_id'], $action, $type, $actionUrl, $currentTime);
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/message?msgid='.$msgID.'&message-sent');
      exit();
    }
  }

  $pageTitle = $msg['subject'];
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css">
 <!-- Plugins css-->
<link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- File Upload css-->
<link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />

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
    <li class="active">Read mail</li>
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
    <div class="col-lg-12">
        <div class="btn-toolbar m-t-20" role="toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-primary waves-effect waves-light "><i class="fa fa-inbox"></i></button>
                <button type="button" class="btn btn-primary waves-effect waves-light "><i class="fa fa-exclamation-circle"></i></button>
                <button type="button" class="btn btn-primary waves-effect waves-light "><i class="fa fa-trash-o"></i></button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-folder"></i>
                <b class="caret"></b>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#fakelink">Action</a></li>
                    <li><a href="#fakelink">Another action</a></li>
                    <li><a href="#fakelink">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#fakelink">Separated link</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-tag"></i>
                <b class="caret"></b>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#fakelink">Action</a></li>
                    <li><a href="#fakelink">Another action</a></li>
                    <li><a href="#fakelink">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#fakelink">Separated link</a></li>
                </ul>
            </div>
            
            <div class="btn-group">
                <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  More
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#fakelink">Dropdown link</a></li>
                  <li><a href="#fakelink">Dropdown link</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End row -->


<div class="row">
  <div class="col-sm-12">
    <div class="card-box m-t-20">
      <h4 class="m-t-0"><b><?php echo $msg['subject'];?></b></h4>
      
      <hr/>
      
      <div class="media m-b-30 ">
              <a href="#" class="pull-left">
            <?php if(file_exists(ROOT_PATH.str_replace('../', '', $admInfo['photo'])) AND $admInfo['photo'] != ''){?>
                <img alt="Admin" src="<?php echo $admInfo['photo'];?>" class="media-object thumb-sm img-circle">
              <?php }else{?>                
                <i style="font-size:25px;" class="ti-user"></i> 
        <?php }?>
              </a>
              <div class="media-body">
                  <span class="media-meta pull-right"><?php echo $genInfo->timeAgo($msg['date_sent']);?></span>
                  <h4 class="text-primary m-0"><?php echo $admInfo['full_name'];?></h4>
                  <small class="text-muted">From: <?php echo $admInfo['email'];?></small>
              </div>
          </div> <!-- media -->

          <?php echo $msg['message'];?>

          <hr/>

          <!--<h4> <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span> </h4>

          <div class="row">
            <div class="col-sm-2 col-xs-4">
                <a href="#"> <img src="assets/images/small/img1.jpg" alt="attachment" class="img-thumbnail img-responsive"> </a>
            </div>
            <div class="col-sm-2 col-xs-4">
                <a href="#"> <img src="assets/images/small/img2.jpg" alt="attachment" class="img-thumbnail img-responsive"> </a>
            </div>
            <div class="col-sm-2 col-xs-4">
                <a href="#"> <img src="assets/images/small/img3.jpg" alt="attachment" class="img-thumbnail img-responsive"> </a>
            </div>
          </div>-->
    </div>

  </div>
</div>


<div class="row">
<?php if($msg['admin_id'] == 0){?>
<form action="" method="post">
<div class="col-sm-12">
  <div class="media m-b-0">
    
      <div class="media-body">
        <div class="card-box p-0">
          <div class="form-group">
            <textarea class="summernote" required name="message"><?php if(isset($message)){echo $message;}?></textarea>
          </div>
        </div>
      </div>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-primary waves-effect waves-light w-md m-b-30">Send</button>
  </div>

  </div>
  </form>
  <?php }?>
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
            height: 90,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote 
        });
    });
</script>