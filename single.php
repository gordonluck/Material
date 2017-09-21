<?php get_header();?>
   <div class="single-main">
		<div class="container">
		<?php if (have_posts()) :?>
            <div class="section section-text">
                <div class="row">
				    <?php while (have_posts()) : the_post(); ?>
    				<div id="<?php echo $post->ID?>" class="col-md-8 col-md-offset-2 single-content">
        				<h3 class="title"><?php the_title(); ?></h3>
    					<?php the_content(); ?>
					</div>
					<?php endwhile;?>
				</div>
			</div>

			<div class="section section-blog-info">
                <div class="row">
					<div class="col-md-8 col-md-offset-2">

						<div class="row">
							<div class="col-md-9">
								<div class="blog-tags">
									<?php the_tags('<div class="tag-links">Tags:',' ','</div>'); ?> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="dropup">
                                      <button href="#pablo" class="dropdown-toggle btn btn-info btn-sm pull-right" data-toggle="dropdown" aria-expanded="true">分享 <b class="caret"></b><div class="ripple-container"></div></button>
                                      <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="http://service.weibo.com/share/share.php?title=<?php the_title(); ?>&appkey=4221439169&url=<?php the_permalink() ?>" onclick="window.open(this.href, 'weibo-share', 'width=550,height=235');return false;"><i class="fa fa-weibo"></i>  weibo</a></li>
                                        <li class="divider"></li>
                                        <li><a href="http://qr.liantu.com/api.php?text=<?php the_permalink();?>" onclick="window.open(this.href, 'wechat-share', 'width=550,height=235');return false;"><i class="fa fa-weixin"></i>  weixin</a></li>
                                      </ul>
								</div>
							</div>
						</div>
						<hr />
					</div>
    			</div>
            </div>

			<div class="section section-comments">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<?php comments_template( '', true ); ?>
					</div>
				</div>
			</div>
        <?php endif;?>
        </div>
    </div>
<?php get_footer();?>
