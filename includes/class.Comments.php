<?php
/**
功能说明: 评论回复自动添加@
更新时间：2016-11-11
**/
function barley_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }
  return $comment_text;
}
add_filter( 'comment_text' , 'barley_comment_add_at', 20, 2);
/**
功能说明:评论构造
更新时间：2016-11-11
**/
function comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> </p>
            <?php
            break;
        default :
            global $post;
            ?>     
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
            <div class="media">
				<a class="pull-left" href="#pablo">
		        	<div class="avatar">
		        		<?php lb_get_user_photo($comment->user_id,64,'avatar');?>
		        	</div>
		        </a>
				<div class="media-body">
		        	<h4 class="media-heading"><?php echo get_comment_author_link(); ?> <small>· <?php echo lb_time_since(strtotime($comment->comment_date_gmt), true ); ?></small></h4>

		        	<p><?php comment_text(); ?></p>

		        	<div class="media-footer">
					<?php comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => '<i class="material-icons">reply</i>回复',
					'login_text' => '登录回复',
					'before'     => '',
					'after'      => ''
				     ) ) ) ?>
		        	</div>
		        </div>
			</div>
			</li>
            <?php
            break;
    endswitch;
}
/**
功能说明: 个性化 Cancel Reply link
更新时间：2017-03-27
**/
function add_comment_author_to_cancel_reply_link($formatted_link, $link, $text){
    $comment = get_comment( $comment );
    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->user_login;
        } else {
            $author = '';
        }
    } else {
        $author = $comment->comment_author;
    }
    if(strpos($author, ' ')){
        $author = substr($author, 0, strpos($author, ' '));
    }
    $formatted_link = str_ireplace($text, '取消'. $author, $formatted_link);
    return $formatted_link;
}
add_filter('cancel_comment_reply_link', 'add_comment_author_to_cancel_reply_link', 10, 3);
/**
功能说明:添加ajax评论
更新时间：2016-11-11
**/
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	wp_die('请升级到4.4以上版本');
}
if(!function_exists('fa_ajax_comment_err')) :

    function fa_ajax_comment_err($a) {
        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $a;
        exit;
    }

endif;
if(!function_exists('fa_ajax_comment_callback')) :
    function fa_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if ( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( ! empty( $data ) ) {
            	fa_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment; 
        ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
            <div class="media">
				<a class="pull-left" href="#pablo">
		        	<div class="avatar">
		        		<?php lb_get_user_photo($comment->user_id,64,'avatar');?>
		        	</div>
		        </a>
				<div class="media-body">
		        	<h4 class="media-heading"><?php echo get_comment_author_link(); ?> <small>· <?php echo lb_time_since(strtotime($comment->comment_date_gmt), true ); ?></small></h4>

		        	<p><?php comment_text(); ?></p>

		        	<div class="media-footer">
					<?php comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => '<i class="material-icons">reply</i>Reply',
					'login_text' => 'login Reply',
					'before'     => '',
					'after'      => ''
				    ) ) ) ?>
		        		<a href="#pablo" class="btn btn-danger btn-simple pull-right">
		        			<i class="material-icons">favorite</i> 243
		        		</a>
		        	</div>
		        </div>
			</div>
        </li>
        <?php die();
    }

endif;
add_action('wp_ajax_nopriv_ajax_comment', 'fa_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'fa_ajax_comment_callback');
/**
功能说明: 评论图片地址自动转化为图片
更新时间：2016-11-11
**/
define('ALLOW_POSTS', '');
function lb_comment_image( $comment ) {
    $post_ID = $comment["comment_post_ID"];
    $allow_posts = ALLOW_POSTS ? explode(',', ALLOW_POSTS) : array();
    if(in_array($post_ID,$allow_posts) || empty($allow_posts) ){
        global $allowedtags;
        $content = $comment["comment_content"];
        $content = preg_replace('/(https?:\/\/\S+\.(?:jpg|png|jpeg|gif))+/','<img src="$0" alt="" />',$content);
        $allowedtags['img'] = array('src' => array (), 'alt' => array ());
        $comment["comment_content"] = $content;
    }
    return $comment;
}
add_filter('preprocess_comment', 'lb_comment_image');