<div class="row">
  <!-- MAIN-SLIDER-AREA START -->
  <div class="main-slider-area">
    <!-- SLIDER-AREA START -->
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="slider-area">

        <div id="wrapper">
          <div class="slider-wrapper">

            <div id="mainSlider" class="nivoSlider">              
				<?php if(!empty($homeSlides)){
						foreach ($homeSlides as $slide) {?>		
						<img src="<?php echo BASE_URL.str_replace('../', '', $slide['banner']);?>" 
						alt="<?php echo $slide['title'];?>" 
						title="#caption<?php echo $slide['slide_id'];?>"
						style="max-width: 870px; max-height: 432px;">
				<?php }}else{?>
					<h3 style="padding:30px; background:#FFCCFF;border-radius:10px;">No slider found, please add slides from administrative back-end.</h3>
				<?php }?>
            </div>
            <?php if(!empty($homeSlides)){
					foreach ($homeSlides as $slide) {?>	
            <div id="caption<?php echo $slide['slide_id'];?>" 
            class="nivo-html-caption slider-caption">
              <div class="slider-progress"></div>
              <div class="slider-cap-text slider-text1">
                <div class="d-table-cell">
                  <h2 class="animated bounceInDown">
                  <?php echo $slide['title'];?></h2>
                  <p class="animated bounceInUp">
                  <?php echo $slide['descr'];?></p> 
                  
                  <?php if($slide['url'] != ''){?>
					<a class="wow zoomInDown" data-wow-duration="1s" data-wow-delay="1s" href="<?php echo $slide['url'];?>">
					Read More <i class="fa fa-caret-right"></i></a>
				<?php }?>                        
                </div>
              </div>
            </div>
            <?php }}?>

          </div>

        </div>                
      </div>              
    </div>
    <!-- SLIDER-AREA END -->
    <!-- SLIDER-RIGHT START -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="slider-right zoom-img m-top">
        <a href="#"><img class="img-responsive" src="img\product\cms11.jpg" alt="sidebar left"></a>
      </div>
    </div>
    <!-- SLIDER-RIGHT END -->
  </div>
  <!-- MAIN-SLIDER-AREA END -->
</div>