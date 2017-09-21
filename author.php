<?php get_header();?>
<div class="page-header-author">author的个人中心</div>
	<div class="main">
		<div class="profile-content">
            <div class="container">
			    <div class="row author-tab">
					<div class="col-md-6 col-md-offset-3">
						<div class="profile-tabs">
		                    <div class="nav-align-center">
								<ul class="nav nav-pills nav-pills-icons" role="tablist">
									<li class="active">
			                            <a href="#work" role="tab" data-toggle="tab" aria-expanded="true">
											<i class="material-icons">description</i>
											文章
			                            </a>
			                        </li>
                                    <li class="">
										<a href="#connections" role="tab" data-toggle="tab" aria-expanded="false">
											<i class="material-icons">favorite</i>
											喜欢
										</a>
									</li>
			                        <li class="">
			                            <a href="#media" role="tab" data-toggle="tab" aria-expanded="false">
											<i class="material-icons">person</i>
			                                个人资料
			                            </a>
			                        </li>
			                    </ul>


							</div>
						</div>
					</div>
                </div>
				<div class="tab-content">
			        <div class="tab-pane work active" id="work">
				        <div class="row">
				        <?php if (have_posts()) : while (have_posts()) : the_post();?>
					        <div class="col-md-4">
						        <div class="card card-raised card-background" style="background-image: url(<?php echo get_post_thumbnail();?>)">
							        <div class="card-content">
								        <label class="label label-primary"><?php foreach((get_the_category()) as $category){echo $category->cat_name;}?></label>
								    <a href="<?php the_permalink() ?>">
									    <h3 class="card-title"><?php the_title(); ?></h3>
								    </a>
							    </div>
						    </div>
					    </div>
					    <?php  endwhile; ?>
					    <div class="col-md-12">
					        <?php bootstrap_pagination();?>
					    </div>
					    <?php endif;?>
				    </div>
			        </div>
                    <div class="tab-pane connections" id="connections">
                        <div class="row">
	                        <div class="col-md-12">
		                        <div class="row collections">
			                        <?php show_user_likes($user_info);?>
                                </div>
		                    </div>
	                    </div>
                    </div>
                    <div class="tab-pane text-center gallery" id="media">
						<div class="row">
							站位编辑中...
						</div>
                    </div>
			    </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>