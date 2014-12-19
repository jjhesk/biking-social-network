<!--<canvas id="canvas"></canvas>-->
<?  if($afterfirstlogin==true){ ?>
	 <div style="height: 50px; width: 900px; padding-top: 10px; ">
				 <div class="settings_firstlogin_welcome dinlight">
				 Welcome!
				 </div>
		 		 <div class="settings_firstlogin_message dinlight">For the first time user,<Br/>
				 you can push friend circle to search your friend, and accept friend request here.
				 </div>
	</div>
	 <? } ?>

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
		<div id="profile_pic"></div>
		<div id="name_tag"></div>
		<div id="role"></div>
		<div id="lastupdate"></div>
		<!--<div id="message_tab">messages
			<div class="n"></div>
		</div>-->
		<div id="request_tab">Requests
			<div class="n"></div>
			<div class="box face"><ul class="fans_selection bottom_r"></ul></div>
		</div>
	</section>
	<section id="triple_bann">
		<div id="all">
			<div class="button_fd"></div>
			<div class='label'>News</div>
		</div>
		<div id="myfriends">
			<div class="button_fd"><div class="txt dinr"></div></div>
			<div class='label'>friends</div>
		</div>
		<div id="device">
			<div class="button_fd"></div>
			<div class="label">devices</div>
		</div>
		<!--<div id="dis">
			<div class="button_fd"><div class="txt dinr"></div></div>
			<div class="label">???</div>
		</div>-->
	</section>
	<div id="showpage" class="animated"></div>
	<div id="response" class="animated"></div>
	<section id="bottomsection">
		<div id="titlebar" class=""></div>
		<div class="fill animated"></div>
	</section>
	<?php
	if ($count_fans < 5 || $count_real < 5 || $count_follow < 5)
	//	include ("block_friends.php");
	?>
</div>
<!-- rel is the group name -->
<div id="search_friends">
	<section class="function"><div class="face">
		<?php echo $search_options ?>
		<input type="text" placeholder="enter name here" required="required" value/>
		<div class="search_submit"></div>
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
</div><?php
// adding the style here
include ("css.fans_news.php");
//trying to add the bubble animation background
?><bindings>
    <webHttpBinding>
        <binding name="jsonpWebHttpBinding" crossDomainScriptAccessEnabled="true"/>
    </webHttpBinding>
</bindings>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.masonry_hesk.min.js"></script>
<script>var hitEvent = 'ontouchstart' in document.documentElement ? 'touchstart' : 'click';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/controller/fans_news.js"></script>
<svg xmlns="http://www.w3.org/2000/svg">
    <filter id="grayscale">
        <feColorMatrix type="matrix" values="0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0"/>
    </filter>
</svg>