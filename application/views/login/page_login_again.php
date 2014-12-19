<script src="<?=base_url()?>/js/jquery/jquery.js"></script>
<script>
				var dialog_function_confirm="";
				function confirm(msg, title){
					alert(msg, title);
					$("#dialog-modal_ok").hide();
					$("#dialog-modal_loading_icon").hide();
					$("#dialog-modal_confirm").show();
				}
				function dialog_confirm(){
					document.location.href='<?=$next?>';
				}
				$(document).ready(function(){
						//alert("", "");
				});
</script>
<div style="height: 100%; width: 100%;">
	<div id="dialog-modal"  title="" style=" position: relative; left: 10%; top: 30%; padding:auto; background-color: black; padding: 10px;width:80%;">
		<div style="background-color: white; text-align:center;">
			<div id='dialog-modal_msg' style='text-align:left; padding: 2% 2% 0% 2%;  font-size:200%; text-align:center;'>
					    		Fansliving require permission to post contents to the oauth server (facebook, google... etc),<br/>
					    		Your oauth server access token must be deprecated, or does not have enough permission to <br/>
					    		submit activity. Please login again and agree all permission setting.
			</div>
			<input type="button" id="dialog-modal_ok" value="Confirm" style="margin-bottom: 2%; font-size: 200%; " onclick="dialog_confirm()" />
		</div>
	</div>
</div>