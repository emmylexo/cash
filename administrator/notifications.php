<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php"); 
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");
  
  $notifications = $adm->notifications();

  //Update Photo
  if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != "") {
    try {
      $stmt = $genInfo->runQuery("SELECT * FROM admin 
        WHERE id=:admID");
      $stmt->execute(array(':admID'=>$admInfo['id']));
      $checkPhoto = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo $e->getMessage();
    }

    if($checkPhoto["photo"] != ''){
      $toDelete = ROOT_PATH.str_replace('../', '', $checkPhoto['photo']);
      if(file_exists($toDelete)){
        unlink($toDelete);
      }
    }

    $target_path = "../img/admin/";
    $validextensions = array("jpeg", "jpg", "png");
    $ext = explode('.', basename($_FILES['photo']['name'])); 
    $file_extension = end($ext); 
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
    if (($_FILES["photo"]["size"] < 300000000)
    && in_array($file_extension, $validextensions)) {
      if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
        // Update
        $stmt = $genInfo->runQuery("UPDATE admin 
          SET photo=:photo WHERE id='1'");
        $stmt->execute(array(':photo'=>$target_path));
        $genInfo->redirect(BASE_URL.'administrator/admin-profile?Uploaded');
        exit();
      } else {     //  If File Was Not Moved.
        $error[] = '). please try again!.<br/>';
      }
    } else {     //   If File Size And File Type Was Incorrect.
      $error[] = '). ***Invalid file Size or Type***<br/>';
    }     
  }

  $pageTitle = "Admin Profile";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="wraper container-fluid">
        
        
  <div class="row">
 <div class="col-md-8">
  <div class="card-box m-t-20">
    <h4 class="m-t-0 header-title"><b>All Notifications</b></h4>
    <div class="p-20">
      <div class="timeline-2">
        <?php if(!empty($notifications)){
                foreach ($notifications as $note) {;
                  $admPic = $adm->admInfoU($note['admin']);?> 
        
        <?php if($note['status'] == 0){?>
          <div class="time-item" style="background:#f8f8f8">
              <div class="item-info">
                <div class="text-muted"><?php echo $genInfo->timeAgo($note['date_added']);?></div>
                <h5><?php echo $note['type'];?></h5>
                <p><em>"<?php echo $note['action'];?> "</em></p>

                <form action="" method="post">
                  <input type="hidden" name="marknotfRead" value="<?php echo $note['id'];?>">
                  <button style="font-size:12px;position:absolute;top:60px;right:10px;background:none;border:none;color:#000;">Mark Read</button>
                </form>
              </div>
          </div>
        <?php }else{?>
          <div class="time-item">
            <div class="item-info">
              <div class="text-muted"><?php echo $genInfo->timeAgo($note['date_added']);?></div>
              <h5><?php echo $note['type'];?></h5>
              <p><em>"<?php echo $note['action'];?> "</em></p>

              <form action="" method="post">
                  <input type="hidden" name="marknotfUnread"  value="<?php echo $note['id'];?>">
                  <button style="font-size:12px;position:absolute;top:60px;right:10px;background:none;border:none;color:#000;">Mark Unread</button>
              </form>
            </div>
          </div>
        <?php }?>
        <hr style="margin:2px;">
        <?php }}?>
        </div>
    </div>
  </div>
  </div>
  </div>
</div> <!-- container -->
               
</div> <!-- content -->

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
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