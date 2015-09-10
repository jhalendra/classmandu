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
    </head>
    <body class="container-fluid">
        <?php osc_current_web_theme_path('header.php'); ?>
            
            <div class="featurette col-md-8">
                <div class="text-right">
                    <h1><?php echo osc_item_title(); ?></h1>
                    <em class="publish"><?php if ( osc_item_pub_date() != '' ) echo __('Published date', 'nepcoders') . ': ' . osc_format_date( osc_item_pub_date() ); ?></em>
                    <em class="update"><?php if ( osc_item_mod_date() != '' ) echo __('Modified date', 'nepcoders') . ': ' . osc_format_date( osc_item_mod_date() ); ?></em>
                </div>
                <!--Image-->
                <div class="col-md-5">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if( osc_count_item_resources() > 0 ) { ?>
                    <div id="photos" class="row ">
                        <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                        <a href="<?php echo osc_resource_url(); ?>" rel="image_group" title="<?php _e('Image', 'nepcoders'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                            <?php if( $i == 0 ) { ?>
                            <img src="<?php echo osc_resource_url(); ?>" width="315" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-rounded"/>
                            <?php } else { ?>
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                            <?php } ?>
                        </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
                <!--End Image-->
                <div class="col-md-5">
                <div id="description" class="lead" >
                    <p><?php echo osc_item_description(); ?></p>
                    <div id="custom_fields">
                        <?php if( osc_count_item_meta() >= 1 ) { ?>
                            <br />
                            <div class="meta_list">
                                <?php while ( osc_has_item_meta() ) { ?>
                                    <?php if(osc_item_meta_value()!='') { ?>
                                        <div class="meta">
                                            <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php osc_run_hook('item_detail', osc_item() ); ?>
                    <p class="btn">
                        <?php if( !osc_item_is_expired () ) { ?>
                        <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                                <strong><a href="#contact"><?php _e('Contact seller', 'nepcoders'); ?></a></strong>
                            <?php     } ?>
                        <?php     } ?>
                        <?php } ?>
                        <strong class="share"><a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow"><?php _e('Share', 'nepcoders'); ?></a></strong>
                    </p>
                    <?php osc_run_hook('location'); ?>
                </div>
            </div>
                <?php if(nc_osc_buysell_enabled(osc_item_id())){?>

                <?php } ?>
                <!-- plugins -->
                <div id="useful_info">
                    
                </div>
                <?php if(nc_osc_offer_enabled() && osc_is_web_user_logged_in()){?>
                    <div class="makeanoffer-box">
                        <a class="makeanoffer-button" href="#make_an_offer">Make an Offer</a>
                    </div>

                    <div id="make_an_offer" class="makeanoffer-overlay">
                        <div class="makeanoffer-popup">
                            <h2>Make an Offer</h2>
                            <a class="makeanoffer-close" href="#">&times;</a>
                            <div class="makeanoffer-content">
                                <div id="makeanoffer-form">
                                    <form id="offer-form" name="makeanoffer" action=""  method="POST" and enctype="multipart/form-data">
                                        <div class="form-label"><?php _e('Rs.', 'nepcoders'); ?></div>
                                        <input type="hidden" name="item_id" value="<?php echo osc_item_id();?>">
                                        <div class="form-controls"><input type="text" class="xlarge" name="offer_amt"></div>
                                        <Button id="submit" type="submit" class="btn btn-primary">Make an offer</Button>
                                    </form>
                                </div>
                                <div id="loading" style="display:none">Loading</div>
                                <div id="message"></div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <?php if( osc_comments_enabled() ) { ?>
                    <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
                    <div id="comments">
                        <h2><?php _e('Comments', 'nepcoders'); ?></h2>
                        <ul id="comment_error_list"></ul>
                        <?php CommentForm::js_validation(); ?>
                        <?php if( osc_count_item_comments() >= 1 ) { ?>
                            <div class="comments_list">
                                <?php while ( osc_has_item_comments() ) { ?>
                                    <div class="comment">
                                        <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'nepcoders'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
                                        <p><?php echo nl2br( osc_comment_body() ); ?> </p>
                                        <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                                        <p>
                                            <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'nepcoders'); ?>"><?php _e('Delete', 'nepcoders'); ?></a>
                                        </p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="paginate" style="text-align: right;">
                                    <?php echo osc_comments_pagination(); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form" class="form-group">
                            <fieldset>
                                <h3><?php _e('Leave your comment (spam and offensive messages will be removed)', 'nepcoders'); ?></h3>
                                <input type="hidden" name="action" value="add_comment" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                <?php if(osc_is_web_user_logged_in()) { ?>
                                    <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                    <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                                <?php } else { ?>
                                    <label for="authorName"><?php _e('Your name', 'nepcoders'); ?>:</label> <?php CommentForm::author_input_text(); ?><br />
                                    <label for="authorEmail"><?php _e('Your e-mail', 'nepcoders'); ?>:</label> <?php CommentForm::email_input_text(); ?><br />
                                <?php }; ?>
                                <label for="title"><?php _e('Title', 'nepcoders'); ?>:</label><?php CommentForm::title_input_text(); ?><br />
                                <label for="body"><?php _e('Comment', 'nepcoders'); ?>:</label><?php CommentForm::body_input_textarea(); ?><br />
                                <button type="submit"><?php _e('Send', 'nepcoders'); ?></button>
                            </fieldset>
                        </form>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-3 row jumbotron">
                <?php if(nc_osc_paypal_status()){?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Your Shopping Cart</div>
                        <div class="panel-body">
                            <?php if(isset($_SESSION['nc_osc_products'])){
                                $total=0.00;
                                echo "<ul class='list-group'>";
                                foreach($_SESSION['nc_osc_products'] as $cart_item){
                                    echo '<li class="list-group-item">';
                                    echo $cart_item['title'];
                                    echo 'Price: '.number_format($cart_item['price']/1000000, 0, '.', ',');
                                    if($cart_item['resource_id']!=null){
                                        echo '<img width="75" src="'.osc_base_url().$cart_item['resource_id'].'"/>';
                                    }
                                    echo '<a href="'.osc_current_web_theme_url('includes/updateCart.php').
                                            '?remove='.$cart_item['id'].'&return_url='.urlencode(osc_item_url()).'">Remove Item</a>';
                                    echo '</li>';
                                    $total=$total+$cart_item['price'];    
                                    }
                                    echo 'Total: '.number_format($total/1000000, 0, '.', ',');
                                }?>
                            <div class="row">    
                            <form name="shopping-cart" action="<?php echo osc_current_web_theme_url('includes/updateCart.php'); ?>" method="get">
                                <input type="hidden" name="itemId" id="itemId" value='<?php echo osc_item_id();?>'>
                                <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                                <input type="hidden" name="price" id="price" value="<?php echo osc_item_price();?>">
                                <?php if(StockInHand::newInstance()->checkStockable(osc_item_id())){ ?>
                                <h5>Stock in hand:<?php echo StockInHand::newInstance()->getStock(osc_item_id());?> <h5>
                                <input type="hidden" name="stock" id="stock" value="<?php echo StockInHand::newInstance()->getStock(osc_item_id());?>">   
                                <div class="form-group">    
                                    <input type="number" name="demand" id="demand" max="<?php echo StockInHand::newInstance()->getStock(osc_item_id());?>" required>     
                                </div>
                                <?php }?>
                                <button class="btn btn-primary" type="submit" name="add_to_cart">Add to Cart</button>
                            </form>
                            </div>
                            <form name="check-out" action="<?php echo osc_route_url("check-out") ?>" method="post">
                                <button class="btn btn-success" type="submit" name="check-out">Checkout</button>    
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
