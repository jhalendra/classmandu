<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>
<script type="text/javascript" src="<?php echo  osc_base_url() . 'oc-content/themes/nepcoders/js/gmap3.min.js';?>"></script>
<div id="location" style="width:600px; height:350px;"></div>
<script type="text/javascript">
 $(document).ready(function(){
  var address = "<?php echo osc_item_address();?>";
  var city = "<?php echo osc_item_city(); ?>";
  var region = "<?php echo osc_item_region(); ?>";
  var country = "<?php echo osc_item_country(); ?>";
  $('#location').show().gmap3().css('border', '1px solid #000000');
   $('#location').gmap3({
      map: {
        options: {
        maxZoom: 14 
        }  
      },
      marker:{
        address: address+" ,"+city+", "+region+", "+country,
        options: {
          icon: new google.maps.MarkerImage(
            "http://gmap3.net/skin/gmap/magicshow.png",
            new google.maps.Size(32, 37, "px", "px")
          )
        }
      }
    },"autofit");
  });
</script>