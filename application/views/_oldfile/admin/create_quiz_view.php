
<?php

/*	echo '<pre>';
	print_r ($quiz_list);
//	print_r ($question_stat);
	echo '</pre>'; // */ 
?>






<table style='text-align:left'>
	
	<tr>
		<th colspan="5"><u>Create new quiz</u></th>
	</tr>
	
<!--<tr>
		<td colspan="5">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="5">
			<table>
				<tr><th>Facebook App settings</th></tr>
				<tr>
					<th>Secure Page Tab URL</th>
					<td ><?//='https://'.remove_http(site_url("quiz/index/{$quiz_list['quiz_id']}"))?></td>
				</tr>	
				<tr>
					<th>Page Tab URL</th>
					<td ><?//='http://'.remove_http(site_url("quiz/index/{$quiz_list['quiz_id']}"))?></td>
				</tr>	
			</table>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>	-->
	<tr><td>&nbsp;</td></tr>

	<tr>
		<th colspan="5">Quiz Name</th>
	</tr>

	<form method="post" enctype="multipart/form-data">
	<tr>
		<td colspan="4">
			<input type="hidden" name="action_type" value="create_quiz" />
<!--			<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />	-->
			<textarea name="quiz_name" cols="90" rows="1" ></textarea>
		</td>
	</tr>
	
	<tr><td colspan="5"></td></tr>
	
	<tr>
		<th colspan="5">Question</th>
	</tr>
	
	<tr>
		<td colspan="3">
<!--			<input type="hidden" name="action_type" value="create_question" />	-->
<!--			<input type="hidden" name="quiz_id" value="<?=$quiz_list['quiz_id']?>" />
			<input type="hidden" name="question_id" value="<?=$question['question_id']?>" />	-->
			<textarea name="q_content" cols="75" rows="4" ><?//=$question['question_content'];?></textarea>
		</td>

		<td width="100" >
			<img src = "<?=base_url("upload/upload.png")?>" width="100" />
			<input type="file" name="userfile" size="20" />
		</td>
	</tr>

	<tr>
		<td colspan="5">
			<input type="submit" value="create quiz"/>
		</td>
	</tr>
			
	</form>

</table>






