<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2012 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
    </head>
    <body>
        <?php if(nc_osc_show_landing_popup()){ osc_current_web_theme_path('landing-popup.php') ;} ?>
        <?php osc_current_web_theme_path('header.php'); ?>
        
                <?php if(nc_osc_show_premium_ads()){ ?>
                    
                        <?php osc_current_web_theme_path('slider-premium.php') ; ?>
                    
                <?php } ?>    
                <?php osc_current_web_theme_path('categories.php') ; ?>
               
                    <h1><strong><?php _e('Latest Listings', 'nepcoders'); ?></strong></h1>
                    <?php if( osc_count_latest_items() == 0) { ?>
                        <p class="empty"><?php _e('No Latest Listings', 'nepcoders'); ?></p>
                    <?php } else { ?>
                            <?php $class = "even"; ?>
                                <?php while ( osc_has_latest_items() ) { ?>
                                    <ul class="nav navbar-nav navbar-brand"> 
                                        <?php if( osc_images_enabled_at_items() ) { ?>
                                         <li class="photo">
                                            <?php if( osc_count_item_resources() ) { ?>
                                                <a href="<?php echo osc_item_url(); ?>">
                                                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" />
                                                </a>
                                            <?php } else { ?>
                                                <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" alt="" title="" />
                                            <?php } ?>
                                         </li>
                                        <?php } ?>
                                         <li class="text">
                                             <h3><a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a></h3>
                                             <h5><?php echo osc_item_contact_name(); ?> </h5>
                                             <p><strong><?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { echo osc_item_formated_price(); ?> - <?php } echo osc_item_city(); ?> (<?php echo osc_item_region();?>) - <?php echo osc_format_date(osc_item_pub_date()); ?></strong></p>
                                             <p><?php echo osc_highlight( strip_tags( osc_item_description() ) ); ?></p>
                                         </li>
                                     </ul>
                                    <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
                                <?php } ?>
                        <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
                        <p class='pagination'><?php echo osc_search_pagination(); ?></p>
                            <p class="see_more_link"><a href="<?php echo osc_search_show_all_url();?>"><strong><?php _e("See all offers", 'nepcoders'); ?> &raquo;</strong></a></p>
                        <?php } ?>
                    <?php View::newInstance()->_erase('items'); } ?>
                </div>
            </div>
            <div id="sidebar" class="home-right-side">
                <div class="sidebar right">
                    
                </div>
                <?php if( osc_get_preference('sidebar-300x250', 'nepcoders') != '') {?>
                <!-- sidebar ad 350x250 -->
                <div class="ads_300">
                    <?php echo osc_get_preference('sidebar-300x250', 'nepcoders'); ?>
                </div>
                <!-- /sidebar ad 350x250 -->
                <?php } ?>
                <div class="navigation">
                    <?php if(osc_count_list_regions() > 0 ) { ?>
                    <div class="box location">
                        <h3><strong><?php _e("Location", 'nepcoders'); ?></strong></h3>
                        <ul>
                        <?php while(osc_has_list_regions() ) { ?>
                            <li><a href="<?php echo osc_list_region_url(); ?>"><?php echo osc_list_region_name(); ?></a> <em>(<?php echo osc_list_region_items(); ?>)</em></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div>
             <?php osc_current_web_theme_path('g-map.php'); ?>
            </div>
            <div class="clear"></div>
            <?php if( osc_get_preference('homepage-728x90', 'nepcoders') != '') { ?>
            <!-- homepage ad 728x60-->
            <div class="ads_728">
               
            </div>
            <!-- /homepage ad 728x60-->
            <?php } ?>

            
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>
