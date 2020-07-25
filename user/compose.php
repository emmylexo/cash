<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");

  //Grab user info
  if(isset($_POST['subject'])) {
    $subject = strip_tags($_POST['subject']);
    $message = $_POST['message'];
    
    //Validate
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

        //INSERT INTO MESSAGE TABLE
        $stmt = $genInfo->runQuery("INSERT INTO messaging (msg_number, sender_id, subject, message, date_sent)

            VALUES (:msgNumber, :senderID, :subject, :message, :currentTime)");

        $stmt->execute(array(
          ':msgNumber'=>$msgNumber,
          ':senderID'=>$userInfo['login_id'],
          ':subject'=>$subject, 
          ':message'=>$message,
          ':currentTime'=>$currentTime));
        $msgID = $genInfo->lastInsertId();
        
        //include notification Email File
        //include(ROOT_PATH."emailTemplates/addPost_notify.php");

        //Insert Into admin notification table
        $action = 'A new message from the '.$userInfo['first_name'].' '.$userInfo['last_name'];
        $actionUrl = 'message?msgid='.$msgID;
        $type = 'New Message';
        $username = '';

        $genInfo->admNotification($username, $action, $type, $actionUrl, $currentTime);
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'user/compose?message-sent');
      exit();
    }
  }

  $pageTitle = "Message";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>
 <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

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
  <li><a href="<?php echo BASE_URL;?>user/dashboard">Dashboard</a></li>
  <li><a href="<?php echo BASE_URL;?>user/messages">Messages</a></li>
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
  <?php include(ROOT_PATH."user/includes/messageNav.php");?>
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