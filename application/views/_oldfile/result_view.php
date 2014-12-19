<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	

	
<center>



	<img src="<?=base_url("upload/{$result['result_image_url']}")?>" width="300" /><br><br><br>
	<?=$result['result_content']?><br><br>



<!-- code user to post the quiz result manually  -->
	<a target="_blank" href="http://www.facebook.com/dialog/feed?app_id=<?=$fb_param['appId']?>
	&link=<?=$fb_param['url']?>
	&picture=<?=base_url("upload/{$result['result_image_url']}")?>
	&name=<?=urlencode($quiz_info['quiz_name'])?>
	&caption=<?=urlencode('我既選擇:')?>
	&description=<?=urlencode("{$result['result_content']}")?>
	&redirect_uri=<?=site_url('quiz/fanpage')?>" >
	<br>同你既親戚朋友分享你既選擇!!</a><br><br><br>
<!-- end of code for user to post the quiz result manually -->
	
	
	<a target="_blank" href="http://www.facebook.com/letsbuy.hk/app_302081023199877" >
	<img width="480" src="http://apps.fmarketing.hk/letsbuyhkpc/media_images/464589c5a1eeb624b733af571773ec503602.jpg">
	</a>



</center>
	


