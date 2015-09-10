<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 class="popular-categories">Popular Categories</h4>
    </div>
</div>
<?php $p_c = popular_category_start();?>
<div id="popular-categories">
<div class="row">
    <?php $sliced_array = array_slice($p_c, 0, 4); ?>
    <?php
        foreach ($sliced_array as $sa) {
            $top_item=select_top_item($sa['cat_id']);
            if($top_item==null || empty($top_item)){

            }else{
                $primary_id = (int)$top_item[0]['fk_i_item_id'];
                $item     = Item::newInstance()->findByPrimaryKey($primary_id);
                View::newInstance()->_exportVariableToView('item', $item);
            }
            
        }

    ?>
            <?php foreach ($sliced_array as $sa)  { ?>
            <?php $top_item=select_top_item($sa['cat_id']); 
                if($top_item==null || empty($top_item)){
                    $no_item=false;
                    $category_name = get_category_name($sa['cat_id']);
                }else{
                    $no_item=true;
                    $primary_id = (int)$top_item[0]['fk_i_item_id'];
                    $item     = Item::newInstance()->findByPrimaryKey($primary_id);
                    View::newInstance()->_exportVariableToView('item', $item);
                    $category_name = get_parent_category_name(osc_item_category_id());
                        
                }
            ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="automobile">
                        <h5 class="auto"><?php echo $category_name; ?></h5>
                        <?php if( osc_count_item_resources() ) { ?>
                            <a href="<?php echo osc_item_url(); ?>">
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="240" height="200" class="img-responsive"  title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" />
                            </a>
                        <?php } else { ?>
                             <img src="<?php echo osc_current_web_theme_url('images/no-image-available.png'); ?>" width="240" height="200" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-responsive" />
                        <?php } ?>
                        <div class="hr"></div>
                        <ul style="margin-top:20px; border-bottom:1px solid #ededed;" class="list-inline button-list-categories">
                            <li><i style="color:#27beaf; font-size:20px;" class="fa fa-map-marker fa-1x"></i></li>
                            <li><h5><?php echo get_total_listing_by_category(osc_item_category_id()); ?> Listings</h5></li>
                        </ul>

                        <ul style="border-bottom:1px solid #ededed;" class="list-inline">
                            <li><i style="color:#27beaf" class="fa fa-tags fa-1x"></i></li>
                            <li><h5>3019 Hot Deals</h5></li>
                        </ul>   
                        <dl class="dl-horizontal">
                            <dt><i style="color:#27beaf" class="fa fa-comment fa-1x fa-custom"></i></dt>
                            <dd id="hidden_list" style="margin-left:10px;" class="href_<?php echo osc_item_category_id(); ?> ">
                                <h6>
                                      <?php $subcategory=get_parent_subcategories(osc_item_category_id()); ?>
                                        <?php $i=0; ?>
                                        <?php foreach($subcategory as $sb){ ?>
                                                <?php if ($i==0){
                                                    echo "<a href=".$sb['url']." style='color:#3a3b3b;'>".$sb['name']."</a>";
                                                }else{
                                                    echo "&nbsp;&nbsp;|&nbsp;&nbsp; <a href=".$sb['url']." style='color:#3a3b3b;'>".$sb['name']."</a>";
                                                }
                                                $i=$i+1;
                                                ?>
                                        <?php } ?>
                                </h6>
                            </dd>
                        </dl>
                        <a href="javascript:void(0);" class="seeAll_<?php echo osc_item_category_id(); ?>" onClick="seeAllSubcategories(<?php echo osc_item_category_id(); ?>)" >
                            <div  style="padding-bottom:4px;text-align:center;color:#000;">
                                <!--<img class="img-responsive" src="<?php echo osc_base_url().'oc-content/themes/classified/images/down.jpg'; ?>">-->
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </div>
                        </a>
                        <a href="javascript:void(0);" class="hideAll_<?php echo osc_item_category_id(); ?>" onClick="hideAllSubcategories(<?php echo osc_item_category_id(); ?>)" style="display:none;">
                            <div  style="padding-bottom:4px;text-align:center;color:#000">
                                <span class="glyphicon glyphicon-chevron-up"></span>
                            </div>
                        </a>
                        
                        
                    </div>
                </div>  
            <?php } ?> 
    <?php popular_ads_end(); ?>
</div>
</div>
<div style="padding:20px 0px;" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="show-more-main" class="custom-btn">SEE MORE</div>
        <div class="show-animation">
            <img src="<?php echo osc_base_url().'oc-content/themes/classified/images/ajax-loader.gif'; ?>" />
        </div>
    </div>    
</div>  