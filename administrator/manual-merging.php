<?php
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/backEnd-wrapper.php");
    //Privilege Settings
    $accounting = 'false';
    $editor = 'false';
    require_once(ROOT_PATH . "core/adminSession.php");

	$payerLists = $adm->payerLists();
	$payeeLists = $adm->payeeLists();
	include(ROOT_PATH."administrator/includes/matchScript.php");
    $pageTitle = "Manual Merging";
    $pageDesc = "Description";
    $pageKeywords = "Keywords";

    include(ROOT_PATH."administrator/includes/header.php"); 
    include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css">

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

  <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
  <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
  <link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

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
              <li class="active">Manual Merging</li>
          </ol>
        </div>
    </div>
                
                 <?php
					if(isset($error)){
						foreach($error as $error){ ?>
						 <div class="alert alert-danger">
							<i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
						 </div>
				<?php } }elseif(isset($_GET["merged"])){?>
						<div class="alert alert-success">
							<i class="fa fa-check-o"></i> &nbsp; Selected donors successfully Merged!
						 </div>
				<?php }?>
                <style type="text/css">
					select {
						min-height: 250px;
					}
					select option {padding: 5px;border-bottom: 1px solid #CCC;}
					select .noteOptn{color: #999;font-style: italic;}
				</style>
                <form role="form" method="post" action="" enctype="multipart/form-data" onsubmit="validate()">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Select up to 7 Payers
                            </div>
                            <div class="panel-body">
                                <div class="list-group">

<select  name="payers[]" id="payers" multiple required class="selectpicker" data-live-search="true" data-style="btn-white" required>
	<?php 
        if (!empty($payerLists)) {
            foreach($payerLists as $payer) {
         $mOrderPayer = $adm->mOrderPayer($payer["ph_id"]);
         $payiInfo = $adm->userInfo($payer["login_id"]);
         $balPayer = $payer["amount"] - $mOrderPayer; ?>
         	<?php if($balPayer != 0){?>
				<option value="<?php echo $payer["ph_id"];?>"><?php echo $payiInfo["first_name"].' '.$payiInfo["last_name"].' - PH Amount: '.$defaultCurrency['c_symbol'].number_format($balPayer);?></option>
			<?php }?>
<?php  } }?>
</select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Select single Receiver
                               <!--<span class="pull-right">
                               <a class="btn btn-success btn-small" href="<?php echo BASE_URL; ?>administrator/add-donors">Add Receiver</a></span>-->
                            </div> 
                            <div class="panel-body">
                                <div class="list-group">

<select  name="payee" id="payee" required class="selectpicker" data-live-search="true" data-style="btn-white" required>
<?php 
    if (!empty($payeeLists)) {
        foreach($payeeLists as $payee) {
            $mOrder = $adm->matchingOrder($payee["gh_id"]);
            $payiInfo = $adm->userInfo($payee["login_id"]);
            $bal = $payee["g_amount"] - $mOrder;?>
        <?php if($bal != 0){?>
            <option value="<?php echo $payee["gh_id"];?>">
            <?php echo $payiInfo["first_name"].' '.$payiInfo["last_name"].' - GH Amount: '.$defaultCurrency['c_symbol'].number_format($bal);?>
            </option>
        <?php }?>
<?php  } }?>
    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
		<div style="width: 80px; margin: auto;">
			<button type="submit" name="match" class="btn btn-default btn-large">Proceed to Merging</button>
		</div>
    </div>
    <div style="clear: both;"></div>
    <br><br><br>
</div>
<!-- /. ROW  -->
</form>
</div>
<!-- /. ROW  -->

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