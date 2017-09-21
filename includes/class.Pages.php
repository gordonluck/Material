<?php
/**
功能说明: 自动创建页面
更新时间：2016-11-11
**/
function barley_add_pages(){
	if(isset($_GET['activated'])&&is_admin()){
		$title   = array(
		            '登录账号',
					'注册账号'
				);
		$name    = array(
		            'login-in',
					'register'
				);
		$content = array(
		            '',
					''
				);
		$template = array(
		            'page-login.php',
					'page-register.php'
					);
		for($i=0;$i<2;$i++){
			$page = array(
				'post_type'	=> 'page',
				'post_title' => $title[$i],
				'post_name' => $name[$i],
				'post_content' => $content[$i],
				'post_status' => 'publish',
				'post_author' => 1		
			);
			$check = get_page_by_title($title[$i]);
			if(!isset($check->ID)){
				$page_id = wp_insert_post($page);
				if(!empty($template[$i])){
					update_post_meta($page_id,'_wp_page_template',$template[$i]);
			
				}	
			}
		}
	}
  }
add_action('load-themes.php', 'barley_add_pages' );