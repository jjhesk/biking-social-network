<? if (0) {?>
	<div style="margin-top:70px; text-align: center;font-size: 16px">Opps. There is no content to be loaded. <br>You may not have the permission to view this content, or no activity is found in the record.</div>
<?} else { ?>

			
	<? if(isset($block_app_profile)){ ?>
		<div id="main content" class="index_block_summary" style="margin-top:10px;  margin-bottom: 60px;" >
			<?=$block_app_profile?>
		</div>
	<? } ?>

	<div id="bottom_content" style="float:left; position:relative; width:970px;">
		<div id="left_column" style="float:left; position:relative; width:480px;">
			<? 
				foreach($left['block_views'] as $block_name=>$block_view) {
					echo ($block_name!="")?"<div id='$block_name' style='width:100%' >":"";								
					echo $block_view;
					echo ($block_name!="")?"</div>":"";		
				}
			?>
		</div>
		<div id="right_column" style="float:left; position:relative; width:480px; margin-left: 10px;">
			<? foreach($right['block_views'] as $block_name=>$block_view) {						
				echo ($block_name!="")?"<div id='$block_name' style='width:100%' >":"";
				echo $block_view;
				echo ($block_name!="")?"</div>":"";	
			}?>
		</div>
	</div>
	
<? } ?>