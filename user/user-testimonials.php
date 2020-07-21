<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");  
  require_once(ROOT_PATH . "core/session.php");
  
  $testimonials = $front->myTestimonials($loginID);

  $pageTitle = "Testimonials";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'addresses';

  include(ROOT_PATH."user/includes/header.php"); 
  include(ROOT_PATH."user/includes/navMenu.php"); 
?>
<link href="assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
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
        <li><a href="<?php echo BASE_URL;?>user/dashboard">Account Settings</a></li>
        <li class="active">Testimonials</li>
      </ol>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
      <section id="cd-timeline" class="cd-container">
          <?php if(!empty($testimonials)){
                foreach ($testimonials as $testimony) {
                  $usnInfo = $front->userInfo($testimony['login_id']);?>
          <div class="cd-timeline-block">
              <div class="cd-timeline-img cd-pink">
              <?php if(file_exists(ROOT_PATH.str_replace('../', '', $usnInfo['photo'])) AND $usnInfo['photo'] != ''){?>
                <img alt="user" src="<?php echo $usnInfo['photo'];?>" class="thumb-sm img-circle" style="width:60px; height:60px;">
              <?php }else{?>                
                <i style="font-size:25px;" class="ti-user"></i> 
              <?php }?>
              </div> <!-- cd-timeline-img -->

              <div class="cd-timeline-content">
                <h3>
                  <?php echo $usnInfo['first_name'].' '.substr($usnInfo['last_name'], 0, 1);?>.
                  <?php if($testimony['status'] != 1){?>
                  <span class="pull-right">
                    <a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'user/user-testimonial?tsid='.$testimony['id'];?>">Edit</a>
                  </span>
                  <?php }?>
                </h3>
                <?php echo $testimony['content'];?>
                <br><br>

                <style type="text/css">
                  .videoClas{width:100%; height:auto;}
                </style>
                <?php echo str_replace('width=', 'class="videoClas" ',$testimony['video']);?>

                <span class="cd-date"><?php echo strftime("%b %d, %Y", strtotime($testimony["date_added"]));?></span>
              </div> <!-- cd-timeline-content -->
          </div> <!-- cd-timeline-block -->
          <?php }}else{?>
            <h3 style="background:#FFF;padding:10px;font-size:14px;">No record found</h3>
          <?php }?>

      </section> <!-- cd-timeline -->
  </div>
</div><!-- Row -->


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