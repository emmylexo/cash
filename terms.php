<?php 
  	require("includes/config.php");
 	require_once(ROOT_PATH . "core/frontEnd-wrapper.php");

	$pageTitle = $siteInfo['terms_title'].' | '.$siteInfo['site_name'];
	$pageDesc = 'Welcome to '.$siteInfo['site_name'];
	$pageKeywords = '';
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<link rel="canonical" href="http://www.ojaolawebsolution.com/"/>
<meta name="description"  content="<?php echo $pageDesc; ?>"/>
<meta name="keywords" content="<?php echo $pageKeywords; ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon
============================================ -->
<?php if(file_exists(ROOT_PATH.str_replace('../', '', $siteInfo['favicon_url'])) AND $siteInfo['favicon_url'] != ''){?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL.str_replace('../', '', $siteInfo['favicon_url']);?>">
<?php }else{?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL;?>images/favi.png">
<?php }?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,600i,700,700i,800" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
<!--Custom-Theme-files-->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" /><!--Blog slider-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel='stylesheet' type='text/css' />	
</head>
<div class="inner_banner_agileinfo" id="home">
	<div class="top_banner">
		<div class="top_header_agile_info_w3ls">
		  <nav class="navbar navbar-default">
				
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><div class="logo">
    <?php if(file_exists(ROOT_PATH.str_replace('../', '', $siteInfo['logo_url'])) AND $siteInfo['logo_url'] != ''){?>
            <a href="<?php echo BASE_URL;?>">            
            <img src="<?php echo BASE_URL.str_replace('../', '', $siteInfo['logo_url']);?>" alt="<?php echo $siteInfo['site_name'];?> logo"></a>

        <?php }else{?>
            <a href="<?php echo BASE_URL;?>">
            <img src="<?php echo BASE_URL;?>images\logo.png" alt="<?php echo $siteInfo['site_name'];?> logo"></a>
        <?php }?>        
    </div>
        </h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<div id="m_nav_container" class="m_nav wthree_bg">
						<nav class="menu menu--sebastian">
							<ul id="m_nav_list" class="m_nav menu__list">
	<li class="m_nav_item active" id="m_nav_item_1"> <a href="<?php echo BASE_URL;?>" class="link link--kumya"><i class="fa fa-home" aria-hidden="true"></i><span data-letters="Home">Home</span></a></li>

    <li class="m_nav_item" id="moble_nav_item_3"> <a href="about" class="link link--kumya"><i class="fa fa-info-circle" aria-hidden="true"></i><span data-letters="About Us">About Us</span></a></li>

    <li class="m_nav_item" id="moble_nav_item_4"> <a href="how-it-works" class="link link--kumya"><i class="fa fa-building-o" aria-hidden="true"></i><span data-letters="How It Works">How It Works</span></a></li>

    <li class="m_nav_item" id="moble_nav_item_4"> <a href="<?php echo BASE_URL;?>user/login" class="link link--kumya"><i class="fa fa-lock" aria-hidden="true"></i><span data-letters="Login">Login</span></a></li>

    <li class="m_nav_item" id="moble_nav_item_4"> 
        <a href="<?php echo BASE_URL;?>user/register" class="link link--kumya"><i class="fa fa-user" aria-hidden="true"></i><span data-letters="Signup">Signup</span></a>
    </li>
							</ul>
						</nav>
					</div>
					</nav>
				</div>
		</div>
			 
    </div>


 </div>
 <!--/w3_short-->
 <div class="services-breadcrumb">
	<div class="container">
       <ul class="w3_short">
			<li><a href="<?php echo BASE_URL;?>">Home</a><i>|</i></li>
			<li>Terms & Conditions</li>
		</ul>
	 </div>
</div>
   <!--//w3_short-->
<!--/about-w3layouts-agile-info-->
<div class="about-w3layouts-agileinfo" style="min-height:400px;">
	<div class="container">
		<h3><?php echo $siteInfo['terms_title'];?></h3>
		<hr>
		<p><?php echo nl2br($siteInfo['terms']);?></p>
		
	</div>
</div>
<?php include(ROOT_PATH."includes/footer.php"); ?>