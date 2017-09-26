                        <article id="post-<?php the_ID(); ?>" class="article" itemtype="http://schema.org/Article" itemscope="itemscope">
						    <div class="row post-list">
						        <div class="col-md-12">
							        <div class="avotar">
							            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank">
								            <?php echo get_avatar( $curauth->ID, 40 ); ?>
								        </a>
							        </div>
								    <div class="author-info">
							            <p class="name">
								            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a>
								        </p>
								        <p class="post-date"><?php echo lb_time_since(strtotime($post->post_date_gmt)); ?></p>
							        </div>
	                            </div>
	                        </div>
					        <div class="card card-background no-bottom" style="background-image: url(<?php echo get_post_thumbnail();?>)">
	    					    <div class="card-content">
									<a href="<?php echo home_url(); ?>/category/<?php foreach((get_the_category()) as $category){echo $category->cat_name;}?>">
	    								<h4 class="card-title"><i class="material-icons">apps</i> <?php foreach((get_the_category()) as $category){echo $category->cat_name;}?></h4>
	    							</a>
									
	    							<?php require( get_template_directory() . '/collect.php' );?>
	    							<a class="btn btn-white btn-simple" data-toggle="tooltip" data-placement="bottom" title="" data-container="body" data-original-title="评论数">
	    								<i class="material-icons">chat_bubble</i> <?php comments_number('0', '1 ', '% '); ?>
										<div class="ripple-container"></div>
	    							</a>
									<?php echo get_simple_likes_button( get_the_ID() );?>
	    						</div>
	    				    </div>
						    <h1 class="post-title">
						        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						    </h1>
						    <p class="post-ep"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 140,"…"); ?></p>
						    <hr>
						</article>