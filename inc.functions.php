<?php

if (classified_is_fineuploader()) {
    if (!OC_ADMIN) {
        osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
    }
    osc_enqueue_script('jquery-fineuploader');
}

function classified_is_fineuploader() {
    return Scripts::newInstance()->registered['jquery-fineuploader'] && method_exists('ItemForm', 'ajax_photos');
}

osc_add_hook('init_admin', 'theme_classified_actions_admin');
osc_add_hook('init_admin', 'theme_classified_regions_map_admin');
if (function_exists('osc_admin_menu_appearance')) {
    osc_admin_menu_appearance(__('Header logo', 'classified'), osc_admin_render_theme_url('oc-content/themes/classified/admin/header.php'), 'header_classified');
    osc_admin_menu_appearance(__('Theme settings', 'classified'), osc_admin_render_theme_url('oc-content/themes/classified/admin/settings.php'), 'settings_classified');
  
} else {

    function classified_admin_menu() {
        echo '<h3><a href="#">' . __('Classified theme', 'classified') . '</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/classified/admin/header.php') . '">&raquo; ' . __('Header logo', 'classified') . '</a></li>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/classified/admin/settings.php') . '">&raquo; ' . __('Theme settings', 'classified') . '</a></li>
            </ul>';
    }

    osc_add_hook('admin_menu', 'classified_admin_menu');
}


?>