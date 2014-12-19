<?php echo $header;?>
<body>
    <?php //print_r($logindata); ?>
<div id="container"><header style="overflow: hidden;">
    <div class="logocircle"><img src="<?php echo base_url(); ?>/include/image/common/logo_ibike_L.png" width="100%"/></div>
    <div class="logout"><a href="<?php echo site_url() . "login/logout"; ?>">logout</a></div>
	<div class="background_banner unselectable">
		<div class="bikes_2"></div><div class="bikes_1"></div>
		<div class="bikes_3"></div><div class="bikes_4"></div>
		<div class="bikes_5"></div><div class="rock"></div>
		<article class="taps unselectable">
		    <?php 
		  //  print_r($recent_4_activities_count);
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
		<?php
		echo $bodymenu;
		//echo "<br/> recent 26 ";
		//print_r($logindata);
		$selflink= site_url().'loginedin/friend/'.$logindata['user_inhouse_id'];
		?>
	<section class="topbar unselectable">
		<a href="<?php echo $selflink; ?>" class="homeimg"><img src="<?php echo $logindata['avator'];?>"/></a>
		<div class="nameinfo">
		    <div class="top">
		    <?php if(isset($logindata['nickname'])){ echo $logindata['nickname']; }else{ echo $logindata['fullname']; } ?>
		    </div>
		    <div class="places"><?php echo $user_date_login ?></div>
		</div>
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
	<?php 
	$start_activity_count = 0;
   // echo "print __ time_function_group_activities";
   if(count($time_function_group_activities)>0){
		foreach ($time_function_group_activities as $key=>$value) {
		    
	      if($activity_limit>$start_activity_count){
		    //========================================
			?><section class="hr"><title class="datetime"><?php echo $key; ?></title></section><?php
			
				//========================================
				foreach ($value as $key => $id_array) {
		            if($activity_limit>$start_activity_count){
		            
		           $activity_id=$id_array[0]; //ID ->$recent_activities_serial
		           $activity_order=$id_array[1]; //order ->$recent_activities
		           $hasmap=!empty($recent_activities_serial[$activity_id]['map']['html'])||$recent_activities_serial[$activity_id]['map']['html']!=null;
		           //print_r($recent_activities_serial[$activity_id]["up_hour"]);
		           $activity_single_url = site_url().'loginedin/activity/'.$activity_id;
		           $userName = $recent_activities_serial[$activity_id]['nickname'];
		           $profile_activity_link= site_url().'loginedin/friend/'.$recent_activities_serial[$activity_id]['user_inhouse_id'];
		           $fb_link="http://www.facebook.com/profile.php?id=".$recent_activities_serial[$activity_id]['openid'];
		           ?>
		            <section class="serial data unselectable <?php echo $hasmap?"":"nomap"; ?>" act_id="<?php echo $activity_id; ?>">
		            <article>
		            <a href="<?php echo $activity_single_url; ?>" class="date">
		            <div class="hr"><?php 
		            echo $recent_activities_serial[$activity_id]["up_hour"];
		            ?></div>
		            <div class="min"><span><?php 
		            echo $recent_activities_serial[$activity_id]["up_apm"];
		            ?></span><span><?php 
		            echo $recent_activities_serial[$activity_id]["up_min"];
		            ?></span></div>
		            <div class="ago"><?php 
		            echo $recent_activities_serial[$activity_id]["up_ago"];
		            ?></div></a>
		           <div class="userimage">
		               <a href="<?php echo $profile_activity_link; ?>"><img src="<?php echo $recent_activities_serial[$activity_id]['profile_image'];?>"/></a>
		               <span class="imageUserName"><a href="<?php echo $profile_activity_link; ?>"><?php echo $userName; ?></a></span>
		               <span class="imageUserName button"><a href="<?php echo $fb_link; ?>">Facebook</a></span>
		               <span class="imageUserName">
		                   <div class="fb-like" data-href="<?php echo $activity_single_url; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="lucida grande">
		                   </div>
		               </span>
		               <span class="imageUserName"><a href="<?php echo $activity_single_url; ?>">Detail</a></span>
		           </div>
		            <div class="detail">
		            <?php 
		            //echo "<br/> recent.php 96 ";
					//print_r($recent_activities_serial);
		            if($hasmap): ?>
		            <div class="map container">
		               <?php //  <div class="title">Road Map</div> ?>
		                 <title>someone jogging in kwun tong for 2.00km</title>
		                <?php //echo "the map block is in here";
		                    //echo $recent_activities_serial[$activity_id]['map']['js'];
		                    echo $recent_activities_serial[$activity_id]['map']['html'];
		                ?>
		            </div><?php
		            endif;
		            ?>
		            <?php 
		            if( (count($recent_activities_serial[$activity_id]['photo'])>0)&&($recent_activities_serial[$activity_id]['photo']!='') ):
		                ?>
		                <div class="container photosection">
		                    <div class="title"><?php echo count($recent_activities_serial[$activity_id]['photo']); ?> photos arhived at this place.</div>
		                    <?php
		                    foreach ($recent_activities_serial[$activity_id]['photo'] as $key => $value) {
		                        ?><div class="framephoto">
		                            <a class="trigger_photos" rel="lightbox" href="<?php echo $value["full_url"];?>">
		                                <img class="montage" src="<?php echo $value["thumb_url"]; ?>"/></a></div><?php
		                    }
		                ?></div><?php
		            endif;
		            ?>
		            <div class="comments"><div class="fb-comments" data-href="<?php 
		                echo site_url().'loginedin/open_graph_object/'.$activity_id;
		                ?>" data-width="478" data-num-posts="2" data-order-by="reverse_time">
		                </div>
		                </div>
		            <div class="functions"><div class="hear_icon"></div><div class="cloudred">0</div><div class="comment_icon"></div><div class="cloudblue">0</div></div>
		
		            </div>
		
		            <div class="bgline"></div>
		            <?php
		            $recent_activities_serial[$activity_id];
		            ?></article>
		            </section>
		            <?php
		            }else {
		             ?><section class="end"><div class="container"><span>to Show More</span></div></section><?php
		                break;
		            }
		            $start_activity_count++;
		        }
		     }else break;
			} //foreach ($time_function_group_activities as $key=>$value) 
		}else{ ?>
			<div style="width: 100%; height: 100%;">
				<div style="font-size: 200%; position: relative; left: 30%; top: 400px; width: 50%;" ><?php echo $errormessage; ?></div>
			</div>
		<? } ?>
	</div>
	<?php
	echo $googlemapblock;
	echo $footer;
	?>
</div>
</body>
</html>