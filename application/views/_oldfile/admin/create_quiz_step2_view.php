
<?
	$quiz_id = $this->uri->segment(3, 1);
?> 

Now please go to <a target="_blank" href="https://developers.facebook.com">
	https://developers.facebook.com</a> to create an app with the following instructions.

<br><br><br>

<b>1. Click on "Apps" as shown below.</b><br><br>
<img src="<?=base_url("upload/app.png")?>" width="800" />
<br><br><br><br><br><br>

<b>2. Click on "Create New App" as shown below.</b><br><br>
<img src="<?=base_url("upload/create_app.png")?>" width="800" />
<br><br><br><br><br><br>

<b>3. Fill in the basic info for your app.</b><br><br>

<b><u>Page Tab URL</u> & <u>Secure Page Tab URL</u> should be filled as below:</b> 
<br><br>

	<table>
		<tr>
			<th>Page Tab URL</th>
			<td ><?='http://'.remove_http(site_url("quiz/index/{$quiz_id}"))?></td>
		</tr>
		<tr>
			<th>Secure Page Tab URL</th>
			<td ><?='https://'.remove_http(site_url("quiz/index/{$quiz_id}"))?></td>
		</tr>	
	</table>
<br><br>
<img src="<?=base_url("upload/app_info(editted).png")?>" width="800" />
<br><br><br><br><br><br>

<b>4. Now go to the next step.</b><br><br>
<a href="<?=site_url("admin/create_quiz_step3/{$quiz_id}")?>">Next >> </a>

<br><br><br><br>


<!--	

	<br><br>
	
	
	<br><br>

	<img src="<?=base_url("upload/facebookapp_setting.png")?>" />
	<br><br>

-->



