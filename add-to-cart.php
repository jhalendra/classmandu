<div class="panel panel-primary">
                        <div class="panel-heading">Your Shopping Cart</div>
                        <div class="panel-body">
                            <?php if(isset($_SESSION['nc_osc_products'])){ $total=0.00;?>
                                <ul class='list-group'>
                                <?php foreach($_SESSION['nc_osc_products'] as $cart_item){ ?>
                                    <li class="list-group-item">
                                        <ul class="list-inline">
                                            <?php if($cart_item['resource_id']!=null){?>
                                                <img width="75" src="<?php echo osc_base_url().$cart_item['resource_id']; ?>"/>
                                            <?php }else{ ?>

                                            <?php } ?>
                                            <li><?php echo $cart_item['title']; ?></li>
                                            <li><?php echo number_format($cart_item['price']/1000000, 0, '.', ',');?></li> 
                                            <li><span class="btn-danger glyphicon glyphicon-remove">
                                                    <a   href="<?php echo osc_current_web_theme_url('includes/updateCart.php').
                                            '?remove='.$cart_item['id'].'&return_url='.urlencode(osc_item_url()); ?>">Remove Item</a>
                                            </span></li>
                                        </ul>
                                    </li>
                                    <?php $total=$total+$cart_item['price']; ?>    
                                    <?php } ?>
                                    <li><h3 class="text-right">Total : <?php echo number_format($total/1000000, 0, '.', ',');?> 
                                    <?php } ?>
                                
                            <div class="row">    
                            <form name="shopping-cart" action="<?php echo osc_current_web_theme_url('includes/updateCart.php'); ?>" method="get">
                                <input type="hidden" name="itemId" id="itemId" value='<?php echo osc_item_id();?>'>
                                <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                                <input type="hidden" name="price" id="price" value="<?php echo osc_item_price();?>">
                                <?php if(StockInHand::newInstance()->checkStockable(osc_item_id())){ ?>
                                <h5>Stock in hand:<?php echo StockInHand::newInstance()->getStock(osc_item_id());?> <h5>
                                <input type="hidden" name="stock" id="stock" value="<?php echo StockInHand::newInstance()->getStock(osc_item_id());?>">   
                                <div class="form-group">    
                                    <input type="number" name="demand" id="demand" max="<?php echo StockInHand::newInstance()->getStock(osc_item_id());?>" required>     
                                </div>
                                <?php }?>
                                <div class="row">
                                    <button class="btn btn-primary" type="submit" name="add_to_cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </div>
                            </form>
                            </div>
                            <form name="check-out" action="<?php echo osc_route_url("check-out") ?>" method="post">
                                <button class="btn btn-success" type="submit" name="check-out">Checkout</button>    
                            </form>

</div>
</div>
                    