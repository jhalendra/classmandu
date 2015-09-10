<h2>Home Slider</h2>
<input type="checkbox" name="e_home_slider" value="1" <?php echo (osc_get_preference('e_home_slider', 'classified') ? 'checked' : ''); ?> > <?php _e("Enable Home Slider.", 'classified'); ?>
<div class="submit-data" id="submit-home-slider-data" type="button"> Submit</div>
<div class="relative">
	<div id="populate-slider"></div>
</div>
<input type="text" class="xlarge" id="home_slider_item_id" name="home_slider_item_id" placeholder="Enter Item ID">
<div class="submit-data" id="add-home-slider-item" type="button">Add New</div>