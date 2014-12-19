<!--

Settings
- user setting
- 1st time signup data (eg. height, weight) [note: these "standard user data will be updated by app if it affects"]
- height (if I use a diet-plan app, these will be updated)
- weight
- birthday

- unit (metrics / US) [phase 2]
- language [phase 2]

- open ID account list
- merge accounts

- photo upload account choice (facebook / piccasa / flickr)
- account info

- choice of broadcasting for activities (facebook / google+, weibo)

- privacy setting
- public, friends only, myself only

- alerts by email, etc

- device setting (all the apps the user has installed)
- order of these apps appear in the profile

- privacy setting for each app [phase 3]
- choice of broadcasting for activities for each app [phase 3] (facebook / google+, weibo)

- iBicycle
[setting on the portal widget only]

- iWatch
[setting on the portal widget only]
-->
<? //echo "settings page_main 37 ".$firstlogin;

	//Debug::d($user_data);

	 if($merge=="merge"){ ?>
	 <div style="height: 50px; width: 900px; padding-top: 10px; ">
				 <div class="settings_firstlogin_welcome dinlight">
				 	&nbsp;
				 </div>
		 		 <div class="settings_firstlogin_message dinlight"><Br/>
				 	Your account Merge successfully.
				 </div>
	</div>
<? } ?>	 	
<?  if($firstlogin==true){ ?>
	 <div style="height: 50px; width: 900px; padding-top: 10px; ">
				 <div class="settings_firstlogin_welcome dinlight">
				 Welcome!
				 </div>
		 		 <div class="settings_firstlogin_message dinlight">For the first time user,<Br/>
				 please fill in your personal information before you start connecting with fans.
				 </div>
	</div>
<?	} 
	if($submited==true){
				?>
					 <div style="height: 50px; width: 900px; padding-top: 10px; ">
								 <div class="settings_firstlogin_welcome dinlight">
								 	&nbsp;
								 </div>
						 		 <div class="settings_firstlogin_message dinlight"><Br/>
								 	Update success!
								 </div>
					</div>
				<?
			}
?>
<div class="settings_panel">

	<?php echo form_open('settings/form_submit'); ?>

	<div class="title">
		<span>Settings</span>
	</div>

	<div class="panelcontent">

		<div class="section_heading">
			User settings
		</div>
		
		<!---------Name----------->
		
		<div class="parameter_heading">
			Name
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'firstname', 'class' => 'input_textfield', 'style' => 'width:175px', 'placeholder' => 'First name', 'type' => 'text', 'value' => $user_data['firstname'] );
			echo form_input($data);
			?>
			<?$data = array('name' => 'lastname', 'class' => 'input_textfield', 'style' => 'width:170px', 'placeholder' => 'Last name', 'type' => 'text', 'value' => $user_data['lastname'] );
			echo form_input($data);
			?>
		</div>
		
		
		<div class="parameter_heading">
			Nickname
		</div>
		
		<div class="settings_textfield">
			<?$data = array('name' => 'nickname', 'class' => 'input_textfield', 'style' => 'width:350px', 'placeholder' => 'Nickname', 'type' => 'text', 'value' => $user_data['nickname'] );
			echo form_input($data);
			?>
		</div>
		
		
		
		<!---------GENDER----------->
		
		<div class="parameter_heading">Gender</div>
		
		<div class="settings_textfield">
			<?$data = array('name' => 'gender', 'id' => 'male', 'value' => 'Male', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
				echo form_radio($data);
			?>
			<label for="male" class="privacy_label">Male</label>

			<?$data = array('name' => 'gender', 'id' => 'female', 'value' => 'Female', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');

				if ($user_data['gender'] == 'Female') 
					$data['checked'] = TRUE;
				
				echo form_radio($data);
			?>
			<label for="female" class="privacy_label">Female</label>
		</div>
		
		
		<!-------------COUNTRY--------------->
		<div class="parameter_heading">
			Country
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'country', 'class' => 'input_textfield', 'placeholder' => 'Country', 'type' => 'text', 'value' => $user_data['country']);

			echo form_input($data);
			?>
		</div>
		
		<!---------------EMAIL---------------->
		<div class="parameter_heading">
			Email
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'email', 'class' => 'input_textfield', 'placeholder' => 'Email', 'style' => 'width:350px', 'type' => 'text', 'value' => $user_data['email']);

			echo form_input($data);
			?>
		</div>
		
		<!---------EMAIL PRIVACY----------->
		
		<div class="parameter_heading">Email privacy</div>
		
		<div class="settings_textfield">
			<?$data = array('name' => 'email_privacy', 'id' => 'visible', 'value' => '1', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
				echo form_radio($data);
			?>
			<label for="visible" class="privacy_label">Visible</label>

			<?$data = array('name' => 'email_privacy', 'id' => 'private', 'value' => '0', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');

				if ($user_data['email_privacy'] == '0') 
					$data['checked'] = TRUE;
				
				echo form_radio($data);
			?>
			<label for="private" class="privacy_label">Private</label>
		</div>
		
		<!---------DATE OF BIRTH----------->

		<div class="parameter_heading">
			Date of Birth (dd/mm/yyyy)
		</div>
		
		<div class="settings_textfield">
			<?$data = array('name' => 'date_day', 'class' => 'input_textfield', 'style' => 'width:42px', 'placeholder' => 'dd', 'type' => 'number', 'min' => '1', 'max' => '31', 'step' => '1', 'value' => date("d", strtotime($user_data['birthday'])), );
			echo form_input($data);
			?>
			<?$data = array('name' => 'date_month', 'class' => 'input_textfield', 'style' => 'width:42px', 'placeholder' => 'mm', 'type' => 'number', 'min' => '1', 'max' => '12', 'step' => '1', 'value' => date("m", strtotime($user_data['birthday'])), );
				echo form_input($data);
			?>
			<?$data = array('name' => 'date_year', 'class' => 'input_textfield', 'style' => 'width:72px', 'placeholder' => 'yyyy', 'type' => 'number', 'min' => '1900', 'max' => '2100', 'step' => '1', 'value' => date("Y", strtotime($user_data['birthday'])), );
				echo form_input($data);
			?>

			<?$data = array('name' => 'dob_privacy', 'id' => 'dob_visible', 'value' => '1', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:10px;');

			if (!$user_data['birthday_privacy'] || $user_data['birthday_privacy'] == 1) {
				$data['checked'] = TRUE;
			}
		
			echo form_radio($data);
			?>
		
			<label for="dob_visible" class="privacy_label">Visible</label>
		
			<?$data = array('name' => 'dob_privacy', 'id' => 'dob_private', 'value' => '0', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
		
			if ($user_data['birthday_privacy'] == 0) {
				$data['checked'] = TRUE;
			}
		
			echo form_radio($data);
			?>

			<label for="dob_private" class="privacy_label">Private</label>

			<?
			if ($errors) {
				if ($errors['birthday_error'] == 1) {
					echo '<div class="error_message">' . $errors['birthday_error_message'] . '</div>';
				}
			}
			?>
		</div>
		
		<!---------WEIGHT----------->

		<div class="parameter_heading">
			Body weight
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'weight', 'class' => 'input_textfield', 'type' => 'number', 'min' => '0', 'max' => '300', 'step' => '1', 'value' => $user_data['weight']);

			echo form_input($data);
			?>

			<div class="privacy_label">
				kg
			</div>

			<?$data = array('name' => 'weight_privacy', 'id' => 'weight_visible', 'value' => '1', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:40px;');

	if (!$user_data['weight_privacy'] || $user_data['weight_privacy'] == 1) {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="weight_visible" class="privacy_label">Visible</label>

			<?$data = array('name' => 'weight_privacy', 'id' => 'weight_private', 'value' => '0', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');

	if ($user_data['weight_privacy'] == 0) {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="weight_private" class="privacy_label">Private</label>

			<?
			if ($errors) {
				if ($errors['weight_error'] == 1) {
					echo '<div class="error_message">' . $errors['weight_error_message'] . '</div>';
				}
			}
			?>
		</div>

		<!---------HEIGHT----------->

		<div class="parameter_heading">
			Body height
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'height', 'class' => 'input_textfield', 'type' => 'number', 'min' => '0', 'max' => '250', 'step' => '1', 'value' => $user_data['height']);

			echo form_input($data);
			?>

			<div class="privacy_label">
				cm
			</div>

			<?$data = array('name' => 'height_privacy', 'id' => 'height_visible', 'value' => '1', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:36px;');

			if (!$user_data['height_privacy'] || $user_data['height_privacy'] == 1) {
				$data['checked'] = TRUE;
			}
		
			echo form_radio($data);
					?>
		
					<label for="height_visible" class="privacy_label">Visible</label>
		
					<?$data = array('name' => 'height_privacy', 'id' => 'height_private', 'value' => '0', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
		
			if ($user_data['height_privacy'] == 0) {
				$data['checked'] = TRUE;
			}
		
			echo form_radio($data);
			?>

			<label for="height_private" class="privacy_label">Private</label>

			<?
			if ($errors) {
				if ($errors['height_error'] == 1) {
					echo '<div class="error_message">' . $errors['height_error_message'] . '</div>';
				}
			}
			?>
		</div>
		
		

		<!---------DEFAULT PRIVACY SETTINGS---------->

		<div class="section_heading">
			Default Privacy Settings
		</div>

		
		<div class="settings_textfield">
			<?$data = array('name' => 'overall_privacy', 'id' => 'public', 'value' => 'public', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');

			echo form_radio($data);
			?>

			<label for="public" class="privacy_label">Public</label>

			<?$data = array('name' => 'overall_privacy', 'id' => 'friends_only', 'value' => 'friends_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');

	if ($user_data['default_privacy'] == 'friends_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="friends_only" class="privacy_label">Friends only</label>

			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');

	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="myself_only" class="privacy_label">Myself only</label>
		</div>
		
		<!---------APP PRIVACY SETTINGS---------->
		<?	
		
		// print_r($user_app);
		// echo "<br/> page_main 360 ";
		// print_r($user_app);	
		foreach($user_app as $key=>$value){
			// echo $key['app_id'];
			// echo "<pre>";
			// print_r($value);
			// echo "</pre>";
			?>
			<div class="parameter_heading">
			 <?= $value['tab_label']?> Privacy Settings
		 	</div>
		
			<div class="settings_textfield">
			 <?$data = array('name' => 'app_'.$value['app_id'].'privacy', 'id' =>'app_'.$value['app_id'].'_public', 'value' => 'public', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
			 	echo form_radio($data);
			 ?>
			 <label for="<?= 'app_'.$value['app_id'].'_'?>public" class="privacy_label">Public</label>
 			
 			
 			<?$data = array('name' => 'app_'.$value['app_id'].'privacy', 'id' => 'app_'.$value['app_id'].'_friends_only', 'value' => 'friends_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');
	 		if ($user_data['default_privacy'] == 'friends_only') {
		 		$data['checked'] = TRUE;
			}
			echo form_radio($data);
			?>
			<label for="<?= 'app_'.$value['app_id'].'_'?>friends_only" class="privacy_label">Friends only</label>

 
			 <?$data = array('name' => 'app_'.$value['app_id'].'privacy', 'id' => 'app_'.$value['app_id'].'_myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');
			 if ($user_data['default_privacy'] == 'myself_only') {
				 $data['checked'] = TRUE;
			 }
	 		echo form_radio($data);
			 ?>
			 <label for="<?= 'app_'.$value['app_id'].'_'?>myself_only" class="privacy_label">Myself only</label>

 			
			 <?$data = array('name' => 'app_'.$value['app_id'].'privacy', 'id' => 'app_'.$value['app_id'].'_default', 'value' => 'default', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');
			 if ($user_data['default_privacy'] == 'default') {
					 $data['checked'] = TRUE;
			 }
 			 echo form_radio($data);
			 ?>
			 <label for="<?= 'app_'.$value['app_id'].'_'?>default" class="privacy_label" >Default</label>

		 </div>
			
	<?	}
 			?>
		
		<!---------iBikeFans PRIVACY SETTINGS---------->
		<?php  
	/*  <!--<div class="parameter_heading">
			iBikeFans Privacy Settings
		</div>
		<div class="settings_textfield">
			<?$data = array('name' => 'overall_privacy', 'id' => 'public', 'value' => 'public', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
			echo form_radio($data);
			?>
			<label for="public" class="privacy_label">Public</label>
			<?$data = array('name' => 'overall_privacy', 'id' => 'friends_only', 'value' => 'friends_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');
	if ($user_data['default_privacy'] == 'friends_only') {
		$data['checked'] = TRUE;
	}
	echo form_radio($data);
			?>
			<label for="friends_only" class="privacy_label">Friends only</label>
			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');
	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>
			<label for="myself_only" class="privacy_label">Myself only</label>
			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');
	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>
			<label for="myself_only" class="privacy_label">Default only</label>
		</div> --> 
		
		<!---------PetNfans PRIVACY SETTINGS---------->

		<!-- <div class="parameter_heading">
			PetNfans Privacy Settings
		</div>

		<div class="settings_textfield">
			<?$data = array('name' => 'overall_privacy', 'id' => 'public', 'value' => 'public', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
			echo form_radio($data);
			?>

			<label for="public" class="privacy_label">Public</label>
			<?$data = array('name' => 'overall_privacy', 'id' => 'friends_only', 'value' => 'friends_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');

	if ($user_data['default_privacy'] == 'friends_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="friends_only" class="privacy_label">Friends only</label>
			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');

	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="myself_only" class="privacy_label">Myself only</label>
			
			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');

	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="myself_only" class="privacy_label">Default only</label>
		</div> -->
		
		<!---------iHealthFans PRIVACY SETTINGS---------->

		<!-- <div class="parameter_heading">
			iHealthFans Privacy Settings
		</div>

		
		<div class="settings_textfield">
			<?$data = array('name' => 'overall_privacy', 'id' => 'public', 'value' => 'public', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');

			echo form_radio($data);
			?>

			<label for="public" class="privacy_label">Public</label>

			<?$data = array('name' => 'overall_privacy', 'id' => 'friends_only', 'value' => 'friends_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');

	if ($user_data['default_privacy'] == 'friends_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="friends_only" class="privacy_label">Friends only</label>

			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');

	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="myself_only" class="privacy_label">Myself only</label>
			
			<?$data = array('name' => 'overall_privacy', 'id' => 'myself_only', 'value' => 'myself_only', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');

	if ($user_data['default_privacy'] == 'myself_only') {
		$data['checked'] = TRUE;
	}

	echo form_radio($data);
			?>

			<label for="myself_only" class="privacy_label">Default only</label>
		</div> --> */?>
		
		<!---------SOCIAL MEDIA PUBLICATION SETTINGS---------->

		<div class="section_heading">
			Social Media Publication Settings
		</div>

		
		<div class="settings_textfield">
			<?$data = array('name' => 'social_media_publication', 'id' => 'google', 'value' => 'google', 'checked' => TRUE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
			echo form_radio($data);
			?>

			<label for="google" class="privacy_label">Google +</label>
			
			<?$data = array('name' => 'social_media_publication', 'id' => 'facebook', 'value' => 'facebook', 'checked' => FALSE, 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');
				if ($user_data['social_media_publication'] == 'facebook') {
					$data['checked'] = TRUE;
				}
			echo form_radio($data);
			?>

			<label for="facebook" class="privacy_label">Facebook</label>
			
		</div>
		
		<!---------PHOTO PUBLICATION SETTINGS---------->

		<div class="section_heading">
			Photo Publication Settings
		</div>

		<?
		$user_data['photo_publication']=($user_data['photo_publication']=="")?"google":$user_data['photo_publication'];
		$photo_check["google"]=false;
		$photo_check["facebook"]=false;
		$photo_check["yahoo"]=false;
		$photo_check[$user_data['photo_publication']]=true;
		//Debug::d($user_data);
		?>
			<div class="settings_textfield">
			<?$data = array('name' => 'photo_publication', 'id' => 'photo_google', 'value' => 'google', 'checked' => $photo_check['google'], 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:20px;');
			echo form_radio($data);
			?>
			<label for="photo_google" class="privacy_label">Google +</label>
			<?$data = array('name' => 'photo_publication', 'id' => 'photo_facebook', 'value' => 'facebook', 'checked' =>  $photo_check['facebook'], 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:65px;');
			echo form_radio($data);
			?>
			<label for="photo_facebook" class="privacy_label">Facebook</label>
			<?$data = array('name' => 'photo_publication', 'id' => 'photo_yahoo', 'value' => 'yahoo', 'checked' =>  $photo_check['yahoo'] , 'class' => 'privacy_radio', 'style' => 'float:left; margin-left:30px;');
			echo form_radio($data);
			?>
			<label for="photo_yahoo" class="privacy_label">Yahoo</label>
			
		</div>
		
		
	<!---------MERGE BUTTON----------->
		<div class="parameter_heading">
			Merge Account
		</div>
		<div class="settings_textfield">
			<script>
				function btnclick_merge_account(){
						//alert("block_loginbtn 4");
						
						//alert("<?php echo site_url()?>/login/show_login");
					$.colorbox({
						href: "<?php echo site_url()?>login/show_login/m",
						scrolling : false,
						width : 950,
						height : 570,
						onLoad : function() {
							$('html, body').css('overflow', 'hidden');
							// page scrollbars off
						},
						onClosed : function() {
							$('html, body').css('overflow', '');
							// page scrollbars on
						}
					});
				}
			</script>
			<label for="public" class="privacy_label">&nbsp;&nbsp;&nbsp;Click <span onclick="btnclick_merge_account()" class="link_merge_account">here</span> to choose different login account.</label>
		</div>

		<!---------UPDATE BUTTON----------->

		<?$submit_button_data = array('name' => 'post', 'style' => 'float:left;', 'class' => 'update_button');

			echo form_submit($submit_button_data);

		?>
	</div>
</div>

<!--
<div class="fans_button_search">
<ul class="fans_selection bottom">
<li>
<div class="radius"></div><span>cm</span>
</li>
<li>
<div class="radius"></div><span>ft</span>
</li>
</ul>
</div>
-->