<?php 
//    $facebookData=FacebookClassified::newInstance()->selectFacebookData();
//    $api_id = $facebookData['pk_fb_api_id'];
//    $api_secret = $facebookData['fb_api_secret'];
 

?>
<script type="text/javascript">
            
    $(document).ready(function(){
        $("#breadcrumb ul").addClass('breadcrumb'); 
        $("#sCategory").addClass('form-control');
        $("#query").addClass('search_box_input_area');

    });
            
</script>

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                    <div class="logo">
                        <a href="<?php echo osc_base_url(); ?>"><?php echo logo_header(); ?> </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                    <div class="login">
                        <h4>
                            <?php if( osc_is_web_user_logged_in() ) { ?>
                                <span><?php echo sprintf(__('Hi %s', 'classified'), osc_logged_user_name() . '!  '); ?>&nbsp;&nbsp;&nbsp;</span>
                                <span><a class="my_account" href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'classified'); ?></a></span> 
                                <?php if(nc_osc_get_post_ads_settings()){
                                        echo "<a class='post_an_ad' href=".osc_item_post_url() .">Post an Ad</a>";
                                    }
                                ?>
                                <span><a class="log_out" href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'classified'); ?></a></span>
                            <?php }else{

                                echo '<a href="#" href="#" role="button" data-toggle="modal" data-target="#register" class="register-btn">Register</a>';
                                echo "<a id='login_open' href='#'' role='button' data-toggle='modal' data-target='#login' class='login-btn'>Login</a>";
                                
                            } ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
            <script>
                $(document).ready(function(){
                    $(window).bind('scroll', function() {
                    var navHeight = $( window ).height()-580;
                        if ($(window).scrollTop() > 180) {
                
                            $('.quick-search').addClass('fixed');
                        }
                        else {
                            $('.quick-search').removeClass('fixed'); 
                        }
                    });
                });
            </script>
            <?php if(osc_is_home_page()){ ?>

            <div class="quick-search">
                <div class="container-fluid">
                   
                   <div class="row">
                    <form action="<?php echo osc_base_url(true) ; ?>" method="get" class="search" onsubmit="javascript:return doSearch();" name="searchForm">
                        <input type="hidden" name="page" value="search"/>            
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10 text-center">                        
                                <div id="custom-search-input">                            
                                    <div class="input-group">
                                        <input type="text" name="sPattern" id="query" placeholder="<?php echo nc_osc_get_keyword_placeholder(); ?>" class="search-query form-control" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="button">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        <span>
                           
                                    </div>                                
                                </div>                            
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1">
                                <a href="#" onclick="document.forms['searchForm'].submit(); return false;">
                                    <img class="search-btn img-responsive" src="<?php echo osc_base_url().'oc-content/themes/classified/images/search-btn.jpg';?>" alt="#">
                                </a>
                            </div>                            
                    </form>
                    </div>
                    
                </div>
            </div>

                <?php } ?>

    <?php
    osc_show_widgets('header');
    $breadcrumb = osc_breadcrumb('&raquo;', false);
    if( $breadcrumb != '') { ?>
    <!--    <div id="breadcrumb">
            <div class="container" >
                <div class="row">
                    <?php //echo $breadcrumb; ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div> -->      
    <?php } ?>
<div class="forcemessages-inline">
    <?php osc_show_flash_message(); ?>
</div>    