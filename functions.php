<?php
// Theme Functions
define( 'THEME_VER', '1.0' );
define( 'THEME_PATH', dirname( __FILE__ ) );
define( "THEME_URL", get_bloginfo( 'template_directory' ) );
foreach ( glob( get_template_directory() . '/includes/*.php' ) as $filename ) {
  require $filename;
}
//注册功能
add_theme_support('post-thumbnails');
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'header-menu' => '顶部菜单',
			'login-menu'  => '登录菜单',
			'footer-menu'  => '底部菜单',
        )
    );
}
//Theme js css
function lb_scripts_styles() {
	global $wp_styles;
	$tpl = get_template_directory_uri().'/public/';
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'lb-jquery', 'https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js', array( 'jquery' ), THEME_VER, true );
	wp_enqueue_script( 'bootstrap', $tpl . 'js/bootstrap.min.js', array( 'jquery' ), THEME_VER, true );
	wp_enqueue_script( 'material', $tpl . 'js/material.min.js', array( 'jquery' ), THEME_VER, true );
	wp_enqueue_script( 'nouislider', $tpl . 'js/nouislider.min.js', array( 'jquery' ), THEME_VER, true );
	wp_enqueue_script( 'material', $tpl . 'js/material.js', array( 'jquery' ), THEME_VER, true );
	wp_enqueue_script( 'lb-app', $tpl . 'js/app.js', array( 'jquery' ), THEME_VER, true );
	
	wp_localize_script( 
	    'lb-app', 
		'barley', 
		array( 
		    'ajaxurl'        => admin_url( 'admin-ajax.php' ),
			'wp_url'         => home_url(), 
			'nonce'          => wp_create_nonce( 'lb' ),
			'uid'            => (int)get_current_user_id(), 
			'templateurl'    => get_template_directory_uri(), 
			'posts_per_page' => get_option('posts_per_page'),
			'order'          => get_option('comment_order'),
			'formpostion'    => 'bottom',
			'redirecturl'    => home_url(),
			'like'           => __( '喜欢'),
			'unlike'         => __( '取消喜欢'),
			'loadingmessage' => __('发送用户信息请稍等...')
			) 
		);
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', 'https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css', THEME_VER, true );
	wp_enqueue_style( 'lb-style', $tpl . 'css/style.css', THEME_VER, true );
	wp_enqueue_style( 'bootstrap', $tpl . 'css/bootstrap.min.css', THEME_VER, true );
	wp_enqueue_style( 'material-kit', $tpl . 'css/material.min.css', THEME_VER, true );
}
add_action( 'wp_enqueue_scripts', 'lb_scripts_styles' );




/**
功能说明: user url
更新时间：2016-11-11
**/
function get_user_url( $type='', $user_id=0 ){
	$user_id = intval($user_id);
	if( $user_id==0 ){
		$user_id = get_current_user_id();
	}
	$url = add_query_arg( '', $type, get_author_posts_url($user_id) );
	return $url;
}
/**
功能说明: 获取作者ID显示路径
更新时间：2017-02-28
**/
function barley_author_link($link, $author_id){
	global $wp_rewrite;
	$author_id = (int)$author_id;
	$link = $wp_rewrite->get_author_permastruct() . '.html';
	if(empty($link)){
		$file = home_url('/');
		$link = $file.'?author='.$author_id;
	}else{
		$link = str_replace('%author%', $author_id, $link);
		$link = home_url(user_trailingslashit($link));
	}
	return $link;
}
add_filter('author_link','barley_author_link',10,2);

function barley_author_link_request($query_vars){
	if(array_key_exists('author_name', $query_vars)){
		global $wpdb;
		$author_id = $query_vars['author_name'];
		if($author_id){
			$query_vars['author'] = $author_id;
			unset($query_vars['author_name']);
		}
	}
	return $query_vars;
}
add_filter('request','barley_author_link_request');
/**
功能说明: 获取缩略图地址
更新时间：2016-11-11
**/
function get_post_thumbnail(){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        return $timthumb_src[0];
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            return $strResult[1][0];
        } else {
            return false;
        }
    }
}
/**
功能说明: 时间以ago显示
更新时间：2016-11-11
**/
function lb_time_since( $older_date, $comment_date = false ) {
	$chunks = array(
		array( 24 * 60 * 60,' 天前' ),
		array( 60 * 60, ' 小时前'),
		array( 60, ' 分钟前' ),
		array( 1,' 秒前')
	);
	$newer_date = time();
	$since      = abs( $newer_date - $older_date );
	if ( $since < 30 * 24 * 60 * 60 ) {
		for ( $i = 0, $j = count( $chunks ); $i < $j; $i ++ ) {
			$seconds = $chunks[ $i ][0];
			$name    = $chunks[ $i ][1];
			if ( ( $count = floor( $since / $seconds ) ) != 0 ) {
				break;
			}
		}
		$output = $count . $name;
	} else {
		$output = $comment_date ? date( 'Y-m-d', $older_date ) : date( 'Y-m-d', $older_date );
	}

	return $output;
}
/**
功能说明: bootstrap_pagination
更新时间：2016-11-11
**/
function bootstrap_pagination($pages = '', $range = 2)  {  
    $showitems = ($range * 2)+1;  
    global $paged;  
    if( empty($paged)) $paged = 1;  
    if($pages == '')  {  
        global $wp_query;  
        $pages = $wp_query->max_num_pages;  
        if(!$pages){  
            $pages = 1;  
        }  
    }  
    if(1 != $pages)  {  
        echo '<ul class="pagination pagination-info">';  
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link(1).'"><i class="material-icons">keyboard_arrow_left</i>最新</a></li>';  
        if($paged > 1 && $showitems < $pages) echo '<li><a href="' .get_pagenum_link($paged - 1). '" rel="prev">上一页</a></li>';  
        for ($i=1; $i <= $pages; $i++)  {  
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))  {  
            echo ($paged == $i)? '<li class="active"><a href="#">'. $i .'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';  
        }  
    }  
    if ($paged < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged + 1).'" rel="next">下一页</a></li>';  
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($pages).'">最后<i class="material-icons">keyboard_arrow_right</i></a></li>';  
    echo '</ul>';  
    }  
}  
function news_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'monkey' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'news_wp_title', 10, 2 );