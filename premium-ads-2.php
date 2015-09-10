<?php
	osc_get_premiums('8');
?>
<style>
@media (min-width : 1270px) and (max-width : 1320px) {
  .carouselSlider { 
    width:90%!important;
  }
}
@media (min-width : 795px) and (max-width : 1270px) {
  .carouselSlider { 
    width:85%!important;
  }
}
@media (min-width : 630px) and (max-width : 795px) {
  .carouselSlider { 
    width:80%!important;
  }
}
@media (min-width : 600px) and (max-width : 630px){
  .carouselSlider {
    width:79%!important;
  }
}
@media (min-width : 520px) and (max-width : 600px){
  .carouselSlider {
    width:75%!important;
  }
}
@media (min-width : 456px) and (max-width : 520px) {
  .carouselSlider { 
    width:65%!important;
 }
}
@media (min-width : 410px) and (max-width : 456px) {
  .carouselSlider { 
    width:60%!important;
    margin: 30px;
 }
}
@media (min-width : 200px) and (max-width : 360px) {
  .nextCarousel { 
    display:none;
 }
 .prevCarousel{
  display: none;
 }
 
}
</style>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 class="premium-ads">Premium Ads</h4>
        <div class="hrb"></div>
    </div>
 </div>
 <div class="clearfix" style="margin-top:25px;"></div>
 <script>
jQuery(document).ready(function(){
    jQuery(".carouselSlider").jCarouselLite({
        btnNext: ".nextCarousel",
        btnPrev: ".prevCarousel",
        visible: 6,
		hoverPause:true,
		auto: 1000 ,
		speed: 1100,		
		vertical: false,
		circular: true,
		autoWidth: true,
  		responsive: true
		        //easing: "easeOutQuint" // for different types of easing, see easing.js
    });
   
});
</script>

 
 <div class="row">
 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 	<div class="scroller" id="jcl">
	        <div class="prevCarousel"></div>
	        
				<div class="carouselSlider" id="ist"> 
						<ul>
							<?php if( osc_count_premiums() != 0) { ?>
								<?php while(osc_has_premiums()) { ?>
									<?php 
										if( osc_count_premium_resources() ) { 
		                    				$image = osc_resource_thumbnail_url(); 
		                     			} else { 
	                    				$image = osc_current_web_theme_url('images/no-image-available.png');
	                    				} 
	                    			?>
									<li>
										<span class="feat_left"> 
							                <a href="<?php echo osc_premium_url(); ?>" title="<?php echo osc_premium_title(); ?>">
							                	<img src="<?php echo $image;?>" alt="<?php echo osc_premium_url(); ?>" title="<?php echo osc_premium_title(); ?>"/>
							                </a>
	                                        
	                                        <span class="price_sm"><?php echo (osc_premium_price()/1000000)." ".osc_premium_currency();?></span>
	                                         

	                                        <a href="<?php echo osc_premium_url(); ?>"><?php echo osc_premium_title(); ?></a>
	                                        
	                                    </span>
									</li>
								<?php } ?>
							<?php }?>
						</ul>
				</div>
				
			<div class="nextCarousel"></div>
		</div>
	</div>
</div>


