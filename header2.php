<script type="text/javascript">
            
    $(document).ready(function(){
        $("#breadcrumb ul").addClass('breadcrumb'); 
    });
            
</script>

<header class="navbar navbar-inverse navbar-fixed-top alizarin" role="banner" style="padding-top:20px;padding-bottom:20px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="logo" class="navbar-brand" href="<?php echo osc_base_url(); ?>">
                    <div class="navbar-brand"><?php echo logo_header(); ?></div>
                </a>
            </div><!--END NAVBAR-HEADER-->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(osc_users_enabled()) { ?>
                    <li>
                        <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
                            <a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'nepcoders');?></a>
                        <?php } ?>
                    </li>
                        <?php if( osc_is_web_user_logged_in() ) { ?>
                            <li>
                                <img id='ppicture_header' src='<?php echo nc_osc_get_picture_link();?>' name='ppicture' alt='default' width="30" height="30"/>
                            </li>
                            <li>    
                                <?php echo sprintf(__('Hi %s', 'nepcoders'), osc_logged_user_name() . '!'); ?>  &middot;
                            </li>    
                            <li>    
                                <strong><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'nepcoders'); ?></a></strong> &middot;
                            </li>
                            <li>    
                                <a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'nepcoders'); ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                                <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="<?php echo osc_base_url(true); ?>" accept-charset="UTF-8" id="login">
                                                <input type="hidden" name="page" value="login" />
                                                <input type="hidden" name="action" value="login_post" />
                                                <div class="form-group">
                                                    <label class="sr-only" for="email">Email address</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><input type="checkbox" id="remember" name="remember"> Remember me</label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                </div>
                                                <div class="forgot">
                                                    <a href="<?php echo osc_recover_user_password_url(); ?>"><?php _e("Forgot password?", 'nepcoders');?></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                        <?php osc_goto_first_locale(); ?>
                            <li class="last with_sub">
                                <strong><?php _e("Language", 'nepcoders'); ?></strong>
                                <ul>
                                    <?php $i = 0;  ?>
                                    <?php while ( osc_has_web_enabled_locales() ) { ?>
                                    <li <?php if( $i == 0 ) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><?php echo osc_locale_name(); ?></a></li>
                                    <?php $i++; ?>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                </ul>    
            </div><!--ENDS NAVBAR-COLLAPSA-->        
        </div><!--END CONTAINER-->
</header><!--HEADER ENDS-->      
<?php
    osc_show_widgets('header');
    $breadcrumb = osc_breadcrumb('&raquo;', false);
    if( $breadcrumb != '') { ?>
        <div id="breadcrumb">
            <div class="container" >
                <div class="row">
                    <?php echo $breadcrumb; ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>      
    <?php } ?>
<div class="forcemessages-inline">
    <?php osc_show_flash_message(); ?>
</div>    