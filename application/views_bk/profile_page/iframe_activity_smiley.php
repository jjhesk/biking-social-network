<style>
<? $this->load->file('css/page.css.php'); ?>
</style>
<style>
		.iframe_smiley {
			font-family: 'dinlight';
			font-size: 14px;
			background-color: #C2C1C2;
			float:left;
			position:relative;
			margin-top:10px;
			margin-left:8px;
			width:470px;
			color:#FFFFFF;
		}
		
		.all_icons {
			background-repeat: no-repeat;
			background-color: transparent;
			position:relative;
			float:right;
			width:18px;
			height:18px;
			border:0px;
			margin-left:16px;
			margin-right:6px;
		}
		
		.icon_numbers {
			position:relative;
			float:right;
		}
		
		.happy_icon {
			<? if ($smiley_selected == 1) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-happy-02.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-happy-00.png');
			<?}?>
		}
		
		.happy_icon:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-happy-01.png');
		}
		
		.sad_icon {
			<? if ($smiley_selected == 2) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-sad-02.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-sad-00.png');
			<?}?>
		}
		
		.sad_icon:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-sad-01.png');
		}
		
		.oops_icon {
			<? if ($smiley_selected == 3) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-oops-02.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-oops-00.png');
			<?}?>
		}
		
		.oops_icon:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-oops-01.png');
		}
		
		.blank_icon {
			<? if ($smiley_selected == 4) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-blank-02.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-blank-00.png');
			<?}?>
		}
		
		.blank_icon:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-blank-01.png');
		}
		
</style>

				<div class="iframe_smiley">
					
					<div style="float:left; position:relative;">Comments</div>
					
					<?
					echo form_open('profile_page/form_submit');
					
					// Set hidden data
					$hidden_data = array(
          				'activity_id'  => $activity_id,
          				'comment_user_id' => $comment_user_id,
						'smiley_selected' => 0);
					echo form_hidden($hidden_data); ?>
					
					 
					

					
					<div class="icon_numbers" style="margin-right:20px"><?=$smiley_array['smiley4']?></div>
					
					<? $blank_button_data = array(
              			'name'		=> 'blank',
						'class'		=> 'all_icons blank_icon');
					echo form_submit($blank_button_data); ?>
					
					<div class="icon_numbers"><?=$smiley_array['smiley3']?></div>
					
					<? $oops_button_data = array(
              			'name'		=> 'oops',
						'class'		=> 'all_icons oops_icon');
					echo form_submit($oops_button_data); ?>
					
					<div class="icon_numbers"><?=$smiley_array['smiley2']?></div>
					
					<? $sad_button_data = array(
              			'name'		=> 'sad',
						'class'		=> 'all_icons sad_icon');
					echo form_submit($sad_button_data); ?>
					
					<div class="icon_numbers"><?=$smiley_array['smiley1']?></div>
					
					<? $happy_button_data = array(
              			'name'		=> 'happy',
						'class'		=> 'all_icons happy_icon');
					echo form_submit($happy_button_data); ?>
					
				</div>