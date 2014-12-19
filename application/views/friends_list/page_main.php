<?php
// adding the style here
include("block_black.php"); 
include("block_friends.php");
//trying to add the bubble animation background
?><!--<canvas id="canvas"></canvas>-->
<div id="container">
	<!--<div id="page" class="box">
		<div id="nav_friendslist">
			<ul>
				<li id="my_connects">My Connects<div id="count_connect"></div></li>
				<li id="my_fans">My Fans<div id="count_fan"></div></li>
				<li id="i_request">I follow<div id="count_follow"></div>
				</li>
				<li id="serach_people">Invite a friend</li>
			</ul>
		</div>
	</div>-->
	<section id="topbar">
		<div id="profile_pic"><img src="http://hesk.imusictech.net/fansliving/images/friends_list/profile-pic.png"/></div>
		<div id="name_tag"></div>
		<div id="role">professional cyclist<br>Hong Kong</div>
		<div id="lastupdate">Last update<br>13:46 2012.8.20</div>
		<div id="message_tab"><div id="fdreq_n"></div></div>
		<div id="request_tab"><div id="msg_n"></div></div>
	</section>
	<section id="triple_bann">
		<div id="myfan"><div class="button_fd"><div class="txt dinr"></div></div>
		<div class='label'>my fans</div>
		</div>
		<div id="myfollow">
			<div class="button_fd"><div class="txt dinr"></div></div>
			<div class='label'>
				following
			</div>
		</div>
		<div id="invite">
			<div class="button_fd"></div>
			<div class="label">
				invite friend
			</div>
		</div>
	</section>
	<div id="showpage" class="animated"></div>
	<div id="response" class="animated"></div>
	<section id="bottomsection">
		<div id="titlebar" class="numeric"></div>
		<div class="fill animated"></div>
	</section>
	<?php
if ($count_fans < 5 || $count_real < 5 || $count_follow < 5)
//	include ("block_friends.php");
?>
</div>
<!-- rel is the group name -->
<div class="widget" id="freinds_interaction">
	<div>This is the technical data for development</div>
	<div class="friendlist">
	<span uid="<?=$my_id; ?>">MY ID <?=$my_name;?></span>
	</div>
</div>
<div class="widget" id="connected_friends">
	<div class="my_connected_friends">I am following these people. Total <?=$count_real; ?></div>
	<div id="truemyfriends" class="friendlist"><?php 
	foreach($true_friends as $key){ ?><span uid="<?=$key['user_inhouse_id'] ?>"><?=$key['nickname'];?></span><?php
	}?></div>
</div>
<div class="widget" id="friends_request">	
	<div class="requests">You have friends requests. Total <?=$count_fans; ?></div>
	<!--<div class = "moretag">show all</div>-->
	<div id="myfans" class="friendlist"><?php foreach($fans as $key){
		?><span uid="<?=$key['subject_user_id'] ?>"><?=$key['nickname'];?></span><?php
	}?></div>
</div>
<div class="widget" id="requested_friends">	
	<div class="requested">You have requested friends. Total <?=$count_follow; ?></div>
	<div id="myfriends" class="friendlist"><?php 
	foreach($friends as $key){
		?><span uid="<?=$key['user_inhouse_id'] ?>"><?=$key['nickname'];?></span><?php
	}?></div>
</div>
<div class="widget" id="people">
	<div>Be a fan of someone you like!</div>
	<div id="notmyfriends" class="friendlist notfriends"><?php 
	foreach($not_friends as $key){
	?><span uid="<?=$key['user_inhouse_id'] ?>"><?=$key['nickname'];?></span><?php
	}?></div>
</div>
<div id="search_friends">
	<section class="inputbox">
		<?php echo $search_options ?>
		<div id="selection_field"></div>
		<div><input type="text"/>
		</div>
		<div>
			<button id="search_button"></button>
		</div>
	</section>
	<section class="search_output"></section>
	<section class="invite facebook">
		<div class="payload"></div>
	</section>
	<section class="invite twitter">
		<div class="payload"></div>
	</section>
	<section class="invite instagram">
		<div class="payload"></div>
	</section>
	<section class="invite google">
		<div class="payload"></div>
	</section>
	<section class="invite yahoo">
		<div class="payload"></div>
	</section>
	<section class="invite bing">
		<div class="payload"></div>
	</section>
</div>