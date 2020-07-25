<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

            	<li class="text-muted menu-title">Navigation</li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/" class="waves-effect"><i class="ti-home"></i> 
                    <span> Dashboard </span> </a>
                    
                </li>

    <?php if($admInfo['role'] == 'Administrator'
            OR $admInfo['role'] == 'Editor'){?>
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                    <i class="ti-settings"></i> <span>General Settings </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo BASE_URL;?>administrator/website-settings">Website Settings</a></li>
                        <li><a href="<?php echo BASE_URL;?>administrator/currency">Currency Settings</a></li>
                        <li><a href="<?php echo BASE_URL;?>administrator/business-settings">Business Information</a></li>
                        <li><a href="<?php echo BASE_URL;?>administrator/livechat">LiveChat Widget</a></li>
                        <li><a href="<?php echo BASE_URL;?>administrator/configuration">Configuration</a></li>

                        <li><a href="<?php echo BASE_URL;?>administrator/content-social">Social Buttons</a></li>
                    </ul>
                </li>
    <?php }?>
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                    <i class="ti-settings"></i> <span>Admin Manager</span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo BASE_URL;?>administrator/admin-profile">Admin Profile</a></li>

                        <li><a href="<?php echo BASE_URL;?>administrator/admin-profile-edit">Edit Profile</a></li>

                    <?php if($admInfo['role'] == 'Administrator'){?>
                        <li><a href="<?php echo BASE_URL;?>administrator/admin-manager">Admin Manager</a></li>
                    <?php }?>
                    </ul>
                </li>

    <?php if($admInfo['role'] == 'Administrator'
            OR $admInfo['role'] == 'Editor'){?>
                
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                    <i class="ti-pencil-alt"></i> <span>Content Manager </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo BASE_URL;?>administrator/content-about">About Us</a></li>

                        <li><a href="<?php echo BASE_URL;?>administrator/content-terms">How It Works</a></li>

                        <li><a href="<?php echo BASE_URL;?>administrator/content-policy">Credibility Score</a></li>
                    </ul>
                </li>
    <?php }?>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/get-help" 
                    class="waves-effect"><i class="ti-gift"></i> 
                    <span> Get Help</span> </a>                    
                </li>
                
                <li>
                    <a href="<?php echo BASE_URL;?>administrator/adminacc" 
                    class="waves-effect"><i class="ti-gift"></i> 
                    <span> Admin Account</span> </a>                    
                </li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/provide-help" 
                    class="waves-effect"><i class="ti-filter"></i> 
                    <span> Provide Help</span> </a>
                </li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/merged" 
                    class="waves-effect"><i class=" ti-shopping-cart"></i> 
                    <span> Merged Orders</span> </a>
                </li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/manual-merging" 
                    class="waves-effect"><i class="ti-loop"></i> 
                    <span> Manual Merging</span> </a>
                </li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/customers" 
                    class="waves-effect"><i class="ti-user"></i> 
                    <span> Users</span> </a>                    
                </li>
                
                <li>
                    <a href="<?php echo BASE_URL;?>administrator/testimonials" 
                    class="waves-effect"><i class="ti-comment-alt"></i> 
                    <span>Letters of Happiness</span> </a>                    
                </li>
                <li>
                    <a href="<?php echo BASE_URL;?>administrator/messages" 
                    class="waves-effect"><i class="ti-headphone-alt"></i> 
                    <span> Support</span> </a>                    
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect">
                    <i class="ti-announcement"></i> <span>News </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo BASE_URL;?>administrator/news">All News</a></li>

                        <li><a href="<?php echo BASE_URL;?>administrator/news-add">Post News</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo BASE_URL;?>administrator/screen-lock?true" 
                    class="waves-effect"><i class="ti-lock"></i> 
                    <span>Lock Screen</span> </a>                    
                </li>
                <li>
                    <a href="<?php echo BASE_URL;?>administrator/logout" 
                    class="waves-effect"><i class="ti-power-off"></i> 
                    <span> Logout</span> </a>                    
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->