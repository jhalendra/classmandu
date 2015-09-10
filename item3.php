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

    osc_enqueue_script('fancybox');
    osc_enqueue_style('fancybox', osc_assets_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('jquery-validate');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>

        <script type="text/javascript">
            $(document).ready(function(){
                $("a[rel=image_group]").fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    nextEffect : 'fade',
                    prevEffect : 'fade',
                    loop : false,
                    helpers : {
                            title : {
                                    type : 'inside'
                            }
                    }
                });
                $("#offer-form").on('submit',(function(e) {
                    e.preventDefault();
                    $("#message").empty();
                    $('#makeanoffer-form').show(); 
                    $('#loading').show();
                    $.ajax({
                        url: "<?php echo osc_current_web_theme_url().'includes/offerbutton-handler.php';?>",       // Url to which the request is send
                        type: "POST",                   // Type of request to be send, called as method
                        data:  new FormData(this),      // Data sent to server, a set of key/value pairs representing form fields and values 
                        contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                        cache: false,                   // To unable request pages to be cached
                        processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                        success: function(data,status,settings)         // A function to be called if request succeeds
                        {
                        $('#loading').hide();
                        $('#makeanoffer-form').hide();
                        $("#message").html(data);
                        },
                        error: function (xhr, status) {
                         
                        }           
                   });
                }));
            });
        </script>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <meta name="fb:app_id" content="<?php echo nc_osc_get_fb_app_id(); ?>" />
    </head>
    <body class="container-fluid">
        <!--FACEBOOK COMMENT SCRIPT-->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!--END OF FACEBOOK COMMENT SCRIPT-->


        <?php osc_current_web_theme_path('header.php'); ?>    
        <div class="col-md-2">

        </div>
        <div class="col-md-7">
            <div class="col-sm-7">
                <h4 class="title"><?php echo osc_item_title();?></h4>
                <h5><?php echo osc_item_description();?></h5>
                <?php if( osc_logged_user_id() == osc_item_user_id()   ) { ?>
                    <?php if(nc_osc_mark_status(osc_item_id())){ ?>
                        <?php osc_current_web_theme_path('markassold.php');?>
                    <?php }else{ ?>
                        <?php osc_current_web_theme_path('markassold.php');?>
                    <?php } ?>
                <?php } ?>
            </div>

            <?php echo osc_item_contact_name();?>







            <div class="col-sm-5">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if( osc_count_item_resources() > 0 ) { ?>
                    <div id="photos" class="row ">
                        <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                        <a href="<?php echo osc_resource_url(); ?>" rel="image_group" title="<?php _e('Image', 'nepcoders'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                            <?php if( $i == 0 ) { ?>
                                <?php if(nc_osc_mark_status(osc_item_id())){ ?>
                                    <div class="box soldout" style="width:315px;">
                                <?php }?>
                                    <img src="<?php echo osc_resource_url(); ?>" width="315" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-rounded"/>
                                <?php if(nc_osc_mark_status(osc_item_id())){ ?>
                                    </div>
                                <?php }?>
                            <?php } else { ?>
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                            <?php } ?>
                        </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-12">
                <?php osc_current_web_theme_path('share-buttons.php');?>

                <?php if(osc_is_web_user_logged_in() && !nc_osc_check_follow()){ ?>
                    <form name="follow-seller" method="post" action="<?php echo osc_route_url('nc-functions');?>">
                        <input type="hidden" name="nc_action" value="FOLLOW"/>
                        <input type="hidden" name="seller-id" value="<?php echo osc_item_user_id(); ?>"/>
                        <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                        <Button class="btn btn-primary">Follow Seller</Button>
                    </form>
                <?php }else if(osc_is_web_user_logged_in() && nc_osc_check_follow()){ ?>
                    <form name="unfollow-seller" method="post" action="<?php echo osc_route_url('nc-functions');?>">
                        <input type="hidden" name="nc_action" value="UNFOLLOW"/>
                        <input type="hidden" name="seller-id" value="<?php echo osc_item_user_id(); ?>"/>
                        <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                        <Button class="btn btn-primary">Unfollow Seller</Button>
                    </form>
                <?php } ?>
                <?php if(osc_is_web_user_logged_in()){ ?>
                    <form name="add-to-watchlist" method="post" action="<?php echo osc_route_url('nc-functions');?>">
                        <input type="hidden" name="nc_action" value="ADD-WATCHLIST"/>
                        <input type="hidden" name="item_id" value="<?php echo osc_item_id(); ?>" />
                        <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                        <?php if(!nc_osc_check_watchlist()){ ?>
                            <Button class="btn btn-primary">Add to Watch List</Button>
                        <?php } ?>
                    </form>
                <?php } ?>
                <?php if((! osc_logged_user_id() == osc_item_user_id() ))  { ?>
                        <a href="<?php echo osc_route_url('seller-items',array('seller' => osc_item_user_id())); ?>" >See other items from seller</a>
                        
                <?php } ?>
                <a href="<?php echo osc_route_url('watchlist'); ?>" >Check my Watchlist</a>
                <?php if( osc_comments_enabled() ) { ?>
                <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
                <?php if(nc_osc_show_fb_comment()){ ?>
                        
                        <div class="fb-comments" 
                             data-href="<?php echo getUrl(); ?>" 
                             data-numposts="5" data-colorscheme="light">
                        </div>
                <?php }else{ ?>
                        <?php osc_current_web_theme_path('comment.php');?>
                <?php } ?>
                    
                <?php } ?>
                <?php } ?>
            </div>
            
                <div class="clear"></div>
             </div>    
             <?php osc_current_web_theme_path('item-sidebar-right.php'); ?>

               
            <div class="col-md-8">
                <?php if( nc_osc_show_google_maps()){ ?>
                <?php osc_current_web_theme_path('g-map.php');?>
                <?php } ?>
                
                <?php related_listings(); ?>
                <?php if( osc_count_items() > 0 ) { ?>
                <?php osc_current_web_theme_path('rItems.php'); }?>
            </div>
            </div>
            
        <div class="container">
        <?php osc_current_web_theme_path('footer.php'); ?>
        </div>
    </body>
</html>
