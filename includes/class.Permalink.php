<?php
/**
功能说明: 强制性跳转代码，访问/wp-admin 即可跳转
更新时间：2016-11-11
**/
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}
add_action( 'admin_init', 'redirect_non_admin_users' );

/**
功能说明: 更改固定连接以.html结尾显示
更新时间：2016-11-11
**/
add_action('init', 'html_page_permalink', -1);
register_activation_hook(__FILE__, 'barley_active');
register_deactivation_hook(__FILE__, 'barley_deactive');
function html_page_permalink() {
    global $wp_rewrite;
    if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
        $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
    } 
}
add_filter('user_trailingslashit', 'no_page_slash',66,2);
function no_page_slash($string, $type){
    global $wp_rewrite;
    if ($wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes==true && $type == 'page'){
        return untrailingslashit($string);
    } else {
        return $string;
    }
}

function barley_active() {
    global $wp_rewrite;
    if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
        $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
    }
    $wp_rewrite->flush_rules();
}
function barley_deactive() {
    global $wp_rewrite;
    $wp_rewrite->page_structure = str_replace(".html","",$wp_rewrite->page_structure);
    $wp_rewrite->flush_rules();
}