<?php if(nc_osc_show_view_count()){ ?>
    <div class="total_views">
        Total Views: <?php echo osc_item_views();?>
    </div>
<?php } ?>
<?php if(!osc_is_web_user_logged_in() || osc_logged_user_id()!=osc_item_user_id()) { ?>
        <form action="<?php echo osc_base_url(true); ?>" method="post" name="mask_as_form" id="mask_as_form">
            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
            <input type="hidden" name="as" value="spam" />
            <input type="hidden" name="action" value="mark" />
            <input type="hidden" name="page" value="item" />
            <select name="as" id="as" class="mark_as">
                    <option><?php _e("Mark as...", 'nepcoders'); ?></option>
                    <option value="spam"><?php _e("Mark as spam", 'nepcoders'); ?></option>
                    <option value="badcat"><?php _e("Mark as misclassified", 'nepcoders'); ?></option>
                    <option value="repeated"><?php _e("Mark as duplicated", 'nepcoders'); ?></option>
                    <option value="expired"><?php _e("Mark as expired", 'nepcoders'); ?></option>
                    <option value="offensive"><?php _e("Mark as offensive", 'nepcoders'); ?></option>
            </select>
        </form>
<?php } ?>
<p class="name"><?php _e('Seller / Pulblisher', 'nepcoders') ?>: <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a></p>
<div class="col-md-3">
    <?php if(nc_osc_paypal_status()){
    osc_current_web_theme_path('add_to_cart.php');
    } ?>
</div>
<div class="col-md-3">
 	<?php if(osc_is_web_user_logged_in()){ ?>
    <?php osc_current_web_theme_path('ratings.php'); ?>
    <?php } ?>
</div>