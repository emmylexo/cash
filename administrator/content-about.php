<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'false';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  //
  if(isset($_POST['area'])) {
    $title = strip_tags($_POST['title']);
    $content = $_POST['area'];
    //echo $content;exit();
    try {
      $stmt = $genInfo->runQuery("UPDATE contents 
        SET abt_title=:title, 
            about=:content 
        WHERE ctn_id='1'");     
      $stmt->execute(array(':title'=>$title, ':content'=>$content));
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/content-about?updated');
    exit();
  }

  $pageTitle = "Admin: About Us";
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
                                    <li><a href="<?php echo BASE_URL;?>administrator/content-about">Content Manager</a></li>
                                    <li class="active">About Us</li>
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
				<div class="col-sm-12">
                    <div class="card-box">
                        <form method="post" action="" method="post">
                            <label for="title">Title</label>
                            <input type="text" name="title" parsley-trigger="change" required class="form-control" id="title" value="<?php if(isset($siteInfo['abt_title'])){echo $siteInfo['abt_title'];}?>">
                                <br>
                            <textarea id="elm1" name="area"><?php if(isset($siteInfo['about'])){echo $siteInfo['about'];}?></textarea>
                            <br><br><br>
                            <div class="form-group text-center m-b-0">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                    Update
                                </button>
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


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!--form validation init-->
        <script src="assets/plugins/tinymce/tinymce.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "modern",
                        height:300,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });    
                }  
            });
        </script>