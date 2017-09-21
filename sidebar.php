                    <div class="col-md-3 hidden-xs">
					    <div class="row">
							<div class="col-md-12">
							    <!--<div class="card card-pricing">
	    							<div class="card-content content-info">
	    								<div class="icon">
	    									<i class="material-icons">beach_access</i>
	    								</div>
	    								<h3 class="card-title">￥259</h3>
	    								<p class="card-description">
	    									一款用心的主题
	    								</p>
	    								<a href="#pablo" class="btn btn-white btn-round">立即购买</a>
	    							</div>
	    						</div>-->
								<?php $html = '<div class="blog-tags"><h5 class="products-title">Tags</h5> <hr>';
                                    foreach (get_tags( array('number' => 6, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false) ) as $tag){
	                                $tag_link = get_tag_link($tag->term_id);
	                                $html .= "<a href='{$tag_link}' title='查看更多关于 {$tag->name} 标签的文章' class='{$tag->slug} btn btn-info btn-sm' target='_blank'>";
	                                $html .= "{$tag->name} ";
									$html .= "({$tag->count})</a>";
                                    }
                                $html .= '</div>';
                                echo $html;
							    ?>
								<div class="textwidget"><hr>
								    <h5 class="products-title">最近编辑</h5>
									<?php 
							        $cmntCnt = 1;
				                    $args  = array(
					                    'orderby'             => 'modified',
					                    'ignore_sticky_posts' => 1,
					                    'post_type'           => 'post',
					                    'post_status'         => 'publish',
					                    'showposts'           => 5
				                        );
				                    $posts = query_posts( $args ); 
								    while ( have_posts() ) : the_post(); ?>
                                    <div class="product"> 
										<div class="image">
											<a target="_blank" href="<?php the_permalink(); ?>">
												<img src="<?php echo get_post_thumbnail();?>" alt="<?php the_title(); ?>">
										    </a>
										</div>
									    <div class="description">
											<p><?php the_title(); ?></p>
										</div>
									</div>
									<?php endwhile;wp_reset_query();$posts = null;?>
							    </div>
							</div>
						</div>
					</div>