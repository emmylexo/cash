<!-- footer -->
<div class="footer">
    <div class="agileinfo_footer_bottom1">
        <div class="container">
                <p><?php echo date('Y').' '.$siteInfo['site_name'];?>. All Rights Reserved | Designed by: <a target="_blank" href="http://cash360.com.ng">Cash360 Team</a> </p>
                <small style="text-align: center; display: block;">For Complaints <a href="mailto:admin@cash360.com.ng">admin@cash360.com.ng</a></small>
                <small style="text-align: center; display: block;">For Enquiries <a href="mailto:info@cash360.com.ng">info@cash360.com.ng</a></small>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //footer -->
<!-- JavaScripts -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/sleekslider.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<!--/script-->
<!-- stats -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.js"></script>
        <script>
            $('.counter').countUp();
        </script>
<!-- //stats -->
<!-- flexSlider -->
    <script defer src="js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
          $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
              $('body').removeClass('loading');
            }
          });
        });
    </script>
<!-- //flexSlider -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){     
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
                });
            });
</script>

<!--Custom-Theme-files-->
<!-- required-js-files-->
                            <link href="css/owl.carousel.css" rel="stylesheet">
                                <script src="js/owl.carousel.js"></script>
                                    <script>
                                $(document).ready(function() {
                                  $("#owl-demo").owlCarousel({
                                    items :3,
                                    itemsDesktop : [800,2],
                                    itemsDesktopSmall : [414,1],
                                    lazyLoad : true,
                                    autoPlay : true,
                                    navigation :true,
                                    
                                    navigationText :  false,
                                    pagination : true,
                                    
                                  });
                                  
                                });
                                </script>
                                 <!--//required-js-files-->

            <!--start-smooth-scrolling-->
                        <script type="text/javascript">
                                    $(document).ready(function() {
                                        /*
                                        var defaults = {
                                            containerID: 'toTop', // fading element id
                                            containerHoverID: 'toTopHover', // fading element hover id
                                            scrollSpeed:1200,
                                            easingType: 'linear' 
                                        };
                                        */
                                        
                                        $().UItoTop({ easingType: 'easeOutQuart' });
                                        
                                    });
                                </script>
        <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- for bootstrap working -->
        <script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->

<!-- Live chat code -->
<?php echo $siteInfo['chat_code'];?>
</body>
</html>