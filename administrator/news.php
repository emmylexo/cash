<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");
  
  $news = $adm->news();

  //send a warning for product deletion
  if(isset($_GET['delete']) AND $_GET['nid'] != ''){
    $nID = intval($_GET['nid']);
    $genInfo->redirect(BASE_URL.'administrator/news?nid='.$nID.'&warning');
    exit();
  }
  //Delete
  if(isset($_GET['true']) AND $_GET['nid'] != ''){    
    try{
      //Now delete the product from table
      $stmt = $genInfo->runQuery("DELETE FROM news 
        WHERE id=:id");
      $stmt->execute(array(":id"=>$_GET['nid']));
    }      
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    
    $genInfo->redirect(BASE_URL.'administrator/news?deleted');
    exit();
  }

  $pageTitle = "Latest News";
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
  <?php }if(isset($_GET['warning']) AND $_GET['nid'] != ''){?>
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you really want to delete this
        <a href="<?php echo BASE_URL.'administrator/news?nid='.$_GET['nid'].'&true';?>">Yes</a> | 

        <a href="<?php echo BASE_URL.'administrator/news';?>">No</a>
     </div>
  <?php }?>

  <div class="col-lg-12">
    <div class="card-box">

<div class="table-responsive">
  <?php if(!empty($news)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th>#</th>
        <th>Published by</th>
        <th style="min-width: 300px">Heading</th>
        <th>Date Added</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php $i = 0; 
        foreach ($news as $new) { $i++;?>
      <tr>  
        <td><?php echo $i;?></td>
        <td><?php echo $new['admin'];?></td>        
        <td><a href="<?php echo BASE_URL.'administrator/new?nid='.$new['id'];?>"><?php echo $new['subject'];?></a> </td>
        <td><?php echo $genInfo->timeAgo($new['date_added']);?></td>
        <td><a href="<?php echo BASE_URL.'administrator/news?nid='.$new['id'];?>&delete"><i class="ti-trash"></i></a> </td>  
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