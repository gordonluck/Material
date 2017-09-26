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
	