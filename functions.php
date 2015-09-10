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

    define('CLASSIFIED_THEME_VERSION', '1.0.0');

    /**
        
        LOAD CLASSES

    */
    require_once('dao-class/ppicture.class.php');
    require_once('dao-class/seller-ratings.class.php');
    require_once('dao-class/watchlist.class.php');
    require_once('dao-class/facebook.class.php');
    require_once('dao-class/facebookuser.class.php');
    require_once('facebook-function.php');
    require_once('dao-class/paid-ads.class.php');
    require_once('dao-class/unique-counter.class.php');
    require_once('dao-class/subscriber.class.php');
  
    //MESSAGE CLOSE BUTTON
    
    
    
    function theme_classified_actions_admin() {
        switch( Params::getParam('action_specific') ) {
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'classified'), 'admin');
                    } else {
                        osc_add_flash_error_message(__("An error has occurred, please try again", 'classified'), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'classified'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/classified/admin/header.php')); exit;
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message(__('The logo image has been removed', 'classified'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'classified'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/classified/admin/header.php')); exit;
            break;
        }
    }
    
    if( !function_exists('logo_header') ) {
        function logo_header() {
            $html = '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                return $html;
            } else if( osc_get_preference('default_logo', 'classified') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/default-logo.jpg")) ) {
                return '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/default-logo.jpg') . '" />';
            } else {
                return osc_page_title();
            }
        }
    }

    // install update options
    if( !function_exists('classified_theme_install') ) {
        function classified_theme_install() {
            osc_set_preference('keyword_placeholder', __('ie. PHP Programmer', 'classified'), 'classified');
            osc_set_preference('facebook_url',Params::getParam('facebook_url'),'classified');
            osc_set_preference('phone_info','+977-12345678','classified');
            osc_set_preference('email_info','info@classified.com','classified');
            osc_set_preference('version', '1.0.0', 'classified');
            osc_set_preference('default_logo', '1', 'classified');
            osc_reset_preferences();
        }
    }

    if(!function_exists('check_install_classified_theme')) {
        function check_install_classified_theme() {
            $current_version = osc_get_preference('version', 'classified');
            //check if current version is installed or need an update
            if( !$current_version ) {
                classified_theme_install();
            }
        }
    }

    require_once WebThemes::newInstance()->getCurrentThemePath() . 'inc.functions.php';

    check_install_classified_theme();

    /* remove theme */
    function classified_delete_theme() {
        osc_remove_preference('keyword_placeholder', 'classified');
        osc_remove_preference('footer_link', 'classified');
        osc_remove_preference('default_logo', 'classified');
        osc_remove_preference('donation', 'classified');
    }
    osc_add_hook('theme_delete_classified', 'classified_delete_theme');

/**

classified INITIALIZE

*/

check_install_classified_theme();

function style_admin_menu() { ?>
<style>
    #theme-settings .ico-theme-settings{
        background-image: url('<?php echo osc_base_url()."oc-content/themes/classified/images/theme-settings-small.png"; ?>') !important;
        width:48px;
        height: 48px;
        display:block;
    }
</style>

<?php
}

osc_add_hook('admin_header','style_admin_menu');
$theme_settings_url = 'oc-content/themes/classified/admin/theme-settings.php';
osc_add_admin_menu_page("Theme-Settings", osc_admin_render_theme_url($theme_settings_url), 'theme-settings','administrator');







function load_my_script(){ 
    osc_register_script('jquery-ui', osc_base_url() . 'oc-content/themes/classified/js/jquery-ui.min.js','jquery');
    osc_register_script('cookie-plugin', osc_base_url() . 'oc-content/themes/classified/js/jquery.cookie.min.js','jquery');
    osc_register_script('tiny_mce',osc_base_url().'oc-includes/osclass/assets/js/tiny_mce/tiny_mce.js');
    osc_enqueue_script('tiny_mce');
    osc_register_script('ratings',osc_base_url().'oc-content/themes/classified/js/jRate.min.js');
    osc_enqueue_script('ratings');
    osc_register_script('facebook-admin', osc_base_url().'oc-content/themes/classified/js/facebook-admin.js');
    osc_register_script('jquery-validate', osc_base_url().'oc-content/themes/classified/js/jquery.validate.min.js','jquery');
    osc_enqueue_script('jquery-validate');
    osc_enqueue_script('facebook-admin');
    osc_register_script('classified', osc_base_url().'oc-content/themes/classified/js/classified.js');
    osc_enqueue_script('classified');
    osc_register_script('jssor', osc_base_url().'oc-content/themes/classified/js/jssor.js');
    osc_enqueue_script('jssor');
    osc_register_script('jssor-slider', osc_base_url().'oc-content/themes/classified/js/jssor.slider.js');
    osc_enqueue_script('jssor-slider');
    osc_enqueue_script('cookie-plugin');
    osc_register_script('bootstrap-dialog', osc_base_url().'oc-content/themes/classified/js/bootstrap-dialog.min.js');
    osc_register_script('jquery-uniform', osc_base_url().'oc-content/themes/classified/js/jquery.uniform.js');
    osc_register_script('jquery-fineuploader',osc_base_url().'oc-includes/osclass/assets/js/fineuploader/jquery.fineuploader.min.js','jquery');
     
     if( !OC_ADMIN ) {
        osc_enqueue_style('font-awesome',osc_base_url().'oc-content/themes/classified/css/font-awesome.min.css');
        osc_enqueue_style('bootstrap',osc_base_url().'oc-content/themes/classified/bootstrap/bootstrap.css');
        osc_enqueue_style('facebook-css',osc_base_url().'oc-content/themes/classified/css/facebook.css');
        osc_enqueue_style('default-css',osc_base_url().'oc-content/themes/classified/css/style.css');

    }
    if(osc_is_home_page()){
        osc_enqueue_style('jCarouselLite-css',osc_base_url().'oc-content/themes/classified/css/premium_slide.css');
        osc_register_script('jCarouselLite', osc_base_url().'oc-content/themes/classified/js/jCarouselLite.js');
        osc_enqueue_script('jCarouselLite');
    }

    if(nc_osc_show_shout_box()){
        osc_enqueue_style('shoutbox',osc_base_url().'oc-content/themes/classified/shoutbox/style.css');    
    }
}

osc_add_hook('init','load_my_script');
function load_admin_script(){
    osc_enqueue_style('admin',osc_base_url().'oc-content/themes/classified/admin/style.css');
    osc_register_script('admin', osc_base_url().'oc-content/themes/classified/admin/admin.js');
    osc_register_script('facebook-admin', osc_base_url().'oc-content/themes/classified/admin/facebook.js');
    osc_enqueue_script('admin');
    osc_enqueue_script('facebook-admin');
}
osc_add_hook('init_admin', 'load_admin_script');
function loadFacebookScript(){
$script= <<<EOF
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
EOF;
    echo $script;
}
//osc_add_hook('header','loadFacebookScript');

function loadFacebookFooter(){
$facebook_url=osc_get_preference('facebook_url','classified');
$script = <<<EOF
<div class="fb-like" 
data-href="{$facebook_url}" 
data-layout="standard" 
data-action="like" 
data-show-faces="true" 
data-share="false">
</div>
EOF;
echo $script;
}

/**

classified FUNCTIONS

*/
if( !function_exists('related_listings') ) {
        function related_listings() {
            View::newInstance()->_exportVariableToView('items', array());

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addRegion(osc_item_region());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '6');

            $aItems      = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems == 6 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '5');

            $aItems = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems > 0 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            return 0;
        }
    }
if( !function_exists('classified_draw_item') ) {
        function classified_draw_item($class = false,$admin = false, $premium = false) {
            $filename = 'loop-single';
            if($premium){
                $filename .='-premium';
            }
            require WebThemes::newInstance()->getCurrentThemePath().$filename.'.php';
        }
    }
 if( !function_exists('classified_show_as') ){
        function classified_show_as(){

            $p_sShowAs    = Params::getParam('sShowAs');
            $aValidShowAsValues = array('list', 'gallery');
            if (!in_array($p_sShowAs, $aValidShowAsValues)) {
                $p_sShowAs = tukucha_default_show_as();
            }

            return $p_sShowAs;
        }
    }        
function item_category_select($default_option) {
        $categories = Category::newInstance()->findRootCategoriesEnabled() ; ?>
        <?php if( count($categories) > 0 ) { ?>
        <select class="category">
            <option><?php echo $default_option ; ?></option>
            <?php foreach($categories as $c) { ?>
            <option value="<?php echo $c['pk_i_id'] ; ?>"><?php echo $c['s_name'] ; ?></option>
            <?php } ?>
        </select>
        <?php } ?>
        <select class="subcategory" name="catId" style="display:none"></select>
        <?php
    }
function nc_osc_facebook_like_entry(){
    $url=osc_get_preference('facebook_url','classified');
    if($url==''){
        return false;
    }else{
        return true;
    }
}
function nc_osc_get_picture(){
    return ProfilePicture::newInstance()->findPictureExist(osc_logged_user_id());
}
function nc_osc_get_picture_link(){
    $ext=ProfilePicture::newInstance()->getPictureExt(osc_logged_user_id());

    if($ext['name']==null){
        $name=osc_logged_user_id().'.'.$ext['pic_ext'];
    }else{
        $name='default.png';
    }
    return osc_current_web_theme_url().'profile_picture/'.$name;
}
function nc_osc_get_public_picture_link($user_id){

    $ext=ProfilePicture::newInstance()->getPictureExt($user_id);
    if($ext['name']==null){
        $name=$user_id.'.'.$ext['pic_ext'];
    }else{
        $name='default.png';
    }
    return osc_current_web_theme_url().'profile_picture/'.$name;
}

function nc_osc_offer_enabled(){
    return true;
}
function nc_osc_get_24_hours_view($item_id){
    return '9';
}

function record_item_views($item){
    $ip = $_SERVER['REMOTE_ADDR'];
    $item_id=$item['fk_i_item_id'];
    $check=UniqueCounter::newInstance()->checkSameUserViewing($item_id,$ip);
    if($check){
        $result=UniqueCounter::newInstance()->UpdateViewCounter($item_id,$ip);
    }else{
        $result=UniqueCounter::newInstance()->AddViewCounter($item_id,$ip);
    }
}
osc_add_hook('show_item','record_item_views');

function getItemsUniqueView($item_id){
    return UniqueCounter::newInstance()->getItemUniqueView($item_id);
}
function getItemsView24Hours($item_id){
    return UniqueCounter::newInstance()->getItemView24Hours($item_id);   
}
function nc_osc_check_watchlist(){
    return WatchList::newInstance()->checkItemAdded(osc_logged_user_id(),osc_item_id());
}
function nc_osc_add_watchllist($user_id,$item_id){
    return WatchList::newInstance()->addToWatchList($item_id,$user_id);
}
function nc_osc_remove_watchlist($user_id,$item_id){
    return WatchList::newInstance()->deleteFromWatchList($item_id,$user_id);
}
function nc_osc_show_phone(){
    return osc_get_preference('enable_phone','classified');
}
function nc_osc_get_phone(){
    return osc_get_preference('phone_info','classified');
}
function nc_osc_show_email(){
    return osc_get_preference('enable_email','classified');
}
function nc_osc_get_email(){
    return osc_get_preference('email_info','classified');
}

//SOCIAL BUTTONS
function nc_osc_show_sb_facebook(){
    return osc_get_preference('e_sb_facebook','classified');
}
function nc_osc_get_sb_facebook(){
    return osc_get_preference('sb_facebook','classified');
}
function nc_osc_show_sb_twitter(){
    return osc_get_preference('e_sb_twitter','classified');
}
function nc_osc_get_sb_twitter(){
    return osc_get_preference('sb_twitter','classified');
}
function nc_osc_show_sb_instagram(){
    return osc_get_preference('e_sb_instagram','classified');
}
function nc_osc_get_sb_instagram(){
    return osc_get_preference('sb_instagram','classified');
}
function nc_osc_show_sb_linkedin(){
    return osc_get_preference('e_sb_linkedin','classified');
}
function nc_osc_get_sb_linkedin(){
    return osc_get_preference('sb_linkedin','classified');
}
function nc_osc_show_sb_google(){
    return osc_get_preference('e_sb_google','classified');
}
function nc_osc_get_sb_google(){
    return osc_get_preference('sb_google','classified');
}
function nc_osc_show_fb_comment(){
    return osc_get_preference('e_comment_fb','classified');
}
function nc_osc_get_fb_app_id(){
    return osc_get_preference('fb_app_id','classified');
}
function nc_osc_show_twitter_share(){
    return osc_get_preference('e_twitter_share','classified');
}
function nc_osc_show_facebook_share(){
    return osc_get_preference('e_facebook_share','classified');
}
function nc_osc_show_google_share(){
    return osc_get_preference('e_google_share','classified');
}
function nc_osc_show_pintrest_share(){
    return osc_get_preference('e_pintrest_share','classified');
}
function nc_osc_hide_categories(){
    return osc_get_preference('e_hide_categories','classified');
}
function nc_osc_show_premium_ads(){
    return osc_get_preference('e_show_premium_slider','classified');
}
function nc_osc_show_landing_popup(){
    return osc_get_preference('e_landing_popup','classified');
}
function nc_osc_get_popup_head(){
    return osc_get_preference('popup_head','classified');
}
function nc_osc_get_popup_body(){
    return osc_get_preference('popup_body','classified');
}
function nc_osc_get_popup_foot(){
    return osc_get_preference('popup_foot','classified');
}
function nc_osc_show_google_maps(){
    return osc_get_preference('e_show_google_maps','classified');
}
function nc_osc_show_shout_box(){
    return osc_get_preference('e_show_shout_box','classified');
}
function nc_osc_show_view_count(){
    return osc_get_preference('e_view_count','classified');
}
function nc_osc_get_search_content(){
    return osc_get_preference('search_content', 'classified');
}
function nc_osc_get_keyword_placeholder(){
    return osc_get_preference('keyword_placeholder', 'classified');
}
function nc_osc_get_post_ads_settings(){
    return osc_get_preference('e_post_ad_to_all', 'classified');
}
function nc_osc_premium_fee_enabled(){
    return osc_get_preference('premium_fee_check', 'classified');
}
function nc_osc_get_premium_fee(){
    return osc_get_preference('premium_cost','classified');
}
function nc_osc_get_default_currency(){
    return osc_get_preference('default_currency','classified');
}
function nc_osc_get_recent_before_popular(){
    return osc_get_preference('e_recent_before_popular', 'classified');
}
function nc_osc_front_display_with_image(){
    return osc_get_preference('e_front_display_with_image','classified');
}
function nc_osc_premium_ads_display(){
    return osc_get_preference('e_premium_ads_row', 'classified');
}
function nc_osc_premium_ads_row_num(){
    return osc_get_preference('select_premium_ads_row', 'classified');
}
function nc_osc_premium_ads_column_num(){
    return osc_get_preference('select_premium_ads_column','classified');
}
function nc_osc_front_page_ads_enabled(){
    return osc_get_preference('e_ads_front_page_below_slider','classified');
}
function nc_osc_get_front_page_ads(){
    return osc_get_preference('ads_front_page_below_slider','classified');
}
function nc_osc_search_results_ads_enabled(){
    return osc_get_preference('e_ads_search_result_below_header','classified');
}   
function nc_osc_get_search_results_ads(){
    return osc_get_preference('ads_search_result_below_header','classified');
}  
function nc_osc_item_page_top_ads_enabled(){
    return osc_get_preference('e_ads_item_page_top','classified');
}
function nc_osc_get_item_page_top_ads(){
    return osc_get_preference('ads_item_page_top','classified');
}
function nc_osc_item_page_bottom_ads_enabled(){
    return osc_get_preference('e_ads_item_page_bottom','classified');
}
function nc_osc_get_item_page_bottom_ads(){
    return osc_get_preference('ads_item_page_bottom','classified');
}
function nc_osc_footer_top_ads_enabled(){
    return osc_get_preference('e_ads_footer_top','classified');
}
function nc_osc_get_footer_top_ads(){
    return osc_get_preference('ads_footer_top','classified');
}
function nc_osc_get_front_map_or_slider(){
    return osc_get_preference('e_front_map_or_slider','classified');
}
function nc_osc_show_footer_about_us(){
    return osc_get_preference('e_about_us','classified');
}
//ENDS SOCIAL BUTTONS

//EXTRA VERIFICATION FOR COMMENTS SPAM BOTS
function checkHoneyPot(){
    if(Params::getParam('website')!=""){
        $return_url = Params::getParam('return_url');
        osc_add_flash_message("Theres seems to be trouble adding comment.");
        header('Location:'.htmlspecialchars_decode($return_url));
        break;
    }
}
osc_add_hook('before_add_comment', 'checkHoneyPot');
/*SEND SMS WHEN COMMENT IS POSTED*/
function comment_post_sms($comment_id = null){
    if($comment_id!=null){
        $item_id = Params::getParam('id'); 
        $author = Params::getParam('authorEmail');
        $user = User::newInstance()->findByEmail($author);
        $item = Item::newInstance()->findByPrimaryKey($item_id);
        $author_phone = $user['s_phone_mobile'];
        
        $msg="Someone commented on ".$item['s_title'];
        $_credentials=WebSMS::newInstance()->selectWebSMSData();
        $token=$_credentials['pk_ws_token'];
        $signature=$_credentials['ws_signature'];
            $sa=new smsAPI();
            $sa->setCredentials($token,$signature);
            $res = $sa->sendSms($author_phone,$msg);
    }
}
function validate_phone($number){
    if($number==""){
        return false;
    }else{
        //Do Other Validation As Well
        return true;
    }
    return true;
}
/*
if(nc_osc_websms_status()){
    osc_add_hook('add_comment','comment_post_sms');    
}
*/
function getRemoteIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];

    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
}
/*
function check_spam_bot($aComment){
    $XUSER = $aComment['s_author_name'];
    $XMAIL = $aComment['s_author_email'];
    $XIP = getRemoteIPAddress();
    $APIKEY = "xQ4SGI7zMHDXvhB";
    $XMAIL =urlencode($XMAIL);
    $apiquery = "http://botscout.com/test/?multi&mail=$XMAIL&ip=$XIP";
    if(function_exists('file_get_contents')){
    // Use file_get_contents
    $returned_data = file_get_contents($apiquery);
    }else{
    $ch = curl_init($apiquery);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $returned_data = curl_exec($ch);
    curl_close($ch);
    }
    $botdata = explode('|', $returned_data);
    if($botdata[0]=='Y' && $XIP!='127.0.0.1'){
        $errnum = round(rand(1100, 25000));
    print "Confabulation Error #$errnum, Halting.";
    exit;
    }
   
}
osc_add_hook('before_add_comment', 'check_spam_bot');
*/
/*
if(!WatchList::newInstance()->checkTable()){
    WatchList::newInstance()->import('sql/watchlist.sql');
}

if(!OfferItem::newInstance()->checkTable()){
    OfferItem::newInstance()->import('sql/offeritem.sql');
}
if(!BuySell::newInstance()->checkTable()){
    BuySell::newInstance()->import('sql/buysell.sql');
}
if(!PayPal::newInstance()->checkTable()){
    PayPal::newInstance()->import('sql/paypal.sql');
}
if(!StockInHand::newInstance()->checkTable()){
    StockInHand::newInstance()->import('sql/stock.sql');
}
if(!Ratings::newInstance()->checkTable()){
    Ratings::newInstance()->import('sql/ratings.sql');
}

if(!WebSMS::newInstance() -> checkTable()){
    WebSMS::newInstance()->import('sql/websms.sql');
}
if(!MarkAsSold::newInstance()->checkTable()){
    MarkAsSold::newInstance()->import('sql/MarkAsSold.sql');
}
if(!Follower::newInstance()->checkTable()){
    Follower::newInstance()->import('sql/follower.sql');
}
if(!Shoutbox::newInstance()->checkTable()){
    Shoutbox::newInstance()->import('sql/shoutbox.sql');
}
if(!Testimonial::newInstance()->checkTable()){
    Testimonial::newInstance()->import('sql/testimonial.sql');
}
if(!FacebookClassified::newInstance()->checkTable()){
    FacebookClassified::newInstance()->import('sql/facebook.sql');
}
if(!FacebookUser::newInstance()->checkTable()){
    FacebookUser::newInstance()->import('sql/facebookuser.sql');
}

*/
if(!SellerRatings::newInstance()->checkTable()){
    SellerRatings::newInstance()->import('sql/seller_ratings.sql');
}
if(!WatchList::newInstance()->checkTable()){
    WatchList::newInstance()->import('sql/watchlist.sql');
}
if(!UniqueCounter::newInstance()->checkTable()){
    UniqueCounter::newInstance()->import('sql/unique-counter.sql');
}
if(!PaidAds::newInstance()->checkTable()){
    PaidAds::newInstance()->import('sql/paid-ads.sql');
}

if(!Subscriber::newInstance()->checkTable()){
    Subscriber::newInstance()->import('sql/subscriber.sql');
}
/**

classified DATABASE FUNCTION

*/
function nc_osc_install(){
    //ncdb::newInstance();
}
function nc_osc_uninstall(){
    hello();
}
osc_add_hook('theme_activate','nc_osc_install');
osc_add_hook('theme_delete','nc_osc_uninstall');

function nc_install_user_pic_db(){
    // In this case we'll create a table to store the Example attributes
    $conn = getConnection() ;
    $conn->autocommit(false);
    try {
        $path = osc_themes_path().'classified/struct.sql';
        $sql = file_get_contents($path);
        $conn->osc_dbImportSQL($sql);
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
    $conn->autocommit(true);
}


osc_add_hook('init','make_userlogin');

function facebookall_fbmlsetup() {?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }
//osc_add_hook('header', 'facebookall_fbmlsetup');


function facebook_logout_hook(){
 echo "<script type='text/javascript'>alert('Hello World');</script>";

}
osc_add_hook('logout_user', 'facebook_logout_hook');



//POPULAR CATEGORY
// function for displaying text on the Item page
function popular_ads_start($limit) {

    $num_ads = 4; // SETS HOW MANY POPULAR ADS TO DISPLAY
    $category_array=array();

    $conn = getConnection();
    if($limit==0){
        $query="SELECT fk_i_item_id, i_num_views FROM %st_item_stats ORDER BY fk_i_item_id ASC";    
    }else{
        $limit_x=($limit*4)-1;
        $limit_y=$limit_x+4;
        $query="SELECT fk_i_item_id, i_num_views FROM %st_item_stats ORDER BY fk_i_item_id ASC";  
    }
    
    $results=$conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);   
    //$results=$conn->osc_dbFetchResults("SELECT fk_i_item_id, i_num_views FROM %st_item_stats ORDER BY fk_i_item_id ASC", DB_TABLE_PREFIX);
    
    if(count($results)>0){
    foreach($results as $result){
        $view_count[$result['fk_i_item_id']] += $result['i_num_views']; // Add-up all item views stored in database
    }

    arsort($view_count); // sorts array by highest number of item views first
    if($limit==0){
        $start_limit=0;
        $end_limit=4;
    }else{
        $start_limit = ($limit*4)+1;
        $end_limit = $start_limit+4;
    }
    $start=0;
    foreach($view_count as $item_id=>$views)
    {
        if($start>=$start_limit && $start<$end_limit){
            
        $result=$conn->osc_dbFetchResult("SELECT fk_i_user_id, fk_i_category_id, dt_pub_date, dt_mod_date, f_price, b_active, i_price, fk_c_currency_code, b_premium, s_secret FROM %st_item WHERE pk_i_id = %d", DB_TABLE_PREFIX, $item_id); //Get active status of item

        if($result['b_active']==1){ //if active...
            //echo 'Item ID: '.$item_id.' Views: '.$views.'<br>'; // display only if item is active
        

        // get description
            $desc=$conn->osc_dbFetchResult("SELECT fk_c_locale_code, s_title, s_description FROM %st_item_description WHERE fk_i_item_id = %d", DB_TABLE_PREFIX, $item_id); //Get active status of item
            $location=$conn->osc_dbFetchResult("SELECT fk_c_country_code, s_country, fk_i_region_id, s_region, fk_i_city_id, s_city FROM %st_item_location WHERE fk_i_item_id = %d", DB_TABLE_PREFIX, $item_id); //Get active status of item

        if (in_array($result['fk_i_category_id'], $category_array)){
            continue;
        }
        $index++;
        // store the data in an array...
        $item_array[] =   array('fk_i_user_id'=>$result['fk_i_user_id'],
                    'fk_i_category_id'=>$result['fk_i_category_id'],
                    'dt_pub_date'=>$result['dt_pub_date'],
                    'dt_mod_date'=>$result['dt_mode_date'],
                    'f_price'=>$result['f_price'],
                    'fk_i_item_id'=>$item_id,
                    'pk_i_id'=>$item_id,
                    'b_active'=>$result['b_active'],
                    'i_price'=>$result['i_price'],
                    'fk_c_currency_code'=>$result['fk_c_currency_code'],
                    'b_premium'=>$result['b_premium'],
                    'fk_c_locale_code'=>$desc['fk_c_locale_code'],
                    's_title'=>$desc['s_title'],
                    's_description'=>$desc['s_description'],
                    'fk_c_country_code'=>$location['fk_c_country_code'],
                    's_country'=>$location['s_country'],
                    'fk_i_region_id'=>$location['fk_i_region_id'],
                    's_region'=>$location['s_region'],
                    'fk_i_city_id'=>$location['fk_i_city_id'],
                    's_city'=>$location['s_city'],
                    's_secret'=>$result['s_secret'],
                    'locale'=>array('en_US'=>array('fk_i_item_id'=>$item_id,
                                    'fk_c_locale_code'=>$desc['fk_c_locale_code'],
                                    's_title'=>$desc['s_title'],
                                    's_description'=>$desc['s_description'],
                                    's_what'=>$desc['s_what']
                                    )
                            )               
                    );
            }
        array_push($category_array,$result['fk_i_category_id']);    
        if($index>=$num_ads) break; // limit number of ads to display

    }//END IF
    $start++;
    }//END FOR LOOP

    GLOBAL $stored_items;
    $stored_items = View::newInstance()->_get('item') ; //save existing item array
    View::newInstance()->_exportVariableToView('items', $item_array);


    } else echo 'No Results.';
}


function popular_category_start(){
     $cat_array=array();
    while(osc_has_categories()){
        $cat_id = osc_category_id();
        $cat_name = osc_category_name();
        $total_listing = osc_category_total_items();
        $parent_id = get_parent_category_id($cat_id);
        $cat = array('total_listing' => $total_listing,
                        'cat_name' => $cat_name,
                        'cat_id' => $cat_id,
                        'parent_id' => $parent_id);
        array_push($cat_array, $cat);
    }
    return array_sort($cat_array,'total_listing',SORT_DESC);
}
function select_top_item($cat_id){
     $conn = getConnection();
     $query = "SELECT pk_i_id FROM %st_category WHERE fk_i_parent_id=".$cat_id;
     $parent_id =  $conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);
     if(empty($parent_id)){
        return null;
     }
     $pk_i_id=array();
     foreach($parent_id as $p_id){
        array_push($pk_i_id,$p_id['pk_i_id']);
     }
     $pk_i_id = implode(',', array_map('intval', $pk_i_id));
     //return $pk_i_id;
     $query = "SELECT pk_i_id FROM %st_item WHERE fk_i_category_id IN (".$pk_i_id.")";
     $categories = $conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);  
     if(empty($categories)){
        return null;
     }
     $p_id=array();
     foreach($categories as $pk_id){
        array_push($p_id,$pk_id['pk_i_id']);
     }
     $pk_id = implode(',', array_map('intval', $p_id));
     $query="SELECT fk_i_item_id, SUM(i_num_views) AS TotalViews FROM %st_item_stats WHERE fk_i_item_id IN (".$pk_id.") GROUP BY fk_i_item_id ORDER BY TotalViews DESC LIMIT 1";    
     $results=$conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);  
     if(empty($results)){
        return null;
     }
     return $results;
}
function get_total_item_views($cat_id){
     $conn = getConnection();
     $query = "SELECT pk_i_id FROM %st_category WHERE fk_i_parent_id=".$cat_id;
     $parent_id =  $conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);
     if(empty($parent_id)){
        return null;
     }
     $pk_i_id=array();
     foreach($parent_id as $p_id){
        array_push($pk_i_id,$p_id['pk_i_id']);
     }
     $pk_i_id = implode(',', array_map('intval', $pk_i_id));
     //return $pk_i_id;
     $query = "SELECT pk_i_id FROM %st_item WHERE fk_i_category_id IN (".$pk_i_id.")";
     $categories = $conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);  
     if(empty($categories)){
        return null;
     }
     $p_id=array();
     foreach($categories as $pk_id){
        array_push($p_id,$pk_id['pk_i_id']);
     }
     $pk_id = implode(',', array_map('intval', $p_id));
     $query="SELECT SUM(i_num_views) AS TotalViews FROM %st_item_stats WHERE fk_i_item_id IN (".$pk_id.")";    
     $results=$conn->osc_dbFetchResults($query, DB_TABLE_PREFIX);

     if(empty($results)){
        return null;
     }
     return $results;
}
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


function popular_ads_end(){
GLOBAL $stored_items;
   View::newInstance()->_exportVariableToView('items', $stored_items); //restore original item array
}

function get_total_listing_by_category($category_id){
    $aCategory = osc_get_category('id', $category_id);
    $parentCategory = osc_get_category('id', $aCategory['fk_i_parent_id']);
    osc_goto_first_category();
    while ( osc_has_categories() ) {
        if(osc_category_id()==$aCategory['fk_i_parent_id']){
            return osc_category_total_items();
        }
    }

}
function get_total_listing_by_parent($category_id){
    $aCategory = osc_get_category('id', $category_id);
    return($aCategory['i_num_items']);
    

}
function get_parent_category_name($category_id){
    $aCategory = osc_get_category('id', $category_id);
    $parentCategory = osc_get_category('id', $aCategory['fk_i_parent_id']);
    return $parentCategory ['s_name'];    

}
function get_category_name($category_id){
    $parentCategory = osc_get_category('id', $category_id);
    return $parentCategory ['s_name'];    
}
function get_parent_category_id($category_id){
    $aCategory = osc_get_category('id', $category_id);
    return $aCategory['fk_i_parent_id'];    

}

function get_parent_subcategories($category_id){
    $subcategory=array();
    //var_dump(osc_get_category('id', $category_id));
    //osc_get_category('id', $category_id);
    //View::newInstance()->_exportVariableToView('category', osc_get_category('id', $category_id));
    osc_goto_first_category();
    while(osc_has_categories()){
        if(osc_category_id()==$category_id){
            if ( osc_count_subcategories() > 0 ) {
                while ( osc_has_subcategories() ) {
                    $sc= array('name' => osc_category_name(),
                    'url' => osc_search_category_url());
                     array_push($subcategory, $sc);
                }
            }
        }
        
    }
    return $subcategory;
}

osc_add_hook('after_login', 'userlogin' );

function userlogin(){
    osc_redirect_to( osc_user_dashboard_url() );
}




 
function execute_paypal_auth($url, $postdata,$credentials) {
        $header = array('Accept : application/json',
                        'Accept-language : en_US'
                        );
        $username = $credentials['username'];
        $password = $credentials['password'];
        
        $cred=$username.":".$password;
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_POST, true); 
        curl_setopt($curl, CURLOPT_USERPWD, $cred);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $params = $postdata;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params); 
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        $response = curl_exec( $curl );
        
        if (empty($response) && !curl_errno($curl)==0) {
            // some kind of an error happened
            $response= "Error::".curl_error($curl).curl_errno($curl);
            curl_close($curl); // close cURL handler
        } else {
            $info = curl_getinfo($curl);
            //echo "Time took: " . $info['total_time']*1000 . "ms\n";
            curl_close($curl); // close cURL handler
            //return $info;
            //if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
            //  echo "Received error: " . $info['http_code']. "\n";
            //  echo "Raw response:".$response."\n";
                //die();
            
        }
        $responseArray = array();
                //parse_str($response,$responseArray); // Break the NVP string to an array
                return $response;
    }
function execute_paypal_post($url, $postdata,$access_token) {
        $header = array('Content-Type : application/json',
                        'Authorization : Bearer '.$access_token
                        );
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_POST, true); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $params = $postdata;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params); 
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        $response = curl_exec( $curl );
        if (empty($response) && !curl_errno($curl)==0) {
            // some kind of an error happened
            $response= "Error::".curl_error($curl).curl_errno($curl);
            curl_close($curl); // close cURL handler
        } else {
            $info = curl_getinfo($curl);
            //echo "Time took: " . $info['total_time']*1000 . "ms\n";
            curl_close($curl); // close cURL handler
            //return $info;
            //if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
            //  echo "Received error: " . $info['http_code']. "\n";
            //  echo "Raw response:".$response."\n";
                //die();
            
        }
        $responseArray = array();
                //parse_str($response,$responseArray); // Break the NVP string to an array
                return $response;
    } 
function execute_paypal_nvp_post($post_data,$url){
    $curl = curl_init($url); 
    curl_setopt($curl, CURLOPT_POST, true); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data)); 
    $response = curl_exec( $curl );
    if (empty($response)) {
            // some kind of an error happened
        $response= "Error::".curl_error($curl);
        curl_close($curl); // close cURL handler
    } else {
        $info = curl_getinfo($curl);
        curl_close($curl); // close cURL handler
    }
    $responseArray = array();
    parse_str($response,$responseArray); // Break the NVP string to an array
    return $responseArray;
}      

function nc_osc_get_logged_user_ref_date(){
    $user = View::newInstance()->_get('_loggedUser');
    $d = $user['dt_reg_date'];
    return osc_format_date($d,'F j, Y');

} 
if (osc_is_web_user_logged_in()) {
    Preference::newInstance()->set('enabled_recaptcha_items', 0);
    Preference::newInstance()->set('recaptchaPubKey', '');
    Preference::newInstance()->set('recaptchaPrivKey', '');
}


function insert_longitude_latitude($item) {
        $itemId = $item['pk_i_id'];
        $aItem = Item::newInstance()->findByPrimaryKey($itemId);
        $sAddress = (isset($aItem['s_address']) ? $aItem['s_address'] : '');
        $sCity = (isset($aItem['s_city']) ? $aItem['s_city'] : '');
        $sRegion = (isset($aItem['s_region']) ? $aItem['s_region'] : '');
        $sCountry = (isset($aItem['s_country']) ? $aItem['s_country'] : '');
        $address = sprintf('%s, %s, %s, %s', $sAddress, $sCity, $sRegion, $sCountry);
        $response = osc_file_get_contents(sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s', urlencode($address)));
        $jsonResponse = json_decode($response,true);
        $location=$jsonResponse['results'][0]['geometry']['location'];
        if ($jsonResponse['status']=="OK") {
            ItemLocation::newInstance()->update (array('d_coord_lat' => $location['lat']
                                                      ,'d_coord_long' => $location['lng'])
                                                ,array('fk_i_item_id' => $itemId));
        }
    }

    osc_add_hook('posted_item', 'insert_longitude_latitude');
    osc_add_hook('edited_item', 'insert_longitude_latitude');
?>