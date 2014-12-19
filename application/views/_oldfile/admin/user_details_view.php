
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
//	$user_details = $this->facebook->api("/{$user_id}");
	$user_picture = $this->facebook->api("/{$user_id}?fields=picture");
	$pic = $user_picture['picture'];
//	$name = $user_details['name'];
	$user_detail = $user_detail['0'];


	
/*	echo '<pre>';
	print_r ($user_detail);
//	print_r ($user_details);
	echo '</pre>';	// */
		
?>



<table border="0">
	<tr>
		<td>
			<b>Information of 
			<?php
				echo $user_detail['user_name']."&nbsp;&nbsp;<img src='{$pic}'/>";
				if($user_detail['token_expiry'] == null)
				{
						?>
					(Token Expired)
					<p>
						User has removed our access to his/her profile. His/her last update on her portfolio was on:
						<br>
						<?=$user_detail['last_login']?>
					</p>
					<?
				}
			?></b>
		</td>
	</tr>
</table>
	
	
<table border="0" text-align:center;>	

   <tr>  	<td>Facebook ID:</td><td><?=$user_detail['user_fbid']?></td>   </tr>
   <tr>  	<td>Name:</td><td><?=$user_detail['user_name']?></td>   </tr>
   <tr>  	<td>Email:</td><td><?=$user_detail['user_email']?></td>   </tr>
   <tr>  	<td>Gender:</td><td><?=$user_detail['user_gender']?></td>   </tr>
   <tr>  	<td>Birthday:</td><td><?=$user_detail['user_bday']?></td>   </tr>
   <tr>  	<td>Last Login:</td><td><?=$user_detail['last_login']?></td>   </tr>

	<tr>
	<td>
		Likes:
	</td>
	</tr>

	<tr>
		<td  colspan="2" valign="top">
		<?php
		
		if($user_detail['token_expiry'] == null)
		{?>
			
			<br>
			<?=nl2br($user_detail['user_likes'])?>
							
		<?}
		else {
			
			$user_likes_url = "https://graph.facebook.com/{$user_detail['user_fbid']}/likes?fields=id,name,picture&access_token={$user_detail['fb_access_token']}";
			$user_likes_json = file_get_contents($user_likes_url);
			$liked = json_decode($user_likes_json, true);
		
//			$liked = $this->facebook->api("/{$user_id}/likes?fields=picture,name");
			$liked_array = $liked['data'];
			?>
			<div style="height:300; overflow-y: scroll">
			<?
			foreach ($liked_array as $key => $liked_item)
			{
		?>
		
		<div style="float: left; width: 200px">
			<div style="float: left; margin: 5; width: 100; height:100" >
			
				<?
					$liked_pic_url = $liked_item['picture'];
					$liked_item_name = $liked_item['name'];
				?>
				<a href="<?=site_url('admin/index/')."?search_key=user_likes&search_value={$liked_item_name}"?>">
					<img src='<?=$liked_pic_url?>' height=50 width=50/>
				</a>
				
			<br>
				<?
					echo $liked_item_name.'<br>';
					
				?>
			</div>
		</div>
		<?
				}							
			}
			
		?>
		</div>
		</td>
	</tr>

</table>

<br>

<b><?php echo $user_detail['user_name'] ?> played the following quiz:</b>
<?

/*	echo '<pre>'; 
	print_r ($quizzes);
	echo '</pre>';	// */
		
	foreach($quizzes as $quiz_no => $quiz)
	{
?>
		
		<table border="0" text-align:left>	
			<tr><td></td></tr>
		<tr><td>	
		Quiz name: <?=$quiz['quiz_name']?>
		</td>
		</tr>
		<?
		foreach($quiz['questions'] as $question_no => $question)
		{	$j='';
		    $j++;?>
			
			<tr><td>
		-Question <?=$j?>: <?=$question['question_content']?>
			<br>
			<?
				$tmp0 = end($question['each_answer']);
	 			$tmp1 = end($tmp0);
			?>
			</td></tr>
			<tr><td>
			<?php echo $user_detail['user_name']?> last answer is: <img src="<?=base_url("upload/{$tmp1}")?>" width="80" />	
			<br>
				</td></tr>
				<tr><td>
			<?php echo $user_detail['user_name']?> has played the quiz: <?=count($question['each_answer'])?> times.
			<br>
       </td></tr>
       <tr><td>
       		His/her preivous answers for the quiz: <?
			foreach($question['each_answer'] as $each_answer => $content)
			{	?>
				&nbsp"<?=$content['answer_content']?>"
            
		<?	} // */
		
		}
		
	}

?>	</td></tr>




<!--		<br><br><br>
		<input value="<?=$quiz['quiz_name']?>"> -->

<?php /*<table border="0" text-align:left>	
			<tr><td><b>Quiz content</b></td></tr>
		<tr><td>	
		Quiz <?=$quiz['quiz_id']?>: <?=$quiz['quiz_name']?>
		</td>
		</tr>
		<?
		foreach($quiz['questions'] as $question_no => $question)
		{	?>
			
			<tr><td>
			&nbsp;&nbsp;&nbsp;&nbsp;-Question <?=$question['question_id']?>: <?=$question['question_content']?>
			<br>
			<?
				$tmp0 = end($question['each_answer']);
	 			$tmp1 = end($tmp0);
			?>
			</td></tr>
			<tr><td>
			Last answer: <img src="<?=base_url("upload/{$tmp1}")?>" width="80" />	
			<br>
				</td></tr>
				<tr><td>
			Times answered: <?=count($question['each_answer'])?>
			<br>
       </td></tr>
       <tr><td>
       		List of all answers: 
			
			<?
			foreach($question['each_answer'] as $each_answer => $content)
			{	?>
				&nbsp"<?=$content['answer_content']?>"
            
		<?	} // 
		
		}
		
	}</td></tr>*/

?>	










