<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");

  //Create an Object of ADMIN class
  $adminInfo = new ADMIN();
  if(isset($_GET['pid'])){
    $pid = intval($_GET['pid']);
  }
  else{
    $genInfo->redirect(BASE_URL.'administrator/products');
    exit();
  }

  $product = $genInfo->productSingle($pid);
  $featuredIMG = $genInfo->featuredIMG($pid);
  $galleryIMG = $genInfo->galleryIMG($pid);

  //Include script that runs update item form data
  include(ROOT_PATH."administrator/includes/edit-productScript.php");

  //Delete a single gallery IMG
  if(isset($_GET['imgID'])){
    $imgID = intval($_GET['imgID']);
    try{
      $stmt = $genInfo->runQuery("SELECT * FROM product_images 
        WHERE img_id=:imgID");
      $stmt->execute(array(":imgID"=>$imgID));
      $img = $stmt->fetch(PDO::FETCH_ASSOC);

      $filepath = ROOT_PATH.str_replace('../', '', $img['img_url']);
      //delete from directory
      if(file_exists($filepath)){
        unlink($filepath);
      }

      $stmt = $genInfo->runQuery("DELETE FROM product_images 
        WHERE img_id=:imgID");
      $stmt->execute(array(":imgID"=>$imgID));
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/product-edit?pid='.$pid.'&Removed');
    exit();
  }

  //send a warning for product deletion
  if(isset($_GET['delete'])){
    $genInfo->redirect(BASE_URL.'administrator/product-edit?pid='.$pid.'&warning');
    exit();
  }
  //Delete all images of a single product
  if(isset($_GET['yes-delete'])){
    $productImages = $adminInfo->productImages($pid);
    
    try{
      //loop through single image in the array
      foreach ($productImages as $img) {
        $filepath = ROOT_PATH.str_replace('../', '', $img['img_url']);
        //delete image from directory
        if(file_exists($filepath)){
          unlink($filepath);
        }
        //Now delete all the product images from table
        $stmt = $genInfo->runQuery("DELETE FROM product_images 
          WHERE pid=:pid");
        $stmt->execute(array(":pid"=>$pid));
      }

      //Now delete the product from table
      $stmt = $genInfo->runQuery("DELETE FROM products 
        WHERE pid=:pid");
      $stmt->execute(array(":pid"=>$pid));
    }      
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    
    $genInfo->redirect(BASE_URL.'administrator/products');
    exit();
  }


  $pageTitle = "Admin: Edit Product";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
 <!-- Plugins css-->
<link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- File Upload css-->
<link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />

<!-- for Add more dynamic Input -->
<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


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
                                    <li><a href="<?php echo BASE_URL;?>administrator/products">Products</a></li>
                                    <li class="active">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                        
              <div class="row">
                <form class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data" data-parsley-validate novalidate>
                <?php
                      if(isset($error)){
                          foreach($error as $error){?>
                           <div class="alert alert-danger">
                              <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                           </div>
                  <?php } }if(isset($_GET['added'])){?>
                   <div class="alert alert-success">
                      <i class="fa fa-check-square"></i> &nbsp; Product added successfully!
                   </div>
              <?php }if(isset($_GET['warning'])){?>
                   <div class="alert alert-danger">
                      <i class="fa fa-exclamation-triangle"></i> &nbsp; Are you sure you want to delete this Product? 
                      <a href="<?php echo BASE_URL.'administrator/product-edit?pid='.$pid.'&yes-delete';?>">Yes</a> | 
                      <a href="<?php echo BASE_URL.'administrator/product-edit?pid='.$pid;?>">No</a>
                   </div>
              <?php }?>
  							<div class="col-lg-8">
  								<div class="card-box">
                    <h4>Edit Product Information</h4>
                    <hr>
                    <input type="text" name="productName" parsley-trigger="change" required class="form-control" placeholder="Product Name"
                    value="<?php if(isset($product['p_name'])){echo $product['p_name'];}?>">
                        <br>
                    <textarea id="elm1" name="desc"><?php if(isset($product['p_desc'])){echo $product['p_desc'];}?></textarea>
  								</div>
                  <!-- Inlude product configuration file -->
                  <?php include(ROOT_PATH."administrator/includes/edit-product-config.php");?>

                  <div class="card-box">
                    <h4>Short Product Description</h4>
                    <hr>
                    <textarea id="shortDesc" name="shortDesc" 
                    style="height:100px;" 
                    ><?php if(isset($product['p_short_desc'])){echo $product['p_short_desc'];}?></textarea>
                  </div>

  							</div>
  							
  							<div class="col-lg-4">
                  <!-- Inlude product categories file -->
                  <?php include(ROOT_PATH."administrator/includes/edit-product-categories.php");?>

                  <!-- Inlude product tags file -->
                  <?php include(ROOT_PATH."administrator/includes/edit-product-tags.php");?>

                  <!-- Inlude product Images file -->
                  <?php include(ROOT_PATH."administrator/includes/edit-product-images.php");?>
                  
  				      </div>

              <div class="col-lg-12"> 
                <div class="row">
                    <div class="col-sm-12">
                        <hr />
                        <div class="text-center p-20">
                            <a href="<?php echo BASE_URL;?>administrator/products" class="btn w-sm btn-white waves-effect">Cancel</a>

                            <input type="submit"  class="btn w-sm btn-default" 
                            value="Update">

                          <a href="<?php echo BASE_URL.'administrator/product-edit?pid='.$pid.'&delete';?>"  class="btn w-sm btn-danger waves-effect waves-light">Delete</a>
                        </div>
                    </div>
                </div>
              </div>
          </form>
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

<!-- Used for short description-->
<script type="text/javascript">
    $(document).ready(function () {
        if($("#shortDesc").length > 0){
            tinymce.init({
                selector: "textarea#shortDesc",
                theme: "modern",
                height:100,
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

 <!-- Product Tags-->
<script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>



<!-- Auto number-->
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

<script type="text/javascript">
    
jQuery(function($) {
  $('.autonumber').autoNumeric('init');    
});

</script>


<!-- jQuery  -->
<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {        
      $('.selectpicker').selectpicker();
      $(":file").filestyle({input: false});
    });              
</script>