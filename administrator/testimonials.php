<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");  
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");
  
  $testimonials = $adm->myTestimonials();

  //
  if(isset($_GET['did'])) {
    $tsID = intval($_GET['did']);
    try {      
      $stmt = $genInfo->runQuery("DELETE FROM testimonials
        WHERE id=:tsID LIMIT 1");     
      $stmt->execute(array(':tsID'=>$tsID));
     
      $genInfo->redirect(BASE_URL.'administrator/testimonials?deleted');
      exit();      
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  $pageTitle = "Testimonials";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";
  $pageSec = 'addresses';

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
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
        <li><a href="<?php echo BASE_URL;?>administrator/dashboard">Dashboard</a></li>
        <li class="active">Testimonials</li>
      </ol>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
      <section id="cd-timeline" class="cd-container">
          <?php if(!empty($testimonials)){
                foreach ($testimonials as $testimony) {
                  $usnInfo = $adm->userInfo($testimony['login_id']);?>
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
                  <span class="pull-right">
                    <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL.'administrator/testimonials?did='.$testimony['id'];?>">
                    <i class="fa fa-trash-o"></i></a>
                  </span>
                  
                  <span class="pull-right">
                    <a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'administrator/testimonial?tsid='.$testimony['id'];?>">Edit</a>
                    &nbsp;&nbsp;
                  </span>

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