
<?php
/*	echo '<pre>';
	print_r ($quiz_list);
//	print_r ($question_stat);
	echo '</pre>'; // */ 
?>




<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load('visualization', '1', {packages: ['corechart']});
</script>





<table style='text-align:left'>
	
	<tr>
		<th colspan="5"><u>Quiz Detail</u></th>
	</tr>
	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="5">

			<table>
				<tr><th>Facebook App settings</th></tr>
				<tr>
					<th>Secure Page Tab URL</th>
					<td ><?='https://'.remove_http(site_url("quiz/index/{$quiz_list['quiz_id']}"))?></td>
				</tr>	
				<tr>
					<th>Page Tab URL</th>
					<td ><?='http://'.remove_http(site_url("quiz/index/{$quiz_list['quiz_id']}"))?></td>
				</tr>	
			</table>
			
		</td>
		
	</tr>

	<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>

	<tr>
		<th colspan="5">Quiz Name</th>
	</tr>

	<form method="post">
	<tr>
		<td colspan="4">
			<input type="hidden" name="action_type" value="update_quiz" />
			<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />
			<textarea name="quiz_name" cols="90" rows="1" ><?php echo $quiz_list['quiz_name'];?></textarea></td>
		<td>
			<input type="submit" name="update/delete" value="update"/>
			<input type="submit" name="update/delete" value="delete"/>
		</td>	
	</tr>
	</form>

	<tr><td colspan="5"><hr></td></tr>

<?php
	foreach($quiz_list['questions'] as $question_key => $question)
	{	?>

	<tr>
		<th colspan="5"><a name="q<?=$question['question_id']?>">Question (id: <?=$question['question_id']?>)</a></th>
	</tr>
	
	<form method="post" enctype="multipart/form-data">
		
	<tr>
		<td colspan="3">
			<input type="hidden" name="action_type" value="update_question" />
			<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />
			<input type="hidden" name="question_id" value="<?=$question['question_id']?>" />
			<textarea name="q_content" cols="75" rows="3" ><?=$question['question_content'];?></textarea>
			
			<?
/*				echo '<pre>';
				print_r ($_FILES);
				echo '</pre>'; // */
			?>
			
		</td>

		<td>
		<?	if($question['image_url'])
			{	?>
				<img src = "<?=base_url("upload/{$question['image_url']}")?>" width="100" />
		<?	}else	
			{	?>
				<img src = "<?=base_url("upload/upload.png")?>" width="100" />
		<?	}	?>			
			<input type="file" name="userfile" size="20" />
		</td>

		<td>
			<input type="submit" name="update/delete" value="update"/>
			<input type="submit" name="update/delete" value="delete"/>
		</td>
	</tr>
	</form>

<?	if($question_stat[$question_key]['question_count']!=0)
	{	?>
	<tr>
		<td colspan="5">

		<script type="text/javascript">
			function drawVisualization() // Create and populate the data table.
			{
				var data = google.visualization.arrayToDataTable
				([
					['Answer', 'Times choosen'],
					<?php
					foreach($question_stat[$question_key]['answer_stat'] as $answer)
						echo "['{$answer['answer_content']}', {$answer['answer_count']}],";
					?>
				]);
		  
		        // Create and draw the visualization.
				new google.visualization.PieChart(document.getElementById('chart<?=$question_key?>')).
				draw(data,{
					title:"Answer Distribution (Total Participants: <?=$question_stat[$question_key]['question_count']?>)",
					titleTextStyle: {fontSize:12},
					chartArea: {width:"100%"},
					is3D:true,
					legend: {position: 'right', textStyle: {fontSize: 12}},
					width: 400,
				});
			}
		
			google.setOnLoadCallback(drawVisualization);
		</script>
			
		<div id="chart<?=$question_key?>" style="width: 300px; height: 200px;"></div>
		</td>
	</tr>
<?	}	?>


	<tr>
		<th>Answer</th>
		<td>&nbsp;</td>
		<th>Next question / Result</th>
		<th>Image</th>
		<td></td>
	</tr>
	
		<?php foreach($question['answers'] as $answer)
		{	?>

		<form method="post" enctype="multipart/form-data">
		<tr>
	       	<td valign="top">
	       		<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />
	       		<input type="hidden" name="answer_id" value="<?=$answer['answer_id'];?>" />
	       		<input name="a_content" value="<?=$answer['answer_content'];?>" />
	       	</td>
			<td>
		<?	if($answer['image_url'])
			{	?>
				<img src = "<?=base_url("upload/{$answer['image_url']}")?>" width="100" />
		<?	}else
			{	?>
				<img src = "<?=base_url("upload/upload.png")?>" width="100" />
		<?	}	?>				
				<input type="file" name="userfile1" size="20" />
			</td>
		
		<?	if($answer['next_question_id'])
			{	?>
			<td>
				<input type="hidden" name="action_type" value="update_answer_next_question" />
						
				<a href="<?=site_url("admin/quiz_details/{$quiz_list['quiz_id']}")?>#q<?=$answer['next_question_id']?>">
					<?=$quiz_list['questions'][$answer['next_question_id']]['question_content']?>
				</a><br>
						
						<select name="next_question_link">

					<?	foreach($quiz_list['questions'] as $question_id => $question)
						{	?>
						  <!--<option value="all">All</option>-->
						<option value="<?=$question['question_id']?>"><?=$question['question_content']?></option>
					<?	}	?>

						</select>

			</td>
			<?	if($quiz_list['questions'][$answer['next_question_id']]['image_url'])
				{	?>
				<td>
					<img src = "<?=base_url("upload/{$quiz_list['questions'][$answer['next_question_id']]['image_url']}")?>" width="100" />
				</td>
			<?	}else
				{	?>
				<td width="100">
					The image of next question is not yet uploaded. <br><br>
				</td>
			<?	}	?>

		<?	}else
			{	?>
	        <td>
	        	<input type="hidden" name="result_id" value="<?=$answer['result_id'];?>" />
	        	<textarea name="r_content" cols="40" rows="5" ><?=$answer['result_content'];?></textarea>
	        	<input type="hidden" name="action_type" value="update_answer_result" />
	        </td>
			<td>
			<?	if($answer['result_image_url'])
				{	?>
					<img src = "<?=base_url("upload/{$answer['result_image_url']}")?>" width="100" />
			<?	}else
				{	?>
					<img src = "<?=base_url("upload/upload.png")?>" width="100" />
			<?	}	?>
			
				<input type="file" name="userfile2" size="20" />
			</td>
		
		<?	}	?>

			<td>
				<input type="submit" name="update/delete" value="update"/>
				<input type="submit" name="update/delete" value="delete"/>
			</td>
		</tr>
		</form>

	<?	}	?>

		<tr><td colspan="5"><hr></td></tr>
		<tr><td colspan="5"><b>Add New Answer & Result</b></td></tr>

		<form method="post" enctype="multipart/form-data">
		<tr>
	       	<td valign="top">	       		
	       		<input name="a_content" value="" />
	       	</td>
			<td>
				<img src = "<?=base_url("upload/upload.png")?>" width="100" />
				<input type="file" name="userfile1" size="20" />
			</td>
	        <td>
				<textarea name="r_content" cols="40" rows="5" ></textarea>
	        </td>
			<td>
				<img src = "<?=base_url("upload/upload.png")?>" width="100" />
				<input type="file" name="userfile2" size="20" />
			</td>
			<td>
				<input type="hidden" name="update/delete" value="update" />
				<input type="hidden" name="action_type" value="add_new_answer" />
				<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />
				<input type="hidden" name="question_id" value="<?=$question['question_id']?>" />
				<input type="submit" value="add a new answer"/>
			</td>
		</tr>
		</form>

	<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>

<?	}	?>

</table>

<?	if($this->uri->segment(4, 1) == 'create_quiz')
	{	?>
<a href="<?=site_url("admin/create_quiz_step2/{$quiz_list['quiz_id']}")?>">Next >> </a>
<!--		<img src="<?=base_url("upload/facebookapp_setting.png")?>" />	-->
		
<?	}	?>


