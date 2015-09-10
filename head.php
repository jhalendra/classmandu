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
<!-- ADDED FOR FB -->
<?php 
function getUrl() {
    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url .= $_SERVER["REQUEST_URI"];
    return $url;
}
?>
<?php 
function getImage(){
    if(getUrl()==osc_base_url()){
        
        if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
            $image = osc_current_web_theme_url('images/logo.jpg');
        }
        else{
            $image = osc_current_web_theme_url('images/default-logo.jpg');
        }
    }else{
        
        if( osc_images_enabled_at_items() ) {
            if( osc_count_item_resources() > 0 ) {
                $image = osc_resource_url();
            }else{
                $image = osc_current_web_theme_url('images/logo.jpg');
            }
        }else{
                $image = osc_current_web_theme_url('images/logo.jpg');
        }
        //echo osc_resource_url();exit;
    }
    return $image;
}
?>
<?php
if(getUrl()==osc_base_url()){
    echo '<meta property="og:type" content="website" />';
}else{
    echo '<meta property="og:type" content="product" />';
}        
?>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />


<title><?php echo meta_title(); ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if( meta_description() != '' ) { ?>
<meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if( function_exists('meta_keywords') ) { ?>
<?php if( meta_keywords() != '' ) { ?>
<meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<?php } ?>
<?php if( osc_get_canonical() != '' ) { ?>
<link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/>
<?php } ?>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<script type="text/javascript">
    var fileDefaultText = '<?php echo osc_esc_js( __('No file selected', 'classified') ); ?>';
    var fileBtnText     = '<?php echo osc_esc_js( __('Choose File', 'classified') ); ?>';
</script>

<?php
osc_enqueue_style('style', osc_current_web_theme_url('style.css'));
osc_enqueue_style('tabs', osc_current_web_theme_url('tabs.css'));
osc_enqueue_style('jquery-ui-datepicker', osc_assets_url('css/jquery-ui/jquery-ui.css'));

//osc_register_script('jquery-uniform', osc_current_web_theme_js_url('jquery.uniform.js'), 'jquery');
//osc_register_script('global', osc_current_web_theme_js_url('global.js'));

osc_register_script('jquery', osc_current_web_theme_js_url('jquery.js'));
osc_enqueue_script('jquery');
osc_enqueue_script('jquery-ui');
osc_register_script('bootstrap-js', osc_base_url() . 'oc-content/themes/classified/bootstrap/bootstrap.min.js','jquery');
osc_enqueue_script('bootstrap-js');
osc_enqueue_script('tabber');
osc_enqueue_script('bootstrap-dialog');
osc_run_hook('header');

//FieldForm::i18n_datePicker();

?>