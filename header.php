<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url');?>/public/img/logo.png">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url');?>/public/img/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<?php wp_head(); ?>
</head>

<body class="<?php if ( is_single() ){echo "blog-post"; }elseif (is_author()){echo" profile-page"; }else {echo"about-us";} ?>">
	<nav class="line-b navbar navbar-default <?php if ( is_single() ){echo "line-b"; }?>">
    	<div class="container">
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a href="<?php echo home_url(); ?>">
	        	<div class="logo-container">
	                <div class="logo">
	                    <?php echo get_logo_icon();?>
	                </div>
				</div>
	      	    <div class="ripple-container"></div>
			    </a>
        	</div>
			
        	<div class="collapse navbar-collapse">
        		<ul class="nav navbar-nav navbar-right">
				    <?php $current_user = wp_get_current_user();if ( 0 == $current_user->ID ) {?>
					<li>
    					<a href="register.html">
    						<i class="material-icons">fingerprint</i> 注册
    					</a>
    				</li>
					<li>
    					<a href="login-in.html" class="btn btn-info btn-simple">
    						<i class="material-icons">exit_to_app</i> 登录
    					</a>
    				</li>
					<?php } else { ?>
					<li class="dropdown">
	                    <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                        <div class="profile-photo-small header-author">
								<?php echo get_avatar( $current_user->ID , '40' ); ?>
	                        </div>
	                        <div class="ripple-container"></div>
						</a>
	                    <ul class="dropdown-menu">
	                        <li><a href="<?php echo get_user_url('',get_current_user_id()); ?>">个人中心</a></li>
	                        <li><a href="#pablo">安全设置</a></li>
	                        <li class="divider"></li>
	                        <li><a href="<?php echo wp_logout_url(get_bloginfo('url'));?>">注销登录</a></li>
	                    </ul>
	                </li>
					<?php } ?>
        		</ul>
				<?php wp_nav_menu( array( 'walker' => new JWalker_Nav_Menu(),'theme_location' => 'header-menu','menu_id'=>'main-menu','menu_class'=>'nav navbar-nav navbar-right','container'=>'ul')); ?>
        	</div>
    	</div>
    </nav>