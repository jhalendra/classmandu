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
        <?php if( osc_count_items() == 0 || Params::getParam('iPage') > 0 || stripos($_SERVER['REQUEST_URI'], 'search') )  { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
        <?php } ?>
            <style>
                ul.sub {
                    padding-left: 20px;
                }
                .chbx{
                    width:15px; height:15px;
                    display: inline;
                    padding:8px 3px;
                    background-repeat:no-repeat;
                    cursor: pointer;
                }
                .chbx span{
                    width:13px; height:13px;
                    display: inline-block;
                    border:solid 1px #bababa;
                    border-radius:2px;
                    -moz-border-radius:2px;
                    -webkit-border-radius:2px;
                }
                .chbx.checked{
                    background-image:url('<?php echo osc_current_web_theme_url('images/checkmark.png'); ?>');
                }
                .chbx.semi-checked{
                    background-image:url('<?php echo osc_current_web_theme_url('images/checkmark-partial.png'); ?>');
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('#alert_email').addClass('form-control');
                    $('li.parent').each(function() {
                        var totalInputSub = $(this).find('ul.sub>li>input').size();
                        var totalInputSubChecked = $(this).find('ul.sub>li>input:checked').size();
                        $(this).find('ul.sub>li>input').each(function(){
                            $(this).hide();
                            var id = $(this).attr('id');
                            id = id+'_';
                            if( $(this).is(':checked') ){
                                var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                $(this).before(aux);
                            } else {
                                var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                                $(this).before(aux);
                            }
                        });

                        var input = $(this).find('input.parent');
                        $(input).hide();
                        var id = $(input).attr('id');
                        id = id+'_';
                        if(totalInputSub == totalInputSubChecked) {
                            if(totalInputSub == 0) {
                                if( $(this).find("input[name='sCategory[]']:checked").size() > 0) {
                                    var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                    $(input).before(aux);
                                } else {
                                    var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                                    $(input).before(aux);
                                }
                            } else {
                                var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                $(input).before(aux);
                            }
                        }else if(totalInputSubChecked == 0) {
                            // no input checked
                            var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                            $(input).before(aux);
                        }else if(totalInputSubChecked < totalInputSub) {
                            var aux = $('<div class="chbx semi-checked"><span></span></div>').attr('id', id);
                            $(input).before(aux);
                        }
                    });

                    $('li.parent').prepend('<span style="width:6px;display:inline-block;" class="toggle">+</span>');
                    $('ul.sub').toggle();

                    $('span.toggle').click(function(){
                        $(this).parent().find('ul.sub').toggle();
                        if($(this).text()=='+'){
                            $(this).html('-');
                        } else {
                            $(this).html('+');
                        }
                    });

                    $("li input[name='sCategory[]']").change( function(){
                        var id = $(this).attr('id');
                        $(this).click();
                        $('#'+id+'_').click();
                    });

                    $('div.chbx').click( function() {
                        var isChecked       = $(this).hasClass('checked');
                        var isSemiChecked   = $(this).hasClass('semi-checked');

                        if(isChecked) {
                            $(this).removeClass('checked');
                            $(this).next('input').prop('checked', false);
                        } else if(isSemiChecked) {
                            $(this).removeClass('semi-checked');
                            $(this).next('input').prop('checked', false);
                        } else {
                            $(this).addClass('checked');
                            $(this).next('input').prop('checked', true);
                        }

                        // there are subcategories ?
                        if($(this).parent().find('ul.sub').size()>0) {
                            if(isChecked){
                                $(this).parent().find('ul.sub>li>div.chbx').removeClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', false);
                            } else if(isSemiChecked){
                                // if semi-checked -> check-all
                                $(this).parent().find('ul.sub>li>div.chbx').removeClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', false);
                                $(this).removeClass('semi-checked');
                            } else {
                                $(this).parent().find('ul.sub>li>div.chbx').addClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', true);
                            }
                        } else {
                            // is subcategory checkbox or is category parent without subcategories
                            var parentLi = $(this).closest('li.parent');

                            // subcategory
                            if($(parentLi).find('ul.sub').size() > 0) {
                                var totalInputSub           = $(parentLi).find('ul.sub>li>input').size();
                                var totalInputSubChecked    = $(parentLi).find('ul.sub>li>input:checked').size();

                                var input    = $(parentLi).find('input.parent');
                                var divInput = $(parentLi).find('div.chbx').first();

                                $(input).prop('checked', false);
                                $(divInput).removeClass('checked');
                                $(divInput).removeClass('semi-checked');

                                if(totalInputSub == totalInputSubChecked) {
                                    $(divInput).addClass('checked');
                                    $(input).prop('checked', true);
                                }else if(totalInputSubChecked == 0) {
                                    // no input checked;
                                }else if(totalInputSubChecked < totalInputSub) {
                                    $(divInput).addClass('semi-checked');
                                }
                            } else {
                                // parent category
                            }
                        }
                    });
                });
            </script>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        

        
        <div class="container">

            <div class="row">
                <?php if(nc_osc_search_results_ads_enabled()){ ?>
                    <div class="row" style="padding:20px;text-align:center;">
                        <?php echo nc_osc_get_search_results_ads(); ?>
                    </div>    
                <?php } ?>
                <?php $breadcrumb = osc_breadcrumb('&raquo;', false);?>
                        <?php if( $breadcrumb != '') { ?>
                                <div style="padding-left:15px;padding-bottom:30px;">
                                    <div id="breadcrumb">
                                                <?php echo $breadcrumb; ?>
                                                <div class="clear"></div>
                                    </div>      
                                </div>
                        <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    
                    <h3 class="filter-search">FILTER SEARCH</h3>
                   <div class="cat-sidebar">                       
                    <script>
                    $(function() {
                        $( "#slider-range" ).slider({
                            range: true,
                            min: 0,
                            max: 10000,
                            values: [ 0, 1000 ],
                            slide: function( event, ui ) {
                                for (var i = 0; i < ui.values.length; ++i) {
                                    $("input.priceRange[data-index=" + i + "]").val(ui.values[i]);
                                }
                            }
                        });
                        //$( "#lowAmount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                            //" - $" + $( "#slider-range" ).slider( "values", 1 ) );
                    });
                    </script>

                    
                    
                    <form role="form" action="<?php echo osc_base_url(true); ?>" method="get" onsubmit="return doSearch()" class="nocsrf">
                        <input type="hidden" name="page" value="search" />
                        <input type="hidden" name="sOrder" value="<?php echo osc_esc_html(osc_search_order()); ?>" />
                        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo osc_esc_html($allowedTypesForSorting[osc_search_order_type()]); ?>" />
                        <div class="form-group">
                            <input class="form-control" type="text" name="sPattern"  id="query" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" />
                        </div>
                        <p>
                            <label for="amount">Price range:</label>
                        </p>
                        <div class="form-group">
                            <div id="slider-range"></div> 
                        </div>
                        <div class="form-inline">
                            <input id="priceMin" name="sPriceMin" type="text" class="priceRange form-control" data-index="0" readonly value="75" style="border:1; color:#f6931f; font-weight:bold;">
                            <input id="priceMax" name="sPriceMax" type="text" class="priceRange form-control" data-index="1" value="300" readonly style="border:1; color:#f6931f; font-weight:bold;">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="sCity" name="sCity" type="text" class="form-control" id="city">
                            <input type="hidden" id="sRegion" name="sRegion" value="" />
                        </div> 
                         <div class="checkbox">
                            <label><input type="checkbox" name="bPic" id="withPicture" value="1">Only with pictures?</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>   
                    </form>
                    <div style="padding-bottom:10px;">
                        <?php osc_alert_form(); ?>
                    </div>
                    </div> 
                </div>
            
            
            <?php if(osc_count_items() == 0) { ?>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-top:40px;text-align:center;">
                <div class="flashmessage-info flashmessage">
                    <p class="empty" ><?php printf(__('There are no results matching "%s"', 'modern'), osc_search_pattern()); ?></p>
                </div>

            </div>
            <?php } else { ?>
            <?php osc_run_hook('search_ads_listing_top'); ?>
            <div class="clear"></div>
            <?php require(osc_search_show_as() == 'list' ? 'search_list.php' : 'search_gallery.php'); ?>
            <?php } ?> 

            
            </div>
        </div>    
            <?php if(osc_count_items() != 0){ ?>
                <div style="text-align: center;">    
                    <div class="pagination" >
                        <?php echo osc_search_pagination(); ?>
                    </div>
                </div>
            <?php } ?>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
