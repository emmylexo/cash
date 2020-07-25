<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");  
  require_once(ROOT_PATH . "core/session.php");
  
  $news = $front->news();

  $pageTitle = "Latest News";
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
              <li class="active">Latest News</li>
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
      <i class="fa fa-check-square"></i> &nbsp; Admin role added successfully!
   </div>
  <?php }elseif(isset($_GET['warning']) AND $_GET['un'] != ''){?>
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you really want to delete this Admin User: 
        <b><?php echo $_GET['un'];?></b>? 
        <a href="<?php echo BASE_URL.'user/admin-manager?un='.$_GET['un'].'&true';?>">Yes</a> | 

        <a href="<?php echo BASE_URL.'user/admin-manager';?>">No</a>
     </div>
  <?php }?>

  <div class="col-lg-12">
    <div class="card-box">

<div class="table-responsive">
  <?php if(!empty($news)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <!--<thead>
      <tr>
        <th>#</th>
        <th>Subject</th>
        <th>Date Added</th>
      </tr>
    </thead>-->
    <tbody>
  <?php $i = 0; 
        foreach ($news as $new) { $i++;?>
      <tr>  
        <td><?php echo $i;?></td>        
        <td><a href="<?php echo BASE_URL.'user/new?nid='.$new['id'];?>"><?php echo $new['subject'];?></a> </td>
        <td><?php echo $genInfo->timeAgo($new['date_added']);?></td>
      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>
    <p>No record found</p>
  <?php }?>
</div>
</div>
        
    </div> <!-- end col -->                
</div>

            
            
            

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