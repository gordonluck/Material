<?php 
/**
 * Template Name: 登录模板
 */
get_header('login');
global $current_user; 
get_currentuserinfo();
$uid = $current_user->ID;
?>
<?php if(is_user_logged_in()){ ?>
<script>alert("当前账号已登录，即将跳转至用户中心");window.location.href="<?php echo get_author_posts_url( $uid );?>";</script>
<?php }else{?>
	<div class="page-header header-filter" style="background-image: url(<?php bloginfo('template_url');?>/public/img/bg7.jpg); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div id="sign" class="card card-signup">
						<form id="login" class="form" action="<?php echo get_option('home'); ?>/wp-login.php" method="post" novalidate="novalidate">
							<div class="header header-primary text-center">
								<h4 class="card-title">Log in</h4>
								<div class="social-line">
									<a href="#pablo" class="btn btn-just-icon btn-simple">
										<i class="fa fa-weibo"></i>
									</a>
									<a href="#pablo" class="btn btn-just-icon btn-simple">
										<i class="fa fa-qq"></i>
									</a>
									<a href="#pablo" class="btn btn-just-icon btn-simple">
										<i class="fa fa-weixin"></i>
									</a>
								</div>
							</div>
							<p class="description text-center">Or 第三方登录</p>
							<div class="card-content">

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<div class="form-group is-empty"><input class="form-control" id="username" type="text" autocomplete="off" placeholder="请输入用户名" name="username" required="" aria-required="true"><span class="material-input"></span></div>
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<div class="form-group is-empty"><input class="form-control" id="password" type="password" placeholder="请输入密码" name="password" required="" aria-required="true"><span class="material-input"></span></div>
								</div>
							</div>
							<div class="footer text-center">
								<input class="btn btn-info btn-simple btn-wd btn-lg login-loader" type="button" value="立即登录" name="submit">
                                <input type="hidden" name="action" value="lb_login">
							</div>
							<input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
		                    <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		                    <div class="sign-tips"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>
<?php get_footer('login');?>
