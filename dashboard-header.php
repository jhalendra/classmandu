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
                   
                </div>
            </div>
        </div>
    </div>
   
            <script>
                $(document).ready(function(){
                    $(window).bind('scroll', function() {
                    var navHeight = $( window ).height()-580;
                    console.log($( window ).height());
                        if ($(window).scrollTop() > 180) {
                
                            $('.quick-search').addClass('fixed');
                        }
                        else {
                            $('.quick-search').removeClass('fixed'); 
                        }
                    });
                });
            </script>
            

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