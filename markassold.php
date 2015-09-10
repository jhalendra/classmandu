   <?php if(nc_osc_mark_status(osc_item_id())){$status="true";}else{$status="false";}?>
    <form name="mas" id="mas" action="<?php echo osc_route_url('mark-as-sold'); ?>" method="post">
        <input type="hidden" name="itemId" id="itemId" value='<?php echo osc_item_id();?>'>
        <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
        <input type="hidden" name="mark-it" id="mark-it" value="<?php echo $status; ?>">
        <?php if(nc_osc_mark_status(osc_item_id())){ ?>
        <button class="btn btn-primary" type="submit" name="mark_as_sold" id="mark_as_sold" value="MAS">Unmark Sold Status</button>
        <?php }else{ ?>
        <button class="btn btn-primary" type="submit" name="mark_as_sold" value="MAS" id="mark_as_sold">Mark As Sold</button>
        <?php } ?>
    </form>


