<script>
var event_map_rightside={
	mouseenter:function(event){
	if(!area.hasClass("explainhover")){area.addClass("explainhover");}
	//alert("297");
	event.stopImmediatePropagation();
	
	},
	mouseleave: function(event){
		event.stopImmediatePropagation();
		disappear();
	}
};
var event_map_leftside={
	mouseenter:function(event){
		//alert("305");
		event.stopImmediatePropagation();
		show_explain();
	},
	click: function(event){
		event.stopImmediatePropagation();
		show_explain();
	}
};
var show_explain=function(event){
	area = $(".explain");
	if(!area.hasClass("explainhover")){area.addClass("explainhover");}
	event.stopImmediatePropagation();
};
var disappear = function(){
	area = $(".explain");
		area.delay(5000).fadeOut(500,function(){
   			//alert("318");
   			if(area.hasClass("explainhover")){area.removeClass("explainhover");}
  	});
};
$(document).ready(function(){
	area = $(".explain");
	$(".mainsec .middle .right").on(event_map_rightside);
	$(".mainsec .middle .left").on(event_map_leftside);
});
</script>
<div id="main"  >
	<div class="mainsec">
		<div class="cover"></div>
		<div class="middle">
			<? if($merge=="no"){ ?>
			<div class="left">
				<div class="im"></div>
				<span>Sign up with any <br/>of these services</span>
			</div>
			<div class="right">
				<div class="im"></div>
				<span>What is OpenID?<br/>How to get it?</span>
				<div class="explain">
					<div class="side"></div>
					<div class="side_right">
						<div class="openid_logo"></div>
						<div class="green_txt">
							<font style="color: #00A5E7;">OpenID</font> allows you to use an existing account to log on to multiple websites, without needing to create new passwords.
						</div>
						<div class="discription_txt">
							You may choose to associate information with your OpenID that can be shared with the websites you visit, such as a name or email address. With OpenID, you control how much of that infomation is shared with the websites you visit.
						</div>
						<a href="http://openid.net/get-an-openid/"  target="_blank">
							<div class="get_open_id"></div>
						</a>
					</div>
				</div>
			</div>
			<? }else{ ?>
				<div class="left" style="width: 440px;">
					<div class="im"></div>
					<span>Log on with any of these services <br/> to merge the account.</span>
				</div>
			<? } ?>
			<div class="bar">
				<div class="b"></div>
				<table border=0 cellpadding=0 cellspacing=0 width="400px" style="position: relative; left: 20px;">
				<tr>
					<td align=center width=33%>
						<!--<form id="login_form_google" action="<?=site_url()?>login/login_google" method="post">
							<div class="g" onclick="$('#login_form_google').submit();"></div>
						</form>-->
					</td>
					<td align=center width=33%>
						<?
							/*$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       							. $login['fb_app_id'] . "&redirect_uri=" . urlencode($login['fb_app_return_link']) . "&state="
      							 . $_SESSION['state'] . "&scope=".$login['fb_app_perms'];*/
						?>
						<a class="f" href="<?=$facebook_login_link?>">
							<div class="f"></div>
						</a>
						<? /*
						<a class="f" href="https://www.facebook.com/login.php?api_key=<?=$login['fb_app_id']?>&cancel_url=<?=$login['cancel_url']?>&display=page&fbconnect=1&next=<?=$login['fb_app_return_link']?>&return_session=1&session_version=3&v=1.0&req_perms=<?=$login['fb_app_perms']?>" >
							<div class="f"></div>
						</a>
						 * */ ?>
						 
					</td>
					<td align=center width=33%>
						<!--<form id="login_form_yahoo" action="<?=site_url()?>/login/login_yahoo" method="post">
							<div class="y" onclick="$('#login_form_yahoo').submit();"></div>
						</form>-->
					</td>
				</tr>	
					
				</table>
				
				
				
				
			</div>
		</div>
	</div>
</div>
<canvas id="bgcanvas"></canvas>
