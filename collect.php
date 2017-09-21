<?php $barleycollects=get_post_meta(get_the_ID(),'barley_post_collects',true); if(empty($barleycollects)):$barleycollects=0; endif;?>
    <?php if(empty($barleycollects)):$barleycollects=0; endif;?>
	<?php $uid = get_current_user_id(); if(!empty($uid)&&$uid!=0){ ?>		
		<?php $mycollects = get_user_meta($uid,'barley_collect',true);
			$mycollects = explode(',',$mycollects);
		?>
		<?php global $curauth; ?>
		<?php if (!in_array($post->ID,$mycollects)){ ?>
		<span  class="btn btn-white btn-simple collect-btn collect-no" pid="<?php get_the_ID() ; ?>" uid="<?php echo get_current_user_id(); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-container="body" data-original-title="点击收藏">
	    	<i class="material-icons">star_border</i> <span><?php echo $barleycollects; ?></span>
	    	<div class="ripple-container"></div>
		</span> 
		<?php }elseif(isset($curauth->ID)&&$curauth->ID==$uid){ ?>
		<span  class="postlist-meta-collect collect-btn collect-yes remove-collect btn btn-white btn-simple" pid="<?php get_the_ID() ; ?>" uid="<?php echo get_current_user_id(); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-container="body" data-original-title="取消收藏">
	    	<i class="material-icons">star_border</i> <span><?php echo $barleycollects; ?></span>
	    	<div class="ripple-container"></div>
		</span>
		<?php }else{ ?>
		<span  class="btn btn-white btn-simple collect-btn collect-yes" uid="<?php echo get_current_user_id(); ?>" data-toggle="tooltip" data-placement="bottom" title="" data-container="body" data-original-title="已收藏">
	    	<i class="material-icons">star</i> <span><?php echo $barleycollects; ?></span>
	    	<div class="ripple-container"></div>
		</span>
		<?php } ?>
		<?php }else{ ?>
		<a href="/login-in.html"><span  class="btn btn-white btn-simple collect-btn collect-no" data-toggle="tooltip" data-placement="bottom" title="" data-container="body" data-original-title="必须登录才能收藏">
	    	<i class="material-icons">star_border</i> <span><?php echo $barleycollects; ?></span>
	    	<div class="ripple-container"></div>
		</span></a>
<?php } ?>