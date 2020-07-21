<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php"); 
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

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
          SET photo=:photo WHERE id=:admiID");
        $stmt->execute(array(':photo'=>$target_path, ':admiID'=>$admInfo['id']));

        //INSERT NOTIFICATION TABLE
        $userActn = $admInfo['username'].' has changed his profile picture!';
        $actUrl = 'admin-profile?admu='.$admInfo['username'];
        $stmt = $genInfo->runQuery("INSERT INTO notifications (admin, action, type, action_url, date_added)
          VALUES (:userName, :userActn, 'Profile Update', :actUrl, :currentTime)");

        $stmt->execute(array(':userName'=>$admInfo['username'], ':userActn'=>$userActn, ':actUrl'=>$actUrl, ':currentTime'=>$currentTime));

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

  if(isset($_GET['admu'])){
    $username = $_GET['admu'];
    $admInfo = $adm->admInfoU($username);
  }

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
  <!-- Start content -->
  <div class="content">

    <div class="wraper container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="bg-picture text-center">
                    <div class="bg-picture-overlay"></div>
                    <div class="profile-info-name">
                        <?php if($admInfo['photo'] != ''){?>
                          <img src="<?php echo $admInfo['photo'];?>" 
                          alt="profile Photo" width="95" height="95">
                        <?php }else{?>
                          <i style="font-size:90px;" class="ti-user"></i> 
                        <?php }?>

                        <h4 class="m-b-5">
                        <b><?php echo $admInfo['username'];?></b>
                        </h4>

                        <p class="text-muted"><i class="fa fa-user-secret"></i> <?php echo $admInfo['role'];?></p>
                    <?php if(!isset($_GET['admu'])){?>
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                          <label for="photo" class="btn btn-success btn-sm">Change Photo</label>
                          <input style="display:none" type="file" name="photo" id="photo" onchange="this.form.submit()";>
                        </form>
                    <?php }?>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        
        
    <div class="row">
    <div class="col-md-6">
            
    <div class="card-box m-t-20">
    <h4 class="m-t-0 header-title"><b>Personal Information</b></h4>
    <div class="p-20">
      <div class="about-info-p">
          <strong>Full Name</strong>
          <br>
          <p class="text-muted"><?php echo $admInfo['full_name'];?></p>
      </div>
      <div class="about-info-p">
          <strong>Mobile</strong>
          <br>
          <p class="text-muted"><?php echo $admInfo['phone'];?></p>
      </div>
      <div class="about-info-p">
          <strong>Email</strong>
          <br>
          <p class="text-muted"><?php echo $admInfo['email'];?></p>
      </div>
      <div class="about-info-p m-b-0">
          <strong>Location</strong>
          <br>
          <p class="text-muted">
          <?php echo $admInfo['state'];?>, 
          <?php echo $admInfo['country'];?></p>
      </div>
    </div>
  </div>
  
  <!-- Personal-Information -->
  <div class="card-box">
    <h4 class="m-t-0 header-title"><b>Biography</b></h4>
    
    <div class="p-20">
      <p><?php echo nl2br($admInfo['bio']);?></p>
    </div>
  </div>
  <!-- Personal-Information -->
  
  
  <!-- 
  <div class="card-box">
    <h4 class="m-t-0 header-title"><b>Skills</b></h4>
    
    <div class="p-20">
      <div class="m-b-15">
          <h5>Angular Js <span class="pull-right">60%</span></h5>
          <div class="progress">
              <div class="progress-bar progress-bar-primary wow animated progress-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                  <span class="sr-only">60% Complete</span>
              </div>
          </div>
      </div>

      <div class="m-b-15">
          <h5>Javascript <span class="pull-right">90%</span></h5>
          <div class="progress">
              <div class="progress-bar progress-bar-pink wow animated progress-animated" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                  <span class="sr-only">90% Complete</span>
              </div>
          </div>
      </div>

      <div class="m-b-15">
          <h5>Wordpress <span class="pull-right">80%</span></h5>
          <div class="progress">
              <div class="progress-bar progress-bar-purple wow animated progress-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                  <span class="sr-only">80% Complete</span>
              </div>
          </div>
      </div>

      <div class="m-b-0">
          <h5>HTML5 &amp; CSS3 <span class="pull-right">95%</span></h5>
          <div class="progress">
              <div class="progress-bar progress-bar-info wow animated progress-animated" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">
                  <span class="sr-only">95% Complete</span>
              </div>
          </div>
      </div>
    </div>
  </div>
-->

  <div class="card-box">
    <h4 class="m-t-0 m-b-20 header-title"><b>Office Address</b></h4>
    
          <div class="gmap-info">
              <h4><b><a href="#" class="text-dark">
              <?php echo $siteInfo['biz_name'];?></a></b></h4>
              <p><?php echo $admInfo['address'];?></p>
              <p><?php echo $admInfo['city'];?>,
              <?php echo $admInfo['state'];?>,</p>
              <p><?php echo $admInfo['country'];?></p>
          </div>
          
          <div class="clearfix"></div>
  </div>
  <!-- Personal-Information -->
 </div>
 <div class="col-md-6">
  <div class="card-box m-t-20">
    <h4 class="m-t-0 header-title"><b>Activity</b></h4>
    <div class="p-20">
      <div class="timeline-2">
        <div class="time-item">
            <div class="item-info">
                <div class="text-muted">5 minutes ago</div>
                <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
            </div>
        </div>

        <div class="time-item">
            <div class="item-info">
                <div class="text-muted">30 minutes ago</div>
                <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
            </div>
        </div>

          <div class="time-item">
              <div class="item-info">
                  <div class="text-muted">59 minutes ago</div>
                  <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                  <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
              </div>
          </div>
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