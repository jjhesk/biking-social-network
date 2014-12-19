<!--<img src="<?=base_url()?>/application/views/webview_apps/petnfans/image/news_screenshot.jpg" width="100%">-->
<style type="text/css">
html, body{
	/*margin:auto;*/
	width:98%;
	/*height:100%;*/
	
}
.body, #news_main_content{
	/*margin:auto;*/

    width:320px; /* This must be 100%*/
   	height:auto;
	background-image: url('<?=base_url()?>/application/views/webview_apps/petnfans/image/bg.png');
	background-repeat: repeat;
	color:#000000;

}
	.row{
	width:100%;
	height:100px;
	position: relative;
	/*100px*/
		
	}
	.img_123{
		width: 80px;
		height:100%;
		text-align:left;
		float:left;
	}
	.under_line{
	background-image: url('<?=base_url()?>/application/views/webview_apps/petnfans/image/under_line.png');	
	background-repeat:repeat;
		width: 100%;
		height: 3px;
		/*float: left;*/
		text-align:left;
	}
	.clear{
		clear:both;
	}
	.news_title{
		color:#F3924C;
		font-weight: bold;
		padding-top:-3px;
	}
	.news_update_time{
		color:#FFFFFF;
		font-size:50%;
	}
	.news_footer{
		color:#FFFFFF;
		/*padding-top: 6%;*/
		position: relative;
		width:80%;
		overflow:hidden;
		height:60px;
		
	}
</style>
<script>
function pageScroll() {
    	window.scrollBy(0,50); // horizontal and vertical scroll increments
    	scrolldelay = setTimeout('pageScroll()',100); // scrolls every 100 milliseconds
}

function slidedowner(i1){
	$("#full_content").html($("#row_"+i1).html());
	$("#full_content").slideDown();
	$("#full_content .news_footer").hide();
	$("#full_content .btn_full_content").hide();
	$("#full_content .news_full_content").show();
	setTimeout(after_slidedowner, 300);
}
function after_slidedowner(){
	$("#news_main_content").hide();
	//$("#full_content .news_footer").hide();
	//$("#full_content .btn_full_content").hide();
	//$("#full_content .news_full_content").show();
}
function goBack()
  {
	$("#full_content").hide();
	$("#news_main_content").show();

  }
</script>
<div class="body">
	<div id="full_content" class="body" style="z-index: 10; height: 320px; display:none; position: absolute; left: 0px; top: 0px;">
		
	</div>
	<div id="news_main_content">
		
	<?
	//echo '<pre>';
	//print_r($petnfans_string);
	//echo '</pre>';
	?>
	<?php 
	
	for( $i=0; $i<=5; $i++){
		?><div class="row" id="row_<?=$i?>" onclick="slidedowner(<?=$i?>)" >
			<div class="img_123">
				<div style="">
				<!--'<?=base_url()?>/application/views/webview_apps/petnfans/image/news_store_<?=$i;?>.png' -->
					<img src="<?if(isset($petnfans_string[$i]['image'])){
						echo $petnfans_string[$i]['image'];
					}else{
					}?>" style="height: 80px; margin:10px; float:left;width:100%;" />
				</div>
				<div style="position: absolute; left: 105px; top: 8px;">
					<div class="news_title">
						<?if (isset($petnfans_string[$i]['name'])){
							echo $petnfans_string[$i]['name'];
						}else{
							echo "null";
						}
						
						?>
					</div>
					<div class="news_update_time">
						<? if (isset($petnfans_string[$i]['last_updated'])) {
							echo $petnfans_string[$i]['last_updated'];
							}else{
							echo "null"	;
							}?>
					</div>
					<div class="news_footer">
						<?/* if(isset($petnfans_string[$i]['news_text'])){
							$string = substr($petnfans_string[$i]['news_text'], 0, 40) . '...';
							echo $string;
						}else{
							echo "null";
						}*/?>
						<? if(isset($petnfans_string[$i]['news_text'])){
							//$string = substr($petnfans_string[$i]['news_text'], 0, 40) . '...';
							echo $petnfans_string[$i]['news_text'];
						}else{
							echo "null";
						}?>
						
						
						
						
					</div>
					<div class="news_full_content" style="display:none; color: #F3924C;">
						<?=$petnfans_string[$i]['news_text']?>
						<div style="margin-top:3px;">
							<input type="button" value="Back" onclick="goBack()">
						</div>
					</div>
				</div>
				<div class="btn_full_content" style="position: absolute; left: 270px; top: 25px;">
					<a href='#' style="float:right;">
						<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/news_arrow.png' style="height: 50px; float:right;" />
					</a>
				</div>
				<div class="clear"></div>
			</div>
			
		 </div>
		 <div class="under_line">&nbsp;</div>
		 
 <?
		 
	}
	?>
	</div><!--news_main_content-->

		
</div>