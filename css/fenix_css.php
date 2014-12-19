<style type="text/css">
	
#login_page_area1{
	background-image: url(<?=base_url()?>/images/login/singin-bg.png);
	background-repeat: repeat-y;
	width: 600px;
	height: 785px;
}
#login_page_big_logo{
	background-image: url(<?=base_url()?>/images/login/signin-logo.png);
	background-repeat: no-repeat;
	position: relative;
	top: 100px;
	left: 40px;
	width: 510px;
	height: 415px;
}
#login_page_description{
	position: relative; left: 95px; top: 105px;
	width: 500px;
}
@font-face {  
  font-family: fontface1;  
  src: url(css/fontface1) format("truetype");  
}
#login_page_description1{
	font-family: fontface1;
	color: #409C0E;
	font-size: 16px;
}
#login_area_button{
	position: relative;
	left: 75px; top: 110px;
	width: 445px;
}
	.loginedbut{
		float:left; margin-right: 15px;
		background: url("<?=base_url()?>/images/common/icon-header-small.png") no-repeat scroll -54px 0 transparent;	
	}
	.username_div, .findstore_div{
		margin-top: 11px;	
		float:right;
	}
	.findstore_div{
		margin-right: 5px;	
	}
	.username_div .loginedbut{
		background-position: -54px 0px;  
	}
	.username_div:hover .loginedbut{
		background-position: -54px -27px;  
	}
	.findstore_div .loginedbut{
		background-position: -81px 0px; 
	}
	.findstore_div:hover .loginedbut{
		background-position: -81px -27px; 
	}
	.loginarea_logout_openid{
		float:right;	
	}
	.loginarea_logout_openid .loginedbut{
		background-position: 0px 0px;
	}
	.loginarea_logout_openid:hover .loginedbut{
		background-position: 0px -27px;
	}
	.loginbut{
		margin-right: 15px; 
	}
.mergelink{
	color: #888888;
	position: relative; top: 10px;
}
.loginarea_logout_openid{
	margin-top: 11px;
    width: 120px;	
    cursor:pointer;
    float:right;
    text-decoration:none;
}

.loginarea_logout_openid .loginedbut{
	background: url("<?=base_url()?>/images/common/icon-header-small.png") no-repeat scroll 0 0 transparent;	
	float:left; margin-right: 15px;
}
.settings_firstlogin_welcome{
	font-size: 55px; color: #00A5E7; float:left; padding:10px;
}
.settings_firstlogin_message{
	font-size: 18px; color: #409C0E;	float:left; 
}
.settings_date_description{
	color: #808080;
    float: left;
    font-size: 12px;
    padding-top: 8px;
	
}
.profile_photo_image {
	margin-top: 1px; border: 1px solid #000000; width: 478px;  line-height: 0px;	
}

.firstlogin_leftbar_message{
	float:left; width: 110px;	
}
.link_merge_account{
	color: #444444; cursor:pointer;
}
</style>


