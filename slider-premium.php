<?php $size = explode('x', osc_thumbnail_dimensions()); ?>
	<!--<section id="slider"><!--slider-->
		<!--<div class="container">
			<div class="row">-->
				<div class="col-sm-12" style="padding:0px;">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner" role="listbox">						
						<?php osc_get_premiums(10);?>
						<?php $first=true; ?>
						<?php while (osc_has_premiums()){ ?>

							<div class="item <?php if($first==true){echo 'active';$first=false;}?>">
								<div class="col-sm-6">
									<h1><span>Premium</span>-ADS</h1>
									<h2><?php echo osc_premium_title(); ?></h2>
									<p><?php echo osc_premium_description(); ?></p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									 <?php if( osc_images_enabled_at_items() ) { ?>
       								 <?php if(osc_count_premium_resources()) { ?>
										<img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
									<?php } else { ?>
            							<img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
        							<?php } ?>
    								<?php } ?>
								</div>
							</div>
						<?php }?>	
						
					<!-- Controls -->
						<div style="clear:both;"></div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
						</div>
   				</div>
   			</div>	
					
				<!--</div>
			</div>
		</div>-->
	<!--</section><!--/slider-->
