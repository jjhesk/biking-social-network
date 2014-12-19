
<?
/*	echo '<pre>';
	print_r ($quiz_info);
	print_r ($question);
	echo '</pre>'; // */

?>


	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	


<br><br>

<table width="500">

<tr>
	<th align="center" style="color: green; font-size: 30">
		<?=$quiz_info['quiz_name']?><br><br>
	</th>
</tr>

<?	if($question['image_url']) 
	{ ?>
	<tr>
		<td>
			<img src="<?=base_url("upload/{$question['image_url']}")?>" width="480" />
			<br><br>
		</td>
	</tr>
<?	} ?>

<tr>
	<td>
		<?=$question['question_content']?><br><br>
	</td>
</tr>

<tr>
	<td>
	<?php foreach($question['answers'] as $answer)
	{
		if($answer['next_question_id']!=0)
		{ ?>
			<div style="float: left; width: 160px">
			<?	if($answer['image_url']) 
				{ ?>
					<a href="<?=site_url("quiz/non_root/{$answer['next_question_id']}/{$answer['answer_id']}/{$quiz_info['quiz_id']}/{$quiz_info['user_fbid']}")?>"> 
						<img src="<?=base_url("upload/{$answer['image_url']}")?>" width="160" />
					</a><br>&nbsp;
			<?	}	?>
				<a href="<?=site_url("quiz/non_root/{$answer['next_question_id']}/{$answer['answer_id']}/{$quiz_info['quiz_id']}/{$quiz_info['user_fbid']}")?>" style="text-decoration:none">
					<?=$answer['answer_content'];?>
				</a><br><br>
			</div>

		<? } else {?>
				
			<div style="float: left; width: 160px">
				<?	if($answer['image_url']) 
				{ ?>
					<a href="<?=site_url("quiz/result/{$answer['result_id']}/{$answer['answer_id']}/{$quiz_info['quiz_id']}/{$quiz_info['user_fbid']}")?>"> 
							<img src="<?=base_url("upload/{$answer['image_url']}")?>" width="160" />	
					</a><br>&nbsp;
			<?	}	?>
				<a href="<?=site_url("quiz/result/{$answer['result_id']}/{$answer['answer_id']}/{$quiz_info['quiz_id']}/{$quiz_info['user_fbid']}")?>" style="text-decoration:none">	
					<?=$answer['answer_content'];?>
				</a><br><br>
			</div>
			
		<? }
	} ?>
	</td>
</tr>

</table>





