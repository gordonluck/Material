<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area clearfix">
	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( '评论已经被关闭。', 'barley' ); ?></p>
	<?php endif;?>
	<div id="respond" class="respond" role="form">
	
	<form class="form comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" novalidate="novalidate">
	    <?php if ( $user_ID ) : ?>
		<div class="media media-post"><div class="media-body">
		<div class="form-group is-empty">
		    <textarea id="comment" class="form-control" name="comment" placeholder="说点什么..." rows="6"></textarea>
			<span class="material-input"></span>
		</div></div></div>
		<?php else : ?>
		<div class="media media-post"><div class="media-body">
		<div class="row">
		    <div class="col-md-4">
		        <div class="form-group is-empty">
					<input type="text" name="author" id="author" title="昵称" value="<?php echo $comment_author; ?>" class="form-control" placeholder="昵称*" required="">
		        	<span class="material-input"></span>
				</div>
		    </div>
		    <div class="col-md-4">
		        <div class="form-group is-empty">
					<input type="text" name="email" id="email" title="邮箱" value="<?php echo $comment_author_email; ?>" class="form-control" placeholder="邮箱*" required="">
		        	<span class="material-input"></span>
				</div>
		    </div>
			 <div class="col-md-4">
		        <div class="form-group is-empty">
					<input type="text" name="url" id="url" title="网站" value="<?php echo $comment_author_url; ?>" class="form-control" placeholder="网站">
		        	<span class="material-input"></span>
				</div>
		    </div>
		</div>
		<div class="form-group is-empty">
		    <textarea id="comment" class="form-control" name="comment" placeholder="说点什么..." rows="6"></textarea>
			<span class="material-input"></span>
		</div>
		</div></div>
		<?php endif; ?>
		<div class="media-footer">
			<input name="submit" type="submit" id="submit" class="btn btn-info pull-left" tabindex="5" value="发布评论" />
			<?php cancel_comment_reply_link() ?>
		</div>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
    </form>
	</div>
	<div class="line"><ul class="clearfix"></ul></div>
	<?php if ( have_comments() ) : ?>
	<div class="comments-box">
        <div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i> 加载中...</span></div>
		<ol class="commentlist">
			<?php wp_list_comments('callback=comment&max_depth=10000'); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="comments-navi">
				<?php paginate_comments_links('prev_text=《&next_text=》'); ?>
			</div>
		
		<?php endif;?>	
	</div>
	<?php endif; ?>
</div>