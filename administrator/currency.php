<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'true';
  $editor = 'false';
  require_once(ROOT_PATH . "core/adminSession.php");

  //
  if(isset($_POST['country'])) {
    $country = strip_tags($_POST['country']);
    $cCode = strip_tags($_POST['cCode']);
    $cSymbol = $_POST['cSymbol'];

    if($country == "") {
      $error[] = 'Please select Country Currency';
    }elseif($cCode == ""){
      $error[] = 'Please select Currency Code';
    }elseif($cSymbol == ""){
      $error[] = 'Please select Currency Symbol';
    }else{
      try {
        $stmt = $genInfo->runQuery("INSERT INTO currencies (
          c_country, c_code, c_symbol, c_added_date) 
                        
        VALUES(:country, :cCode, :cSymbol, :currentTime)");     
        $stmt->execute(array(':country'=>$country, 
          ':cCode'=>$cCode, ':cSymbol'=>$cSymbol, ':currentTime'=>$currentTime));
      }

      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/currency?Added');
      exit();
    }
  }

  //Set defauly currency
  if(isset($_POST['defaultCurr'])) {
    $defaultCurr = strip_tags($_POST['defaultCurr']);

    try {
      //First set all row to 0
      $stmt = $genInfo->runQuery("UPDATE currencies SET c_default='0'");     
      $stmt->execute();
      //Then, set the new default to 1
      $stmt = $genInfo->runQuery("UPDATE currencies SET c_default='1'
        WHERE c_id=:defaultCurr");     
      $stmt->execute(array(':defaultCurr'=>$defaultCurr));
    }

    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/currency?default');
    exit();
  }

  //Remove Currency
  if(isset($_POST['cID'])) {
    $cID = strip_tags($_POST['cID']);
    try {
      $stmt = $genInfo->runQuery("DELETE FROM currencies 
        WHERE c_default='0' AND c_id=:cID");     
      $stmt->execute(array(':cID'=>$cID));
    }

    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $genInfo->redirect(BASE_URL.'administrator/currency?Removed');
    exit();
  }

  $pageTitle = "Admin: Currency Settings";
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
                                    <li><a href="<?php echo BASE_URL;?>administrator/currency">Settings</a></li>
                                    <li class="active">Currency Settings</li>
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
                <?php } }if(isset($_GET['Added'])){?>
                 <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; Success! Currency added.
                 </div>
            <?php }elseif(isset($_GET['default'])){?>
                 <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; Default currency updated!
                 </div>
            <?php }?>
							<div class="col-lg-6">
								<div class="card-box">
                <h4>Add Currency</h4>
                <hr>
									<form action="#" method="post" action="" data-parsley-validate novalidate>
										<div class="form-group">
											<label for="country">Country Currency</label>
											<select class="selectpicker" data-live-search="true"  data-style="btn-white" required name="country">
                          <option value="">---------------select---------------</option>
                          <?php include(ROOT_PATH."includes/countries.php"); ?>
                        </select>
										</div>

                    <div class="form-group">
                      <label for="cCode">Currency Code*</label>
                      <select class="selectpicker" data-live-search="true"  data-style="btn-white" required name="cCode">
                          <option value="">---------------select---------------</option>
                          <?php include(ROOT_PATH."includes/correncyCodes.php"); ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="cSymbol">Currency Symbol*</label>
                      <select class="selectpicker" data-live-search="true"  data-style="btn-white" required name="cSymbol">
                          <option value="">---------------select---------------</option>
                          <?php include(ROOT_PATH."includes/currencySymbols.php"); ?>
                        </select>
                    </div>

                    <div style="clear: both;"></div>
                    <br><br><br>
										<div class="form-group text-center m-b-0">
											<button class="btn btn-primary waves-effect waves-light" type="submit">
												Add Currecy
											</button>
										</div>
										
									</form>

								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="card-box">
                <h4>Default Currency</h4>
									<form class="form-horizontal" method="post" action="" role="form" enctype="multipart/form-data"  data-parsley-validate novalidate>
										<div class="form-group" style="max-width:300px;">
                      <select name="defaultCurr" class="selectpicker" data-style="btn-default btn-custom">
                          <option><?php echo $defaultCurrency['c_country'].' ('.$defaultCurrency['c_code'].') => '.$defaultCurrency['c_symbol'];?></option>

                          <?php if (!empty($currencies)) {
                                  $i = 0;
                                  foreach($currencies as $currency) {
                                  $i++; 
                          ?>
                            <option value="<?php echo $currency['c_id'];?>">
                            <?php echo $i.') '.$currency['c_country'].' ('.$currency['c_code'].') => '.$currency['c_symbol'];?></option>
                          <?php }}?>
                        </select>
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
                  <h4>All Currencies</h4>

                   <?php if (!empty($currencies)) {
                        $i = 0;
                        foreach($currencies as $currency) {
                        $i++;?>
                    
                  <div class="col-lg-12" style="border-bottom:1px solid #CCC;padding-bottom:10px">
                    <form class="form-horizontal" method="post" action="">
                      <div class="col-lg-9">
                        <div class="button-list" style="padding:10px;">
                            <?php echo $i.') '.$currency['c_country'].' ('.$currency['c_code'].') => '.$currency['c_symbol'];?>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <input type="hidden" name="cID" value="<?php echo $currency['c_id'];?>">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                        <span class="btn-label"><i class="fa fa-times"></i></span>
                        Remove</button>
                      </div>
                    </form>
                  </div>
                  <?php }}?>
                  <div style="clear: both;"></div>                  
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