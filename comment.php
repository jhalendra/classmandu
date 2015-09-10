<div class="container">
	<div class="row">       
        <!-- panel preview -->
        <div class="col-sm-8">
            <h4>Comments</h4>
			<?php if( osc_count_item_comments() >= 1 ) { ?>
				<div class="comments_list">
			        <?php while ( osc_has_item_comments() ) { ?>
			            <div class="comment">
			                <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'tukucha'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
			               	<p><?php echo nl2br( osc_comment_body() ); ?> </p>
			                <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
			                    <p>
			                        <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'tukucha'); ?>"><?php _e('Delete', 'tukucha'); ?></a>
			                    </p>
			                <?php } ?>
			            </div>
			        <?php } ?>
			        <div class="paginate" style="text-align: right;">
			            <?php echo osc_comments_pagination(); ?>
			        </div>
			    </div>
			<?php } ?>
            <script>
            $(document).ready(function(){
                $(".req").hide();
            });
            </script>    
            <div class="panel panel-default">
                <div class="panel-body form-horizontal">

					<form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                        <div class='req'>
                            <label for='website'>Leave blank</label>
                            <input type='text' name='website'>
                            <input type="hidden" name="return_url" id="return_url" value="<?php echo osc_item_url();?>">
                        </div>
                        
                        <input type="hidden" name="action" value="add_comment" />
                        <input type="hidden" name="page" value="item" />
                        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                        <?php if(osc_is_web_user_logged_in()) { ?>
                            <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                            <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                        <?php }  ?>
                    <div class="form-group">
                        <label for="concept" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="10" id="body" name="body"></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary ">
                                <span class="glyphicon glyphicon-comment"></span> Post It
                            </button>
                        </div>
                    </div>
                	</form>
                </div>
            </div>            
        </div> <!-- / panel preview -->
        
	</div>
</div>