<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'false';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  //
  if(isset($_POST['siteName'])) {
    $siteName = strip_tags($_POST['siteName']);
    $siteTitle = strip_tags($_POST['siteTitle']);
    $siteUrl = strip_tags($_POST['siteUrl']);
    $phone = strip_tags($_POST['phone']);
    $siteDesc = strip_tags($_POST['siteDesc']);

    //Filter siteUlr
    $part = substr($siteUrl,0,7);
    if($part == "http://") {
      $error[] = 'Please enter recommended Site Address, Example: www.yoursite.com';
    }elseif($part == "https://"){
      $error[] = 'Please enter recommended Site Address, Example: www.yoursite.com';
    }else{
      //Check if it has www in front
      $part = substr($siteUrl,0,4);
      if($part != "www.") {
          $siteUrl = 'www.'.$siteUrl;
      }
      try {
        $stmt = $genInfo->runQuery("UPDATE website_settings 
          SET site_name=:siteName, 
              site_title=:siteTitle, 
              site_url=:siteUrl, 
              biz_phone=:phone,
              site_description=:siteDesc
          WHERE id='1'");     
        $stmt->execute(array(':siteName'=>$siteName, ':siteTitle'=>$siteTitle, ':siteUrl'=>$siteUrl, ':phone'=>$phone, ':siteDesc'=>$siteDesc));
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/website-settings?updated');
      exit();
    }
  }

  //Update Favicon
  if(isset($_FILES['favicon']['name']) AND $_FILES['favicon']['name'] != "") {
    try {
      $stmt = $genInfo->runQuery("SELECT * FROM website_settings WHERE id='1'");
      $stmt->execute();
      $checkLogo = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo $e->getMessage();
    }

    if($checkLogo["favicon_url"] != ''){
      $toDelete = ROOT_PATH.str_replace('../', '', $checkLogo['favicon_url']);
      if(file_exists($toDelete)){
        unlink($toDelete);
      }
    }

    $target_path = "../images/";
    $validextensions = array("jpeg", "jpg", "png");
    $ext = explode('.', basename($_FILES['favicon']['name'])); 
    $file_extension = end($ext); 
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
    if (($_FILES["favicon"]["size"] < 300000000)
    && in_array($file_extension, $validextensions)) {
      if (move_uploaded_file($_FILES['favicon']['tmp_name'], $target_path)) {
        // Update
        $stmt = $genInfo->runQuery("UPDATE website_settings 
          SET favicon_url=:favicon WHERE id='1'");
        $stmt->execute(array(':favicon'=>$target_path));
        $genInfo->redirect(BASE_URL.'administrator/website-settings?updated');
        exit();
      } else {     //  If File Was Not Moved.
        $error[] = '). please try again!.<br/>';
      }
    } else {     //   If File Size And File Type Was Incorrect.
      $error[] = '). ***Invalid file Size or Type***<br/>';
    }     
  }

  //Update logo
  if(isset($_FILES['logo']['name']) AND $_FILES['logo']['name'] != "") {
    try {
      $stmt = $genInfo->runQuery("SELECT * FROM website_settings WHERE id='1'");
      $stmt->execute();
      $checkLogo = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo $e->getMessage();
    }

    if($checkLogo["logo_url"] != ''){
      $toDelete = ROOT_PATH.str_replace('../', '', $checkLogo['logo_url']);
      if(file_exists($toDelete)){
        unlink($toDelete);
      }
    }

    $target_path = "../images/";
    $validextensions = array("jpeg", "jpg", "png");
    $ext = explode('.', basename($_FILES['logo']['name'])); 
    $file_extension = end($ext); 
    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
    if (($_FILES["logo"]["size"] < 300000000)
    && in_array($file_extension, $validextensions)) {
      if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) {
        // Update
        $stmt = $genInfo->runQuery("UPDATE website_settings 
          SET logo_url=:logo WHERE id='1'");
        $stmt->execute(array(':logo'=>$target_path));

        $genInfo->redirect(BASE_URL.'administrator/website-settings?updated');
        exit();
      } else {     //  If File Was Not Moved.
        $error[] = '). please try again!.<br/>';
      }
    } else {     //   If File Size And File Type Was Incorrect.
      $error[] = '). ***Invalid file Size or Type***<br/>';
    }     
  } 

  $pageTitle = "Admin: Website Settings";
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
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL;?>administrator">Dashboard</a></li>
                                    <li><a href="<?php echo BASE_URL;?>administrator/website-settings">Settings</a></li>
                                    <li class="active">Website Settings</li>
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
                <?php } }elseif(isset($_GET['updated'])){?>
                 <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; Site info updated successfully!
                 </div>
            <?php }?>
							<div class="col-lg-6">
								<div class="card-box">

									<form action="#" method="post" action="" data-parsley-validate novalidate>
										<div class="form-group">
											<label for="siteName">Site Name*</label>
											<input type="text" name="siteName" parsley-trigger="change" required 
                      class="form-control" id="siteName" value="<?php if(isset($siteInfo['site_name'])){echo $siteInfo['site_name'];}?>">
										</div>

										<div class="form-group">
											<label for="siteTitle">Site Title*</label>
											<input type="text" name="siteTitle" parsley-trigger="change" required 
                      class="form-control" id="siteTitle" value="<?php if(isset($siteInfo['site_title'])){echo $siteInfo['site_title'];}?>">
										</div>

                    <div class="form-group">
                      <label for="siteUrl">Site URL*</label>
                      <input id="siteUrl" name="siteUrl" type="text" required class="form-control" 
                      value="<?php if(isset($siteInfo['site_url'])){echo $siteInfo['site_url'];}?>">
                    </div>

                    <div class="form-group">
                      <label for="phone">Site Phone Number*</label>
                      <input id="phone" name="phone" type="number" required class="form-control" 
                      value="<?php if(isset($siteInfo['biz_phone'])){echo $siteInfo['biz_phone'];}?>">
                    </div>

                    <div class="form-group">
                      <label class="col-sm-12 control-label" for="siteDesc">Site Description</label>
                      <div class="col-sm-12">
                        <textarea name="siteDesc" id="siteDesc" required class="form-control"
                        ><?php if(isset($siteInfo['site_description'])){echo $siteInfo['site_description'];}?></textarea>
                      </div>
                    </div>
                    <div style="clear: both;"></div>

                    <br><br><br>
										<div class="form-group text-center m-b-0">
											<button class="btn btn-primary waves-effect waves-light" type="submit">
												Update
											</button>
										</div>
										
									</form>

								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="card-box">
                Favicon
									<form class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data"  data-parsley-validate novalidate>
										<div class="form-group"><br>
                      <img src="<?php echo $siteInfo["favicon_url"];?>" alt="Favicon">
                      <br>
                      <input type="file" name="favicon" class="filestyle" data-iconname="fa fa-cloud-upload">
                    </div>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-8">
												<button type="submit" class="btn btn-primary waves-effect waves-light">
													Update
												</button>
											</div>
										</div>

									</form>
								</div>

                <div class="card-box">
                  Logo
                  <form class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data" data-parsley-validate novalidate>
                    <div class="form-group"><br>
                      <img src="<?php echo $siteInfo["logo_url"];?>" alt="Logo">
                      <br>
                      <input type="file" name="logo" class="filestyle" data-iconname="fa fa-cloud-upload">
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                          Update
                        </button>
                      </div>
                    </div>

                  </form>
                </div>
							</div>
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

        <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="assets/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


        <script>
            jQuery(document).ready(function() {

                //advance multiselect start
                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                // Select2
                $(".select2").select2();
                
                $(".select2-limiting").select2({
          maximumSelectionLength: 2
        });
        
         $('.selectpicker').selectpicker();
              $(":file").filestyle({input: false});
              });
              
              //Bootstrap-TouchSpin
              $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'ion-plus-round',
                verticaldownclass: 'ion-minus-round'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
    
            $("input[name='demo1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='demo2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='demo3']").TouchSpin();
            $("input[name='demo3_21']").TouchSpin({
                initval: 40
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 40
            });
    
            $("input[name='demo5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });
            $("input[name='demo0']").TouchSpin({});
            
            
            //Bootstrap-MaxLength
            $('input#defaultconfig').maxlength()
            
            $('input#thresholdconfig').maxlength({
                threshold: 20
            });

            $('input#moreoptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger"
            });

            $('input#alloptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger",
                separator: ' out of ',
                preText: 'You typed ',
                postText: ' chars available.',
                validate: true
            });

            $('textarea#textarea').maxlength({
                alwaysShow: true
            });

            $('input#placement') .maxlength({
                    alwaysShow: true,
                    placement: 'top-left'
                });
        </script>


