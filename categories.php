<?php
    function Subcategory($category) {
        if ( osc_count_subcategories2() > 0 ) {
            osc_category_move_to_children();
            ?>
            <div id="cat_<?php echo $category['pk_i_id'];?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                <?php while ( osc_has_categories() ) { ?>
                    <?php if(osc_category_total_items()<1 && nc_osc_hide_categories()){
                            continue;
                        } ?> 
                    <li>
                    <a data-parent="#cat_<?php echo $category['pk_i_id'];?>" href="<?php echo osc_search_category_url(); ?>">
                        <?php echo osc_category_name(); ?>
                    </a>
                    <span>(<?php echo osc_category_total_items(); ?>)</span><?php Subcategory(osc_category()); ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
        <?php
            osc_category_move_to_parent();
        }
    }
?>

<?php osc_goto_first_category(); ?>
<?php if(osc_has_categories() > 0) { ?>    
<section>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <?php osc_goto_first_category(); ?>
                        <?php while ( osc_has_categories() ) { ?>
                        <?php if(osc_category_total_items()<1 && nc_osc_hide_categories()){
                            continue;
                        } ?> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#cat_<?php echo osc_category_id(); ?>">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            <?php echo osc_category_name(); ?>
                                    </a>
                                </h4>
                            </div>
                            
                                            <?php  Subcategory(osc_category());?>
                            
                        </div>
                        <?php }//END WHILE ?>
                    </div>

            </div>
        </div>
    </div>
</div>                        
 <?php } //END IF ?>
                