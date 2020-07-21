<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
  require_once(ROOT_PATH . "core/session.php");

  $sentMessages = $front->sentMessages($loginID);

  $pageTitle = "Sent Messages";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>
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
      <li><a href="<?php echo BASE_URL;?>user/dashboard">Dashboard</a></li>
      <li><a href="<?php echo BASE_URL;?>user/messages">Messages</a></li>
      <li class="active">Inbox</li>
    </ol>
  </div>
</div>

<div class="row">
<!-- Left sidebar -->
<div class="col-lg-3 col-md-4">
  <?php include(ROOT_PATH."user/includes/messageNav.php");?>
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
<li><a href="#">No Action</a></li>
</ul>
</div>
<div class="btn-group">
<button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<i class="fa fa-tag"></i>
<b class="caret"></b>
</button>
<ul class="dropdown-menu" role="menu">
<li><a href="#">No Action</a></li>
</ul>
</div>

<div class="btn-group">
<button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
More
<span class="caret"></span>
</button>
<ul class="dropdown-menu">
<li><a href="#">None</a></li>
</ul>
</div>
</div>
</div>
</div> <!-- End row -->

<div class="panel panel-default m-t-20">
  <div class="panel-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mails m-0">
      <tbody>
      <?php if(!empty($sentMessages)){
            foreach($sentMessages as $msg){?>
      <tr>
        <td class="mail-select">            
            <i class="fa fa-star text-warning m-r-15"></i>
            <i class="fa fa-circle m-l-5 text-success"></i>
            Administrator
        </td>
          
        <td>
            <a href="<?php echo BASE_URL.'user/message?msgid='.$msg['msg_id'];?>" class="email-msg"><?php echo substr($msg['subject'], 0, 60);?>...</a>
        </td>
        <td style="width: 20px;">
            <i class="fa fa-paperclip"></i>
        </td>
        <td class="text-right">
          <?php echo substr($genInfo->timeAgo($msg['date_sent']), 0, 10);?>
        </td>
      </tr>
      <?php }}else{?>
        <p>No record found</p>
      <?php }?>
      </tbody>
      </table>
    </div>

    </div> <!-- panel body -->
  </div> <!-- panel -->



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

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>

<!--form validation init-->
<script src="assets/plugins/tinymce/tinymce.min.js"></script>
 <!-- Product Tags-->
<script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>



<!-- Auto number-->
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

<script type="text/javascript">
    
jQuery(function($) {
  $('.autonumber').autoNumeric('init');    
});

</script>


<!-- jQuery  -->
<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {        
      $('.selectpicker').selectpicker();
      $(":file").filestyle({input: false});
    });              
</script>