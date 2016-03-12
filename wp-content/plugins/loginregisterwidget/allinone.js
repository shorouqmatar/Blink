//tabslet		
!function($,window,undefined){"use strict";$.fn.tabslet=function(options){var defaults={mouseevent:"click",attribute:"href",animation:!1,autorotate:!1,deeplinking:!1,pauseonhover:!0,delay:2e3,active:1,container:!1,controls:{prev:".prev",next:".next"}},options=$.extend(defaults,options);return this.each(function(){function deep_link(){var t=[];elements.find("a").each(function(){t.push($(this).attr(options.attribute))});var e=$.inArray(location.hash,t);return e>-1?e+1:$this.data("active")||options.active}var $this=$(this),_cache_li=[],_cache_div=[],_container=options.container?$(options.container):$this,_tabs=_container.find("> div");_tabs.each(function(){_cache_div.push($(this).css("display"))});var elements=$this.find("> ul li"),i=options.active-1;if(!$this.data("tabslet-init")){$this.data("tabslet-init",!0),options.mouseevent=$this.data("mouseevent")||options.mouseevent,options.attribute=$this.data("attribute")||options.attribute,options.animation=$this.data("animation")||options.animation,options.autorotate=$this.data("autorotate")||options.autorotate,options.deeplinking=$this.data("deeplinking")||options.deeplinking,options.pauseonhover=$this.data("pauseonhover")||options.pauseonhover,options.delay=$this.data("delay")||options.delay,options.active=options.deeplinking?deep_link():$this.data("active")||options.active,options.container=$this.data("container")||options.container,_tabs.hide(),options.active&&(_tabs.eq(options.active-1).show(),elements.eq(options.active-1).addClass("active"));var fn=eval(function(){$(this).trigger("_before"),elements.removeClass("active"),$(this).addClass("active"),_tabs.hide(),i=elements.index($(this));var t=$(this).find("a").attr(options.attribute);return options.deeplinking&&(location.hash=t),options.animation?_container.find(t).animate({opacity:"show"},"slow",function(){$(this).trigger("_after")}):(_container.find(t).show(),$(this).trigger("_after")),!1}),init=eval("elements."+options.mouseevent+"(fn)"),t,forward=function(){i=++i%elements.length,"hover"==options.mouseevent?elements.eq(i).trigger("mouseover"):elements.eq(i).click(),options.autorotate&&(clearTimeout(t),t=setTimeout(forward,options.delay),$this.mouseover(function(){options.pauseonhover&&clearTimeout(t)}))};options.autorotate&&(t=setTimeout(forward,options.delay),$this.hover(function(){options.pauseonhover&&clearTimeout(t)},function(){t=setTimeout(forward,options.delay)}),options.pauseonhover&&$this.on("mouseleave",function(){clearTimeout(t),t=setTimeout(forward,options.delay)}));var move=function(t){"forward"==t&&(i=++i%elements.length),"backward"==t&&(i=--i%elements.length),elements.eq(i).click()};$this.find(options.controls.next).click(function(){move("forward")}),$this.find(options.controls.prev).click(function(){move("backward")}),$this.on("destroy",function(){$(this).removeData().find("> ul li").each(function(t){$(this).removeClass("active")}),_tabs.each(function(t){$(this).removeAttr("style").css("display",_cache_div[t])})})}})},$(document).ready(function(){$('[data-toggle="tabslet"]').tabslet()})}(jQuery);
var CaptchaCallbackRegister = function(){
	setTimeout(function () {
		if(jQuery('#g-recaptcha-login').length){
			if(jQuery('#g-recaptcha-login').attr('data-theme') == 'dark'){
				var theme = 'dark';
			}else{
				var theme = 'light';
			}
		   widgetlogin 		=  grecaptcha.render('g-recaptcha-login', {'sitekey' : jQuery('#g-recaptcha-login').attr('data-sitekey'),'theme':theme});
	   }
	}, 1000);
	setTimeout(function () {
	   if(jQuery('#g-recaptcha-lost').length){
		   if(jQuery('#g-recaptcha-lost').attr('data-theme') == 'dark'){
				var theme = 'dark';
			}else{
				var theme = 'light';
			}
		   widgetlost 		=  grecaptcha.render('g-recaptcha-lost', {'sitekey' : jQuery('#g-recaptcha-lost').attr('data-sitekey'),'theme':theme});
	   }
	   if(jQuery('#g-recaptcha-register').length){
		   if(jQuery('#g-recaptcha-register').attr('data-theme') == 'dark'){
				var theme = 'dark';
			}else{
				var theme = 'light';
			}
        widgetregister 	=  grecaptcha.render('g-recaptcha-register', {'sitekey' : jQuery('#g-recaptcha-register').attr('data-sitekey'),'theme':theme});
		}
    }, 2500);
};
		jQuery(document).ready(function() {	
			jQuery('.register-widget-container').tabslet();
			
					var frm = jQuery('#custom-register-widget');
					frm.submit(function (ev) {
						jQuery('#ajaxicon-register-widget').css("display","block");
						jQuery.ajax({
							type: frm.attr('method'),
							url: frm.attr('action'),
							data: frm.serialize(),
							async: true,
							dataType: 'html',
							success: function (data) {
								var error = jQuery(data).find('#login_error').html();
								if(typeof error == "string"){
									if(jQuery('#success-register-widget').css('display') == 'block'){
										jQuery('#success-register-widget').css("display","none")
									}
									jQuery('#error-register-widget').css("display","block").html(error);
									if(jQuery('#g-recaptcha-register').length){
										grecaptcha.reset(widgetregister);
									}
								}else {
									if(jQuery('#error-register-widget').css('display') == 'block'){
										jQuery('#error-register-widget').css("display","none")
									}
									if(jQuery('#g-recaptcha-register').length){
										grecaptcha.reset(widgetregister);
									}
									jQuery('#success-register-widget').css('display','block');
								}
								jQuery('#ajaxicon-register-widget').css("display","none");
							}
						});
						ev.preventDefault();
					});
					var lgn = jQuery('#loginform');
					lgn.submit(function (ev) {
						jQuery('#ajaxicon-login-widget').css("display","block");
						jQuery.ajax({
							type: lgn.attr('method'),
							url: lgn.attr('action'),
							data: lgn.serialize(),
							async: true,
							dataType: 'html',
							success: function (data) {
								var error = jQuery(data).find('#login_error').html();
								if(typeof error == "string"){
									jQuery('#error-login-widget').css("display","block").html(error);
									if(jQuery('#error-login-widget a').length){
										jQuery('#error-login-widget a').attr('href','');
										jQuery( "#error-login-widget a" ).click(function( event ) {
										  event.preventDefault();
										  jQuery('.register-widget-lostpassw').trigger('click');
										});
										if(jQuery('#g-recaptcha-login').length){
											grecaptcha.reset(widgetlogin);
										}
									}
									
								}else {
									if(jQuery('#error-login-widget').css('display') == 'block'){
										jQuery('#error-login-widget').css("display","none")
									}
									location.reload();
								}
								jQuery('#ajaxicon-login-widget').css("display","none");
							}
						});
						ev.preventDefault();
					});
					var lstpass = jQuery('#lostpasswordform');
					lstpass.submit(function (ev) {
						jQuery('#ajaxicon-lost-widget').css("display","block");
						jQuery.ajax({
							type: lstpass.attr('method'),
							url: lstpass.attr('action'),
							data: lstpass.serialize(),
							async: true,
							dataType: 'html',
							success: function (data) {
								var error = jQuery(data).find('#login_error').html();
								if(typeof error == "string"){
									if(jQuery('#success-lost-widget').css('display') == 'block'){
										jQuery('#success-lost-widget').css("display","none")
									}
									if(jQuery('#g-recaptcha-lost').length){
										grecaptcha.reset(widgetlost);
									}
									jQuery('#error-lost-widget').css("display","block").html(error);
								}else {
									if(jQuery('#error-lost-widget').css('display') == 'block'){
										jQuery('#error-lost-widget').css("display","none")
									}
									jQuery('#success-lost-widget').css('display','block');
								}
								jQuery('#ajaxicon-lost-widget').css("display","none");
							},
							error: function(){
								if(jQuery('#success-lost-widget').css('display') == 'block'){
									jQuery('#success-lost-widget').css("display","none")
								}
								if(jQuery('#error-lost-widget').css('display') == 'block'){
										jQuery('#error-lost-widget').css("display","none")
								}
								
									jQuery('#error-lost-widget').css("display","block").text('Error');
									if(jQuery('#g-recaptcha-lost').length){
										grecaptcha.reset(widgetlost);
									}
								jQuery('#ajaxicon-lost-widget').css("display","none");
							}
						});
						ev.preventDefault();
					});
				});	