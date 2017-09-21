<?php 
/**
 * Template Name: 注册模板
 */
get_header('login');
global $current_user,$options; 
get_currentuserinfo();
$uid = $current_user->ID;
?>
<?php if(is_user_logged_in()){ ?>
<script>alert("当前账号已登录，即将跳转至用户中心");window.location.href="<?php echo get_author_posts_url( $uid );?>";</script>
<?php }else{?>
	<div class="page-header header-filter" filter-color="purple" style="background-image: url(<?php bloginfo('template_url');?>/public/img/bg7.jpg); background-size: cover; background-position: top center;">
    	<div class="container">
			<div class="row">
    			<div class="col-md-10 col-md-offset-1">

					<div class="card card-signup">
                        <h2 class="card-title text-center">注册会员</h2>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
            					<div class="info info-horizontal">
            						<div class="icon icon-rose">
            							<i class="material-icons">timeline</i>
            						</div>
            						<div class="description">
            							<h4 class="info-title">合作共赢</h4>
            							<p class="description">
            								如果你对WordPress很感兴趣，不妨联系我们，一起来探讨，合作共赢
            							</p>
            						</div>
            		        	</div>

            					<div class="info info-horizontal">
            						<div class="icon icon-primary">
            							<i class="material-icons">code</i>
            						</div>
            						<div class="description">
            							<h4 class="info-title">WordPress教程</h4>
            							<p class="description">
            								会员用户可以查看站点所有的WordPress教程 
            							</p>
            						</div>
            					</div>

            					<div class="info info-horizontal">
            						<div class="icon icon-info">
            							<i class="material-icons">group</i>
            						</div>
            						<div class="description">
            							<h4 class="info-title">主题分享</h4>
            							<p class="description">
            								不定时的干货分享
            							</p>
										<p class="description">
            								WordPress主题
            							</p>
										<p class="description">
            								typecho主题
            							</p>
            						</div>
            					</div>
            				</div>
                            <div id="sign" class="col-md-5">
								<form class="form" id="register" action="<?php bloginfo('url'); ?>/wp-login.php?action=register" method="post" novalidate="novalidate">
									<div class="card-content">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">face</i>
											</span>
											<div class="form-group is-empty">
												<input class="form-control" id="user_name" type="text" name="user_name" placeholder="输入英文用户名" required="" aria-required="true">
												<span class="material-input"></span>
											</div>
										</div>

										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">email</i>
											</span>
											<div class="form-group is-empty">
												<input class="form-control" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱" required="" aria-required="true">
												<span class="material-input"></span>
											</div>
										</div>
	        							<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">fingerprint</i>
											</span>.
											<div class="col-md-7">
											    <div class="form-group is-empty">
													<input class="form-control inline" type="text" id="captcha" name="captcha" placeholder="输入验证码" required>
												    <span class="material-input"></span>
												</div>
											</div>
											<div class="col-md-5">
												<span class="btn btn-primary btn-sm captchaBtn">发送验证码</span>
											</div>
											
										</div>
										
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">lock_outline</i>
											</span>
											<div class="form-group is-empty">
												<input class="form-control" id="user_pass" type="password" name="user_pass" placeholder="密码最小长度为6" required="" aria-required="true">
												<span class="material-input"></span>
											</div>
										</div>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">lock</i>
											</span>
											<div class="form-group is-empty">
												<input class="form-control" id="user_pass2" type="password" name="user_pass2" placeholder="再次输入密码" required="" aria-required="true">
											    <span class="material-input"></span>
											</div>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="optionsCheckboxes" checked="">
												点击“立即注册”同意相关 <a href="#something">条款</a>.
											</label>
										</div>
									</div>
									<div class="footer text-center">
										<input type="hidden" name="action" value="lb_register">
                                        <input class="btn btn-primary btn-round inline register-loader" type="button" value="立即注册" name="submit">
									</div>
									<input type="hidden" id="user_security" name="user_security" value="<?php echo  wp_create_nonce( 'user_security_nonce' );?>">
		                            <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
		                            <div class="sign-tips"></div>
								</form>
                            </div>
                        </div>
                	</div>

                </div>
            </div>
		</div>
    </div>
<?php }?>
<?php get_footer('login');?>
