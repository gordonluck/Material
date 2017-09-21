<?php get_header();?>
    <div class="main">
		<div class="container">
            <div class="about-office">
                <div class="row">
					<div class="col-md-7">
					    <div class="card card-raised card-carousel">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<div class="carousel slide" data-ride="carousel">

									<ol class="carousel-indicators">
										<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
										<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
										<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
									</ol>

									<div class="carousel-inner">
										<div class="item">
											<img src="<?php bloginfo('template_url');?>/public/img/bg2.jpg" alt="Awesome Image">
											<div class="carousel-caption">
												<h4> 首页轮播还未完善，暂不能自动获取后台文章</h4>
											</div>
										</div>
										<div class="item">
											<img src="<?php bloginfo('template_url');?>/public/img/bg3.jpg" alt="Awesome Image">
											<div class="carousel-caption">
												<h4> 首页轮播还未完善，暂不能自动获取后台文章</h4>
											</div>
										</div>
										<div class="item active">
											<img src="<?php bloginfo('template_url');?>/public/img/bg.jpg" alt="Awesome Image">
											<div class="carousel-caption">
												<h4> 首页轮播还未完善，暂不能自动获取后台文章</h4>
											</div>
										</div>
									</div>

									<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
										<i class="material-icons">keyboard_arrow_left</i>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
										<i class="material-icons">keyboard_arrow_right</i>
									</a>
								</div>
							</div>
						</div>
						<?php if (have_posts()) : while (have_posts()) : the_post();
					       get_template_part('content', get_post_format()); 
					    endwhile; echo bootstrap_pagination(); endif;?>
                    </div>
					<div class="col-md-2"></div>
					<?php get_sidebar() ;?>
				</div>

            </div>
        </div>
    </div>
<?php get_footer();?>