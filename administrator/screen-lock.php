<?php 
    require("../includes/config.php");
    require_once(ROOT_PATH . "core/backEnd-wrapper.php");

	//Set return url
    if(isset($_REQUEST['returnUrl'])){
        $returnUrl = str_replace('logout', '', $_REQUEST['returnUrl']);
    }else{
        $returnUrl = "";
    }

    //Unset the adm_session
    if(isset($_SESSION['adm_session']) 
    	AND isset($_SESSION['adm_username']) 
    	AND isset($_GET['true'])){
	    unset($_SESSION['adm_session']);	    
		//session not set redirects to login page
		//Return URL 
        if($returnUrl != "") {
            $genInfo->redirect(BASE_URL.'administrator/screen-lock?returnUrl='.$returnUrl);
        } else {
            $genInfo->redirect(BASE_URL.'administrator/screen-lock');
        }
        exit();
	}
	elseif(isset($_SESSION['adm_session'])
		AND !isset($_SESSION['adm_username'])){
		$adm->doLogout();
		//session not set redirects to login page
		//Return URL 
        if($returnUrl != "") {
            $genInfo->redirect(BASE_URL.'administrator/login?returnUrl='.$returnUrl);
        } else {
            $genInfo->redirect(BASE_URL.'administrator/login');
        }
        exit();
	}

	

    $pageTitle = "Screen Lock  - Admin only";
    $pageDesc = "Description";
    $pageKeywords = "Keywords";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<title><?php echo $pageTitle.' - '; if(isset($siteInfo['site_name'])){echo $siteInfo['site_name'];}?></title>

        <?php if(isset($siteInfo['favicon_url'])){ 
            $faviconURL = BASE_URL.str_replace('../', '', $siteInfo['favicon_url']);?>
        <link rel='shortcut icon' href='<?php echo $faviconURL;?>' type='image/x-icon'/ >
        <?php }?>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

	</head>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">				
				<div class="panel-body">

<form method="post" action="<?php echo BASE_URL.'administrator/login?returnUrl='.$returnUrl;?>" role="form" class="text-center">
	<div class="user-thumb">
        <?php if($_SESSION['adm_photo'] != ''){?>
          <img src="<?php echo $_SESSION['adm_photo'];?>" 
          alt="profile Photo" class="img-responsive img-circle img-thumbnail">
        <?php }else{?>
          <i style="font-size:95px;" class="ti-user"></i> 
        <?php }?>
	</div>
	<div class="form-group">
		<h3><?php if(isset($_SESSION['adm_username'])){echo $_SESSION['adm_username'];}?></h3>
		<p class="text-muted">
			Enter your password to access the admin.
		</p>
		<?php
            if(isset($error)){
                foreach($error as $error){?>
                 <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                 </div>
        <?php } }?>
		<div class="input-group m-t-30">
			<input type="password" class="form-control" name="password" 
			placeholder="Password" required>

			<input type="hidden" name="username" value="<?php if(isset($_SESSION['adm_username'])){echo $_SESSION['adm_username'];}?>">
			
			<span class="input-group-btn">
				<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
					Log In
				</button> 
			</span>

		</div>
	</div>
	
</form>
       

				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						Not <?php if(isset($_SESSION['adm_username'])){echo $_SESSION['adm_username'];}?>?
						<a href="<?php echo BASE_URL;?>administrator/login" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
				</div>
			</div>

		</div>

		<script>
			var resizefunc = [];
		</script>

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

	</body>
</html>