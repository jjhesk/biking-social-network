<style>
	.block_full_width
	{
		width:970px; 
	}
	
	.block_spacing
	{
		margin-top:10px;
		margin-right:10px;
		display: inline-block;
		float:left; position:relative;
	}
</style>

<? if ($activity_id == 0) {?>
	<div style="margin-top:70px; text-align: center; 16px">Opps. There is no content to be loaded. <br>No activity is found in the record.</div>
<? } else if ($activity_id == -1) {?>
	<div style="margin-top:70px; text-align: center; 16px">You do not have the permission to view this record.</div>	
<?} else { ?>

		
		<? 
			foreach($block_views['full_width'] as $block_name=>$block_view) {
				echo ($block_name!="")?"<div id='$block_name' class='block_full_width block_spacing' >":"";								
				echo $block_view;
				echo ($block_name!="")?"</div>":"";		
			}
		?>

						
		<div id="bottom_content" class='block_full_width'">
			<!--<div id="left_column" style="float:left; position:relative; width:480px; ">-->
			<div id="left_column" style="float:left; position:relative; width:480px; margin-right:10px;">	<? 
					foreach($block_views['left'] as $block_name=>$block_view) {
						echo ($block_name!="")?"<div id='$block_name' class='block_spacing' >":"";								
						echo $block_view;
						echo ($block_name!="")?"</div>":"";		
					}
				?>
			</div>
			
			<div id="right_column" style="float:left; position:relative; width:480px; ">
				<? foreach($block_views['right'] as $block_name=>$block_view) {
											
					echo ($block_name!="")?"<div id='$block_name' class='block_spacing' >":"";
					echo $block_view;
					echo ($block_name!="")?"</div>":"";	
				}?>
			</div>
		</div>
	
	
<?}?>
