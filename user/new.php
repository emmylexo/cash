<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/frontEnd-wrapper.php");  
  require_once(ROOT_PATH . "core/session.php");
  
  if(isset($_GET['nid']) AND $_GET['nid'] != ''){
    $id = intval($_GET['nid']);
  }else{
    $genInfo->redirect(BASE_URL.'user/news');
    exit();
  }

  $new = $front->newSingle($id);
  if(empty($new)){
    $genInfo->redirect(BASE_URL.'user/news');
    exit();
  }

  try{
    //Add user to reader
    $readers = $new['readers'].', '.$userInfo['login_id'];
    $stmt = $genInfo->runQuery("UPDATE news 
      SET readers=:readers
      WHERE id=:id");
    $stmt->execute(array(":readers"=>$readers, ":id"=>$id));
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }

  $pageTitle = $new['subject'];
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
              <li><a href="<?php echo BASE_URL;?>user/news">News</a></li>
              <li class="active">News Details</li>
          </ol>
        </div>
    </div>
        
<div class="row">
  <div class="col-lg-12">
    <h3><?php echo $new['subject'];?></h3>
    <div class="card-box">
      <?php echo $new['content'];?>
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