(function( $ ) {
	'use strict';
	$(document).on('click', '.sl-button', function() {
		var button = $(this);
		var post_id = button.attr('data-post-id');
		var security = button.attr('data-nonce');
		var iscomment = button.attr('data-iscomment');
		var allbuttons;
		if ( iscomment === '1' ) { 
			allbuttons = $('.sl-comment-button-'+post_id);
		} else {
			allbuttons = $('.sl-button-'+post_id);
		}
		var loader = allbuttons.next('#sl-loader');
		if (post_id !== '') {
			$.ajax({
				type: 'POST',
				url: barley.ajaxurl,
				data : {
					action : 'process_simple_like',
					post_id : post_id,
					nonce : security,
					is_comment : iscomment,
				},
				beforeSend:function(){
					loader.html('&nbsp;<div class="loader"></div>');
				},	
				success: function(response){
					var icon = response.icon;
					var count = response.count;
					allbuttons.html(icon+count);
					if(response.status === 'unliked') {
						var like_text = barley.like;
						allbuttons.prop('title', like_text);
						allbuttons.removeClass('liked');
					} else {
						var unlike_text = barley.unlike;
						allbuttons.prop('title', unlike_text);
						allbuttons.addClass('liked');
					}
					loader.empty();					
				}
			});
			
		}
		return false;
	});
})( jQuery );
jQuery(document).ready(function(jQuery) {
	var __cancel = jQuery('#cancel-comment-reply-link'),
		__cancel_text = __cancel.text(),
		__list = 'comments-area';//your comment wrapprer
	jQuery(document).on("submit", "#commentform", function() {
		jQuery.ajax({
			url: barley.ajaxurl,
			data: jQuery(this).serialize() + "&action=ajax_comment",
			type: jQuery(this).attr('method'),
			beforeSend: addComment.createButterbar("提交中...."),
			error: function(request) {
				var t = addComment;
				t.createButterbar(request.responseText);
			},
			success: function(data) {
				jQuery('textarea').each(function() {
					this.value = ''
				});
				var t = addComment,
					cancel = t.I('cancel-comment-reply-link'),
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId),
					post = t.I('comment_post_ID').value,
					parent = t.I('comment_parent').value;
				if (parent != '0') {
					jQuery('#respond').before('<ol class="children">' + data + '</ol>');
				} else if (!jQuery('.' + __list ).length) {
					if (barley.formpostion == 'bottom') {
						jQuery('#respond').before('<ol class="' + __list + '">' + data + '</ol>');
					} else {
						jQuery('#respond').after('<ol class="' + __list + '">' + data + '</ol>');
					}

				} else {
					if (barley.order == 'asc') {
						jQuery('.' + __list ).append(data); // your comments wrapper
					} else {
						jQuery('.' + __list ).prepend(data); // your comments wrapper
					}
				}
				t.createButterbar("提交成功");
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		});
		return false;
	});
	addComment = {
		moveForm: function(commId, parentId, respondId) {
			var t = this,
				div, comm = t.I(commId),
				respond = t.I(respondId),
				cancel = t.I('cancel-comment-reply-link'),
				parent = t.I('comment_parent'),
				post = t.I('comment_post_ID');
			__cancel.text(__cancel_text);
			t.respondId = respondId;
			if (!t.I('wp-temp-form-div')) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			}!comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
			jQuery("body").animate({
				scrollTop: jQuery('#respond').offset().top - 180
			}, 400);
			parent.value = parentId;
			cancel.style.display = '';
			cancel.onclick = function() {
				var t = addComment,
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId);
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp);
				}
				this.style.display = 'none';
				this.onclick = null;
				return false;
			};
			try {
				t.I('comment').focus();
			} catch (e) {}
			return false;
		},
		I: function(e) {
			return document.getElementById(e);
		},
		clearButterbar: function(e) {
			if (jQuery(".butterBar").length > 0) {
				jQuery(".butterBar").remove();
			}
		},
		createButterbar: function(message) {
			var t = this;
			t.clearButterbar();
			jQuery("body").append('<div class="butterBar butterBar--center"><p class="butterBar-message">' + message + '</p></div>');
			setTimeout("jQuery('.butterBar').remove()", 3000);
		}
	};
});
//////////////////////////
jQuery(document).ready(function($) {
    $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
    $(document).on('click', '#comments-navi a',
    function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            beforeSend: function() {
                $('#comments-navi').remove();
                $('.commentlist').remove();
                $('#loading-comments').slideDown()
            },
            dataType: "html",
            success: function(out) {
                result = $(out).find('.commentlist');
                nextlink = $(out).find('#comments-navi');
                $('#loading-comments').slideUp(550);
                $('#loading-comments').after(result.fadeIn(800));
                $('.commentlist').after(nextlink)
            }
        })
    })

});
// Login check
function barley_check_login(){
	if(barley.uid>0) return true;
	if($("div.overlay").length<=0) $("body").append('<div class="overlay"></div>');
	$("div.overlay").show(),$("body").addClass("fadeIn");
	$('#sign').removeClass("register").addClass("um_sign");
	$("div.overlay, form a.close").bind("click",function(){return $("body").removeClass("fadeIn"),$('#sign').removeAttr("class"),$("div.overlay").remove();});
	return false;
};
// Collect action
$('.collect-btn').click(function(){
	if(!barley_check_login())return;
	var _this = $(this);
	var pid = Number(_this.attr('pid'));
	var collect = Number(_this.children("span").text()); 
	if(_this.attr('uid')&&!_this.hasClass('collect-yes')){
		var uid = Number(_this.attr('uid'));
		$.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: barley.ajaxurl, data: 'action=collect&uid=' + uid + '&pid=' + pid + '&act=add', cache: false,success: function(response){if(response!=0)_this.children("span").text(collect+1);_this.removeClass("collect-no").addClass("collect-yes").attr("title","已收藏");_this.children('i').attr('html','<i class="material-icons">star</i>');}});		
		return false;
	}else if(_this.attr('uid')&&_this.hasClass('collect-yes')&&_this.hasClass('remove-collect')){
		var uid = Number(_this.attr('uid'));
		$.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: barley.ajaxurl, data: 'action=collect&uid=' + uid + '&pid=' + pid + '&act=remove', cache: false,success: function(response){if(response!=0)_this.children("span").text(collect-1);_this.removeClass("collect-yes").addClass("collect-no").attr("title","点击收藏");_this.children('i').attr('html','<i class="material-icons">star_border</i>');}});
		return false;
	}else{
		return;
	}   	
});
// Cookie
// function set cookie
function umSetCookie(c_name,value,expire,path){
	var exdate=new Date();
	exdate.setTime(exdate.getTime()+expire*1000);
	document.cookie=c_name+ "=" +escape(value)+((expire==null) ? "" : ";expires="+exdate.toGMTString())+((path==null) ? "" : ";path="+path);
};
// function set wp nonce cookie
function set_um_nonce(){
	$.ajax({
		type: 'POST', url: barley.ajaxurl, data: { 'action' : 'um_create_nonce' },
		success: function(response) {
			umSetCookie('um_check_nonce',$.trim(response),3600,barley.home);
		},
		error: function(){
			set_um_nonce();
		}
	});
};
// function get cookie
function umGetCookie(c_name){
	if (document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1){ 
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return ""
};
// var get wp nonce cookie
var wpnonce = umGetCookie('um_check_nonce');
if (wpnonce==null || wpnonce=="") set_um_nonce();
// Get aff name in url
function umGetQueryString(name){
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
};
function is_name(str) {    
    return /^[\w]{3,16}$/.test(str) 
}
function is_url(str) {
    return /^((http|https)\:\/\/)([a-z0-9-]{1,}.)?[a-z0-9-]{2,}.([a-z0-9-]{1,}.)?[a-z0-9]{2,}$/.test(str)
}
function is_qq(str) {
    return /^[1-9]\d{4,13}$/.test(str)
}
function is_mail(str) {
    return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)
}
$(function(){
	var bd = $("body");
	if(!bd.hasClass("logged-in")){
		var _loginTipstimer
		function logtips(str){
			if( !str ) return false
			_loginTipstimer && clearTimeout(_loginTipstimer)
			$('.sign-tips').html(str).animate({
				height: 29
			}, 220)
			_loginTipstimer = setTimeout(function(){
				$('.sign-tips').animate({
					height: 0
				}, 220)
			}, 5000)
		}
		
		function is_check_name(str) {    
			return /^[\w]{3,16}$/.test(str) 
		}
		function is_check_mail(str) {
			return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)
		}
			
		var b = $("#sign");
		$("#register-active").on("click",
		function() {
			b.removeClass("sign").addClass("register")
		}),
		$("#login-active").on("click",
		function() {
			b.removeClass("register").addClass("sign")
		}),
		$(".user-login,.user-reg").on("click",
		function(c) {
			$("div.overlay").length <= 0 ? $("#header").before('<div class="overlay"></div>') : $("div.overlay").show(),
			$("body").addClass("fadeIn"),
			1 == $(this).attr("data-sign") ? b.removeClass("sign").addClass("register") : b.removeClass("register").addClass("sign"),
			$("div.overlay, form a.close").on("click",
			function() {
				return $("body").removeClass("fadeIn"),
				$.removeAttr("class"),
				$("div.overlay").remove(),
				!1
			}),
			c.preventDefault()
		})
		$('.captchaBtn').bind('click',function(){
			if( !is_check_mail($("#user_email").val()) ){
				logtips('邮箱格式错误')
				return
			}
			
			var captcha = $(this);
			if(captcha.hasClass("disabled")){
				logtips('您操作太快了，等等吧')
			}else{
				captcha.addClass("disabled");
				captcha.html("发送中...");
				$.post(
					barley.templateurl+'/includes/ajax/captcha.php?'+Math.random(),
					{
						action: "lb_captcha",
						email:$("#user_email").val()
					},
					function (data) {
						if($.trim(data) == "1"){
							logtips('已发送验证码至邮箱，可能会出现在垃圾箱里哦~')
							var countdown=60; 
							settime()
							function settime() { 
								if (countdown == 0) { 
									captcha.removeClass("disabled");   
									captcha.html("发送验证码");
									countdown = 60; 
									return;
								} else { 
									captcha.addClass("disabled");
									captcha.html("重新发送(" + countdown + ")"); 
									countdown--; 
								} 
								setTimeout(function() { settime() },1000) 
							}
	
						}else if($.trim(data) == "2"){
							logtips('邮箱已存在')
							captcha.html("发送验证码");
							captcha.removeClass("disabled"); 
						}else{
							logtips('验证码发送失败，请稍后重试')
							captcha.html("发送验证码");
							captcha.removeClass("disabled"); 
						}
					}
				);
			}
		});
		$('.login-loader').on('click', function(){
			logtips("登录中，请稍等...");									
			$.post(
				barley.templateurl+'/includes/ajax/login.php',
				{
					usr: $("#username").val(),
					pwd: $("#password").val(),
					rememberme: $('#rememberme').val(),
					action: "lb_login"
					
				},
				function (data) {
					if (data != "1") {
						logtips("用户名或密码错误");
					}
					else {
						logtips("登录成功，跳转中...");
						document.location.href = barley.wp_url;                     
					}
				}
			);
		})
		$('.register-loader').on('click', function(){
			if( !is_check_name($("#user_name").val()) ){
				logtips('用户名只能由字母数字或下划线组成的3-16位字符')
				return
			}
			
			if( !is_check_mail($("#user_email").val()) ){
				logtips('邮箱格式错误')
				return
			}
	
			if( $("#user_pass").val().length < 6 ){
				logtips('密码太短，至少6位')
				return
			}
			
			if( $("#user_pass").val() != $("#user_pass2").val()){
				logtips('两次输入密码不一致')
				return
			}
			
			logtips("注册中，请稍等...");
			$.post(
				barley.templateurl+'/includes/ajax/login.php',
				{
					user_register: $("#user_name").val(),
					user_email: $("#user_email").val(),
					password: $("#user_pass").val(),
					captcha: $("#captcha").val(),
					//redirect_to: $("#redirect_to").val(),
					action: "lb_register"
				},
				function (data) {
					if (data == "1") {
						logtips("注册成功，登录中...");
						document.location.href = barley.wp_url;
					}
					else {
						logtips(data);
					}
				}
			);										   
		})
	}
	
});