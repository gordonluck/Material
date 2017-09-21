<?php
//
function lb_timthumb($src,$width=375,$height=250,$q=100){
	return THEME_URL.'/timthumb.php?src='.$src.'&q='.$q.'&w='.$width.'&h='.$height.'&zc=1';
}
function lb_catch_first_image(){
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = isset($matches [1] [0]) ? $matches [1] [0] : '';
  if(empty($first_img)){	
		$random = mt_rand(1, 20);
		$first_img = THEME_URL;
		$first_img .= '/publicc/img/rand/'.$random.'.jpg';
  }
  return $first_img;
}