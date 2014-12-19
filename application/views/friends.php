<?php echo $header;?>
<body>
    <?php //print_r($logindata); ?>
<div id="container"><header style="overflow: hidden;"><div class="logocircle"><img src="<?php echo base_url(); ?>/include/image/common/logo_ibike_L.png" width="100%"/></div>
    <div class="background_banner unselectable">
        <div class="bikes_2"></div><div class="bikes_1"></div>
        <div class="bikes_3"></div><div class="bikes_4"></div>
        <div class="bikes_5"></div><div class="rock"></div>
        <article class="taps unselectable">
            <?php 
          //  print_r($recent_4_activities_count);
          $friendmessage="(".$fancount.")";
          $selflink= site_url().'loginedin/friend/'.$logindata['user_inhouse_id'];
            ?>
            <div class="item"><div class="num"><?php echo $recent_4_activities_count["total_distance"]; ?></div><label>distance/km</label></div>
            <div class="item"><div class="num"><?php echo $recent_4_activities_count["hours"]; ?></div><label>time/hours</label></div>
            <div class="item"><div class="num"><?php echo $recent_4_activities_count["diaries"]; ?></div><label>photo taken</label></div>
            <div class="item"><div class="num"><?php echo $recent_4_activities_count["photo_taken"]; ?></div><label>diaries</label></div>
        </article>
        <div class="title top">Recent Activities</div>
    </div>
    </header>
    <div id="body">
    <section class="topbar unselectable">
        <a href="<?php echo $selflink; ?>" class="homeimg"><img src="<?php echo $logindata['avator'];?>"/></a>
        <div class="nameinfo"><div class="top">
            <?php if(isset($logindata['nickname'])){ echo $logindata['nickname']; }else{ echo $logindata['fullname']; } ?>
        </div>
        <div class="places"><?php echo $user_date_login; ?></div></div>
        <!--<button class="home" onclick="document.location.href='<?php echo site_url()."loginedin/";?>';">
			<a href="<?php echo site_url()."loginedin/";?>">home</a>
		</button>
        <button class="findfriends">friends</button>-->
        <div class="star"></div>
        <div class="rightfunctions">
            <a class="friends" href="<?php echo site_url()."friend/";?>"><label>friends</label></a>
            <a class="photos"><label>photos</label></a>
            <a class="activities" href="<?php echo site_url()."loginedin/";?>"><label>acitvity</label></a>
        </div>
    </section>
    <section class="hr"><title class="datetime">friends <?php echo $friendmessage; ?></title></section>
    <section id="friendsbox">
        <?php 
        	if($friend_list!=null)
        	foreach ($friend_list as $key => $friend) {
            // $this -> nicetime($value["end_time"]);
            $friendlink= site_url().'loginedin/friend/'.$friend['user_inhouse_id'];
     
            $fblink= 'http://www.facebook.com/profile.php?id='.$friend['openid']; ?>
            <div data-id="" href="<?php //echo $friendlink; ?>" class="stack_friend">
                <div class="profilepic"><img src="<?php echo $friend["profile_image"]; ?>"/></div>
                <div class="profilebox">
                    <span class="name"><?php echo $friend["nickname"]; ?></span>
                    <a class="link" href="<?php echo $friendlink; ?>">activity</a>
                    <a class="link" href="<?php echo $fblink; ?>">view profile page</a>
                </div>
           </div>
        <?php } ?>
    </section>
  </div>
    <?php

    echo $footer;
    ?>
</div>
</body>
</html>