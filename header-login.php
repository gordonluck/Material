<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<?php wp_head(); ?>
</head>

<body class="<?php if ( is_page('login-in') ){echo "login-page"; }else {echo"signup-page";} ?>">
	<nav class="navbar navbar-info navbar-transparent navbar-absolute">
    	<div class="container">
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        	</div>

        	<div class="collpase navbar-collapse">
        		<?php wp_nav_menu( array( 'walker' => new JWalker_Nav_Menu(),'theme_location' => 'login-menu','menu_id'=>'main-menu','menu_class'=>'nav navbar-nav navbar-right','container'=>'ul')); ?>
        	</div>
    	</div>
    </nav>