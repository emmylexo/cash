<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $pageDesc;?>">
        <meta name="author" content="Ojaolawebsolution.com/shop">

        <title><?php echo $pageTitle.' - '; if(isset($siteInfo['site_name'])){echo $siteInfo['site_name'];}?></title>

    <?php if(isset($siteInfo['favicon_url'])){ 
        $faviconURL = BASE_URL.str_replace('../', '', $siteInfo['favicon_url']);?>
    <link rel='shortcut icon' href='<?php echo $faviconURL;?>' type='image/x-icon'/ >
    <?php }?>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

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


<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">


<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
 

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                     <input type="text" placeholder="Search..." class="form-control">
                     <a href=""><i class="fa fa-search"></i></a>
                </form>


                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <i class="icon-bell"></i> <span class="badge badge-xs badge-danger"><?php if($cntNotify > 0){echo $cntNotify;}?></span>
                        </a>
<ul class="dropdown-menu dropdown-menu-lg">
    <li class="notifi-title"><span class="label label-default pull-right"><?php if($cntNotify > 0){echo 'New '.$cntNotify;}?></span>Notification</li>
  
    <li class="list-group nicescroll notification-list">
<?php if(!empty($topNotifications)){
        foreach ($topNotifications as $note) {;
            $uInfo = $front->userInfo($note['login_id']);?> 
       <!-- list item-->
    <?php if($note['status'] == 0){?>
       <a style="background:#f8f8f8;" href="<?php echo BASE_URL.$note['action_url'].'&marknotfRead='.$note['id'] ;?>" class="list-group-item">
          <div class="media">
             <div class="pull-left p-r-10">
            <?php if($note['login_id'] != ''){?>
                <?php if($uInfo['photo'] != ''){?>
                    <img src="<?php echo $uInfo['photo'];?>" 
                    alt="profile Photo" class="thumb-sm pull-left m-r-10">
                <?php }else{?>
                    <i style="font-size:25px;" class="ti-user"></i> 
                <?php }?>
            <?php }else{?>
                <i style="font-size:25px;" class="icon-bell"></i> 
                <!--<em class="fa icon-bell fa-2x text-primary"></em>-->
            <?php }?>
             </div>
             <div class="media-body">
                <h5 class="media-heading">
                <?php echo $note['type'];?> - <span style="font-size:12px;"> <?php echo $genInfo->timeAgo($note['date_added']);?></span>
                </h5>
                <p class="m-0">
                    <small><?php echo $note['action'];?></small>
                </p>
             </div>
          </div>
       </a>
       <hr style="margin:2px;">
    <?php }else{?>
       <a href="<?php echo BASE_URL.$note['action_url'] ;?>" class="list-group-item">
          <div class="media">
             <div class="pull-left p-r-10">
            <?php if($note['login_id'] != ''){?>
                <?php if($uInfo['photo'] != ''){?>
                    <img src="<?php echo $uInfo['photo'];?>" 
                    alt="profile Photo" class="thumb-sm pull-left m-r-10">
                <?php }else{?>
                    <i style="font-size:25px;" class="ti-user"></i> 
                <?php }?>
            <?php }else{?>
                <i style="font-size:25px;" class="icon-bell"></i> 
                <!--<em class="fa icon-bell fa-2x text-primary"></em>-->
            <?php }?>
             </div>
             <div class="media-body">
                <h5 class="media-heading">
                <?php echo $note['type'];?> - <span style="font-size:12px;"> <?php echo $genInfo->timeAgo($note['date_added']);?></span>
                </h5>
                <p class="m-0">
                    <small><?php echo $note['action'];?></small>
                </p>
             </div>
          </div>
       </a>
       <hr style="margin:2px;">
    <?php }?>
<?php }}?>
    </li>
    <li>
        <a href="<?php echo BASE_URL;?>user/notifications" class="list-group-item text-right">
            <small class="font-600">See all notifications</small>
        </a>
    </li>
</ul>
                    </li>
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                        <?php echo $userInfo['first_name'];?> &nbsp;&nbsp;
                        <?php if($userInfo['photo'] != ''){?>
                          <img src="<?php echo $userInfo['photo'];?>" 
                          alt="profile Photo">
                        <?php }else{?>
                          <i style="font-size:25px;" class="ti-user"></i> 
                        <?php }?>

                        </a>
                        <ul class="dropdown-menu"> 
                            <li><a href="<?php echo BASE_URL;?>user/logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->