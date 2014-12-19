<script>
	$(document).ready(function(){
		$("#photo").change(function(){
			if( $("#photo").val()!="" ){
				$("#choose_oauth_provider").show();
				$.colorbox.resize({width:400, height:600});
			}
		});
		$("#choose_oauth_google").click(function(){
			$("#oauth_provider").val("google");
			$("#choosed_oauth_google").show();
			$("#choosed_oauth_facebook").hide();
			
		});
		$("#choose_oauth_facebook").click(function(){
			$("#oauth_provider").val("facebook");
			$("#choosed_oauth_google").hide();
			$("#choosed_oauth_facebook").show();
		});
		$("#post_avtivity_submit").click(function(event){
			if( ($("#photo").val()!="")&&($("#oauth_provider").val()=='') ){
				alert("need to choose oauth provider");
				event.preventDefault();
			}else{
				return true;
			}
		});
		
	});
		
</script>
<form action="<?=$post_activity_link?>" method="post" enctype= multipart/form-data>
	<div style="position: relative;">What you want to share:</div>
	<br/>
	<div style="position: relative;">
		<textarea id="comment" name="comment" style="width: 300px; height: 100px;"></textarea>
	</div>

	<div style="position: relative;">
		<input type="file" id="photo" name="photo" style="float:left;" class="add_activity_photo" />
		<input type="submit" id="post_avtivity_submit" style="float:left;" value="submit" />
		<input type="hidden" id="oauth_provider" name="oauth_provider" value="" />
		<div style="clear:both;"></div>
	</div>
	<div id="choose_oauth_provider" style="position: relative; display:none;">
		select your Oauth Provider Server to upload photo:
		<br />
		<div id="choosed_oauth_google" style="display:none; float:left;">ticked: </div>
		<div id="choose_oauth_google" style="cursor:pointer; float:left;"
			<?php if (isset($choose_oauth_google_link)){ ?>
				href="<?=$choose_oauth_google_link?>"
			<?php } ?>
		>Google Picasa</div>
		<div style="clear:both;"></div>
		<div id="choosed_oauth_facebook" style="display:none; float:left;">ticked: </div>
		<a id="choose_oauth_facebook" style="cursor:pointer; float:left;" 
			<?php if (isset($choose_oauth_facebook_link)){ ?>
				href="<?=$choose_oauth_facebook_link?>"
			<?php } ?>
		 >Facebook</div>
	</div>	
</form>
