<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'false';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  $slides = $adm->slides();

  //Insert Slide
  if(isset($_FILES['banner']['name']) 
    AND $_FILES['banner']['name'] != "") { 
    $title = strip_tags($_POST['title']);
    $url = strip_tags($_POST['url']);
    $descr = strip_tags($_POST['desc']);

    try {
      $target_path = "../img/slider/";
      $validextensions = array("jpeg", "jpg", "png");
      $ext = explode('.', basename($_FILES['banner']['name'])); 
      $file_extension = end($ext); 
      $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
      if (($_FILES["banner"]["size"] < 300000000)
      && in_array($file_extension, $validextensions)) {
        if (move_uploaded_file($_FILES['banner']['tmp_name'], $target_path)) {
          // Update
          $stmt = $genInfo->runQuery("INSERT INTO home_sliders(title, url, banner, descr, status)
            VALUES(:title, :url, :banner, :descr, '1')");
          $stmt->execute(array(':title'=>$title, ':url'=>$url, ':banner'=>$target_path, ':descr'=>$descr));
          
          $genInfo->redirect(BASE_URL.'administrator/content-homeslider?Added');
          exit();
        }
      }     
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  //Send slide delete warning
  if(isset($_GET['delete']) AND $_GET['id'] != ''){
    $genInfo->redirect(BASE_URL.'administrator/content-homeslider?id='.$_GET['id'].'&warning');
    exit();
  }

  //Delete slide
  if(isset($_GET['true']) AND $_GET['id'] != ''){
    $id = intval($_GET['id']);
    try {
      $stmt = $genInfo->runQuery("DELETE FROM home_sliders
        WHERE slide_id=:id");     
      $stmt->execute(array(':id'=>$id));
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/content-homeslider?deleted');
    exit();
  }

  $pageTitle = "Admin: Add Homepage Slides";
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
            <li><a href="<?php echo BASE_URL;?>administrator/">Content Manager</a></li>
            <li class="active">Homepage Slide</li>
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
<?php } }elseif(isset($_GET['Added'])){?>
 <div class="alert alert-success">
    <i class="fa fa-check-square"></i> &nbsp; Slide added!
 </div>
<?php }elseif(isset($_GET['warning'])){?>
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you want to delete this Slide? 
    <a href="<?php echo BASE_URL.'administrator/content-homeslider?id='.$_GET['id'].'&true';?>">Yes</a> |

    <a href="<?php echo BASE_URL.'administrator/content-homeslider';?>">
    No</a>
  </div>
<?php }?>

<form action="#" method="post" action=""  enctype="multipart/form-data">
<div class="col-lg-6">
	<div class="card-box">

			<div class="form-group">
				<label for="title">Title*</label>
				<input type="text" name="title" 
        class="form-control" id="title" value="<?php if(isset($title)){echo $title;}?>">
			</div>

      <div class="form-group">
        <label for="url">Link</label>
        <input id="url" name="url" type="text" class="form-control" 
        value="<?php if(isset($url)){echo $url;}?>">
      </div>
      
      <div class="form-group">
        <label for="banner">Banner * 
        <span style="color:red;font-size:12px;"><em>Best banner size: 870px by 432px</em></span></label>
        <input type="file" name="banner" class="filestyle" required>
      </div>  

      <div class="form-group">
        <label class="col-sm-12 control-label" for="desc">
        Description*</label>
        <div class="col-sm-12">
          <textarea name="desc" id="desc" class="form-control"
          ><?php if(isset($desc)){echo $desc;}?></textarea>
        </div>
      </div>

      <div class="clearfix"></div>
      <br>
      <div align="center">
      <button type="submit" class="btn btn-primary waves-effect waves-light">
        Add Slide
      </button>
      </div>
	</div>
</div>

</form>

<div class="col-lg-6">
	<div class="card-box">
    <h5 class="text-muted text-uppercase m-t-0 m-b-30"><b>
    Slides</b></h5>
    <div class="table-responsive">
      <table class="table table-actions-bar">
          <thead>
              <tr>
                  <th>Banner</th>
                  <th>Tittle</th>
                  <th>Status</th>
                  <th style="min-width:80px;text-align:right;">Action</th>
              </tr>
          </thead>

          <tbody>

  <?php if(!empty($slides)){
          foreach ($slides as $slide) {?>
              <tr>
                  <td>
                    <img src="<?php echo $slide['banner'];?>" 
                    alt="title="<?php echo $slide['title'];?>" 
                    title="<?php echo $slide['title'];?>" width="48" height="38">
                  </td>

                  <td><?php echo $slide['title'];?></td>

                  <td><?php if($slide['status'] == 1){?>
                  <span style="color: green;">Active</span>
                  <?php }else{?>
                    <span style="color: brown;">Inactive</span>
                    <?php }?>
                  </td>
                  
                  <td style="text-align:right;">
                    <a href="<?php echo BASE_URL.'administrator/content-homeslider-edit?id='.$slide['slide_id'];?>" class="table-action-btn"><i class="md md-edit"></i></a>

                    <a href="<?php echo BASE_URL.'administrator/content-homeslider?id='.$slide['slide_id'].'&delete';?>" class="table-action-btn"><i class="md md-close"></i></a>
                  </td>
              </tr>
            <?php }}?>
          </tbody>
      </table>
    </div>
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


