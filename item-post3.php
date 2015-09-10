<?php
 osc_enqueue_script('jquery-validate');
 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />

		<script type="text/javascript">    
            $(document).ready(function(){
                $("#catId, #titleen_US, #descriptionen_US, #price, #currency").addClass('form-control'); 
                $("#is_stock, #stock_qty, #countryId, #regionId, #region, #city, #cityArea, #address").addClass('form-control');
                $("#contactName, #contactEmail, #showEmail").addClass('form-control');
            });
        </script>
    </head>
    <body>
    	<?php osc_current_web_theme_path('header.php'); ?>	
    	<section id="item-post-page" class="container">
        	<div class="row">
        		<div class="col-sm-8">
            		<h1><?php _e('Publish a listing', 'nepcoders'); ?></h1>
            		<hr class="featurette-divider"></hr>
            		<ul id="error_list"></ul>
            		<form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data">
            			<div class="row">
		                <input type="hidden" name="action" value="item_add_post" />
		                <input type="hidden" name="page" value="item" />
		                <h2><?php _e('General Information', 'nepcoders'); ?></h2>
		                    <div class="form-group control-group">
		                        <div class="controls">    
		                            <label for="catId"><?php _e('Category', 'nepcoders'); ?> *</label>    
		                            <?php ItemForm::category_select(null, null, __('Select a category', 'nepcoders')); ?>
		                        </div>
		                    </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <?php ItemForm::multilanguage_title_description(); ?>
		                            </div>
		                        </div>
		                    <div class="col-sm-4">
		                    <?php if( osc_price_enabled_at_items() ) { ?>
		                    <div class="form-group control-group">
		                        <div class="controls">
		                            <label for="price"><?php _e('Price', 'nepcoders'); ?></label>
		                            <?php ItemForm::price_input_text(); ?>
		                            <?php ItemForm::currency_select(); ?>
		                        </div>
		                    </div>
		                    <div class="form-group control-group">
		                        <div class="controls">    
		                            <label for="is_stock"><?php _e('Item in Stock', 'nepcoders'); ?></label>    
		                            <input type="checkbox" name="is_stock">
		                        </div>
		                    </div>
		                    <div class="form-group control-group">
		                        <div class="controls">    
		                            <label for="stock_qty"><?php _e('Stock Quantity','nepcoders'); ?></label>
		                            <input type="text" name="stock_qty" id="stock_qty">
		                        </div>
		                    </div>
		                    <?php } ?>
		                    <?php if( osc_images_enabled_at_items() ) { ?>
		                    <div class="form-group control-group">
		                        <?php
		                            if(osc_images_enabled_at_items()) {
		                                if(nepcoders_is_fineuploader()) {
		                                    // new ajax photo upload
		                                    ItemForm::ajax_photos();
		                                }
		                            } else { ?>
		                        <h2><?php _e('Photos', 'nepcoders'); ?></h2>
		                        <div id="photos">
		                            <div class="form-group control-group">
		                                <div class="controls">
		                                    < form-group type="file" name="photos[]" />
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#" onclick="addNewPhoto(); uniform_ form-group_file(); return false;"><?php _e('Add new photo', 'nepcoders'); ?></a>
		                        <?php
		                            }
		                        }
		                        ?>
		                    </div>
		                    
		                        <h2><?php _e('Listing Location', 'nepcoders'); ?></h2>
		                        <div class="form-group control-group">
		                            <div class="controls">    
		                                <label for="countryId"><?php _e('Country', 'nepcoders'); ?></label>
		                                <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
		                            </div>
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <label for="regionId"><?php _e('Region', 'nepcoders'); ?></label>
		                                <?php ItemForm::region_text(osc_user()); ?>
		                            </div>
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">    
		                                <label for="city"><?php _e('City', 'nepcoders'); ?></label>
		                                <?php ItemForm::city_text(osc_user()); ?>
		                            </div>    
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <label for="city"><?php _e('City Area', 'nepcoders'); ?></label>
		                                <?php ItemForm::city_area_text(osc_user()); ?>
		                            </div>
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <label for="address"><?php _e('Address', 'nepcoders'); ?></label>
		                                <?php ItemForm::address_text(osc_user()); ?>
		                            </div>
		                        </div>
		                    <!-- seller info -->
		                    <?php if(!osc_is_web_user_logged_in() ) { ?>
		                        <h2><?php _e("Seller's information", 'nepcoders'); ?></h2>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <label for="contactName"><?php _e('Name', 'nepcoders'); ?></label>
		                                <?php ItemForm::contact_name_text(); ?>
		                            </div>
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <label for="contactEmail"><?php _e('E-mail', 'nepcoders'); ?> *</label>
		                                <?php ItemForm::contact_email_text(); ?>
		                            </div>
		                        </div>
		                        <div class="form-group control-group">
		                            <div class="controls">
		                                <div style="width: 120px;text-align: right;float:left;">
		                                    <?php ItemForm::show_email_checkbox(); ?>
		                                </div>
		                            </div>
		                            <label for="showEmail" style="width: 250px;"><?php _e('Show e-mail on the listing page', 'nepcoders'); ?></label>
		                        </div>
		                    </div>
		                    <?php }; ?>
		                    <?php ItemForm::plugin_post_item(); ?>
		                    <?php if( osc_recaptcha_items_enabled() ) {?>
		                    <div class="form-group control-group">
		                        <div class="controls">
		                            <?php osc_show_recaptcha(); ?>
		                        </div>
		                    </div>
		                    <?php }?>
		                    
		                </div>    
		                <div class="controls">
		                        <button  type="submit" class="btn btn-primary"><?php _e('Publish', 'nepcoders'); ?></button>
		                </div>
		            </form><!--END OF col-sm-8-->
            </div><!--END OF ROW-->
        </section>    