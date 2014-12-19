
<!--<img src="<?=base_url()?>/application/views/webview_apps/petnfans/image/leader_board_screenshot.jpg" width="20%">-->

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
	color:#000000;

}
	.row{
	width:100%;
	height:100px;
		
	}
	.img_123{
		width: 100%;
		height:100%;
		text-align:left;
		float:left;
	}
	.under_line{
	background-image: url('<?=base_url()?>/application/views/webview_apps/petnfans/image/under_line.png');	
	background-repeat:repeat;
		width: 100%;
		height: 3px;
	}
	.clear{
		clear:both;
	}
	.leader_text{
		margin-top:5%;
		color:#FFFFFF;
		height:60px;
		overflow: hidden;
		padding-left:15px;
		width:170px;
		
	}
	.leader_name{
		color:#F3924C;
		font-family:"Blackadder ITC";

		float:left;
		width:185px;
	}
	.leader_walked{
		color:#FFFFFF;
		padding-right:2%;
		float:right;
	}
	.image_leader{
		width:100px; 
		float:left;
	}
</style>
<script>
function slidedowner(i1){
	$("#full_content").html($("#row_"+i1).html());
	$("#full_content").slideDown();
	$("#full_content .news_footer").hide();
	$("#full_content .leader_text").hide();
	$("#full_content .leader_name").hide();
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
	
	
	
	<?php 

	
	/*echo '<pre>';
	print_r($db_get_leaderboard);
	echo $db_get_leaderboard[0]['image'];
	echo '</pre>';*/

	
	for( $i=0; ( ($i<=5)&&($i<count($db_get_leaderboard) ) ); $i++){
		?><div class="row" id="row_<?=$i?>" onclick="slidedowner(<?=$i?>)" >
				<div class="img_123">
					<!--<?=$db_get_leaderboard;?>-->
					<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/no<?=$i;?>.png' style="height: 70px; padding-left:-3%;margin-left:-4px; margin-top:3%; float:left;" />
					
					<img src='<? if(isset($db_get_leaderboard[$i]['image'])){
						echo $db_get_leaderboard[$i]['image'];
					}else{
						echo "null";
					}?>' 	
					
					style="height: 60px;width:60px; margin-top:5%; border: 5px solid #F3924C; float:left;" />
				
					<div id="text-leader">
						<div class="leader_text">
						<? if(isset($db_get_leaderboard[$i]['description'])){
							//$string = substr($db_get_leaderboard[$i]['description'], 0, 66) . '...';
							echo $db_get_leaderboard[$i]['description']; 
							
							
						}else{
							echo "null";
						}?>
						</div>
					
						
						<div class="news_full_content" style="display:none; color: #F3924C; margin-top:15px; width:175px; float:right;">
							<? if (isset($db_get_leaderboard[$i]['description'])){
								echo $db_get_leaderboard[$i]['description'];
							}else{
								echo "null";
							}?>
							<div style="margin-top:3px;" >
								<input type="button" value="Back" onclick="goBack()" />
							</div>
						</div>
						
						
						
						
						
						
						
						
						
						<div class="leader_name">
							<span style="padding-left:15px;">
							<?=$db_get_leaderboard[$i]['name']?> 
							</span>
							<div class="leader_walked">
							<?=$db_get_leaderboard[$i]['vote_count'];?> votes
							</div>
						</div>
						
						
					</div>
						<? /*if(isset($petnfans_string[$i]['news_text'])){
							$string = substr($petnfans_string[$i]['news_text'], 0, 40) . '...';
							echo $string;
						}else{
							echo "null";
						}*/?>
			
			
			
			
			
			
				<?php /*if($i==0){ ?>
					
						<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/no1.png' style="height: auto;  float:left;" />
						<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/img.png' style="height: 100px; margin:3%; border: 5px solid #F3924C; float:left;" />
						<div style="">
							<div>
							Scotch Collie, 4 years old
							</div>
							<div>JohnnyBB
							</div>
							<div> Walked for 15.6 km
							</div>
						</div>
						<div class="clear"></div>
				
					
				<?
				}
				 
				 
				 
				 
				 
				 elseif($i==1){
					?><img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/no2.png' style=" float:left;">
						<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/img.png' style="height: 100px; margin:3%; border: 5px solid #F3924C; float:left;" />
				<?
				}elseif($i==2){
					?><img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/no3.png' style=" height: ;float:left;">
						<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/img.png' style="height: 100px; margin:3%; border: 5px solid #F3924C; float:left;" />	
				<?
				}else{
					?><img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/no_normal.png' style="height:;float:left;">
					<img src='<?=base_url()?>/application/views/webview_apps/petnfans/image/img.png' style="height: 100px; margin:3%; border: 5px solid #F3924C; float:left;" />
				
				
				<?
				}*/ 
				?>
			</div>
			<?//echo $arr[$i];?>
			
		 </div>
		 		<div class="under_line">&nbsp;</div>
		 
 <?
	}
	?>
		</div><!--news_main_content-->
		
</div>