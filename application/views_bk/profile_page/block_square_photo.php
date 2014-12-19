<div style="float:left; width:480px; height:480px; background-color:#DDDDDD; color:#808080; border:1px #ABABAB solid; 
text-align: none; vertical-align: middle; ">
		<style>
		
			.photo_square{
				/*background-size:100% 100%;*/
				position:relative; background-color:#FFFFFF; display:block; padding: 
				overflow:hidden;				
			}
			.apply_setting_1{
				background-size:auto 100%;
				width:100%;
			}
			.apply_setting_2{
				
				background-size:100% auto;
				height:100%;
			}
		</style>

	<div id="photo_square" class="photo_square"  style="position: relative; left: 0px; top: 0px; width:480px; height:480px; overflow:hidden; background-color:#DDDDDD; color:#808080; border:1px #ABABAB solid; text-align:none;  ">
		
	</div>
</div>
<script>
	//alert("block square_photo 30 ");
	$("#photo_square").DivCrapImage("<?=$image?>", 480, 480, false);
	/*var $=jQuery;
	var the_given_img="<?=$image?>";
	/*$(".photo_square").append("<div id='temp_dump_pic' class='hide'><img src='"+the_given_img+"' /></div>");
	//assume this is done in loading
	setTimeout(function(){
		var h=$("#temp_dump_pic img").height();
		var w= $("#temp_dump_pic img").width();
		console.log(h+"---"+w);
			$("#temp_dump_pic").remove();
		if(h>w){
			//$(".photo_square").css("background-size","auto 100%");
			$(".photo_square").addClass("apply_setting_1");
		}else{
			//$(".photo_square").css("background-size","100% auto");
			$(".photo_square").addClass("apply_setting_2");
			
		}
		$(".photo_square").css("background-image","url("+the_given_img+")");
	},1000);*/
</script>