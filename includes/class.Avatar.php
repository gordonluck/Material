<?php
//avatars
function lb_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'lb_get_ssl_avatar');
add_filter('get_avatar', 'lb_get_avatar', 10, 3);
function lb_get_avatar($avatar, $id_or_email, $size){
	$default_avatar = get_bloginfo('template_url').'/public/img/avatar.jpg';
	if(is_object($id_or_email)) {
      if($id_or_email->user_id != 0) {
        $email = $id_or_email->user_id;
		$user = get_user_by('email',$email);
		$user_avatar = get_user_meta($id_or_email->user_id, 'photo', true);
		if($user_avatar)
		  return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
		else
		  return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
      
      }elseif(!empty($id_or_email->comment_author_email)) {
		return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
      }
    }else{
		if(is_numeric($id_or_email) && $id_or_email > 0){
			$user = get_user_by('id',$id_or_email);
			$user_avatar = get_user_meta($id_or_email, 'photo', true);
			if($user_avatar)
			  return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
			else
			  return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
		}elseif(is_email($id_or_email)){
			$user = get_user_by('email',$id_or_email);
			$user_avatar = get_user_meta($user->ID, 'photo', true);
			if($user_avatar)
			  return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
			else
			  return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="'.$user->display_name .'" />';
		}else{
			return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" alt="" />';
		}
	}
	return $avatar;
}
function lb_get_user_photo($id,$size,$class='avatar'){
	$photo = get_user_meta($id, 'photo', true);
	if($photo) echo '<img class="'.$class.'" data-src="'.$photo.'" width="'.$size.'" height="'.$size.'" src="'.$photo.'">';
	else echo '<img class="'.$class.'" data-src="'.THEME_URL.'/public/img/avatar.jpg" width="'.$size.'" height="'.$size.'" src="'.THEME_URL.'/public/img/avatar.jpg">';
}

function lb_get_user_photo2($id,$size,$class='avatar'){
	$photo = get_user_meta($id, 'photo', true);
	if($photo) return '<img class="'.$class.'" data-src="'.$photo.'" width="'.$size.'" height="'.$size.'">';
	else return '<img class="'.$class.'" data-src="'.THEME_URL.'/public/img/avatar.jpg" width="'.$size.'" height="'.$size.'">';
}