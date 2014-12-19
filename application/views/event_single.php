<?php echo $header;

$activity_limit = 1;
$start_activity_count = 0;
foreach ($time_function_group_activities as $key => $value) {
    foreach ($value as $key => $id_array) {
        if ($activity_limit > $start_activity_count) {
            $activity_id = $id_array[0];
            //ID ->$recent_activities_serial
            $activity_order = $id_array[1];
            //order ->$recent_activities
            $activity_single_url = site_url() . 'loginedin/activity/' . $activity_id;
            $photocount = count($recent_activities_serial[$activity_id]['photo']);
            $boxdata = $recent_activities_serial[$activity_id];
        } else {
            break;
        }
        $start_activity_count++;
    }

}
?>
<body>
    <?php //print_r($logindata); ?>
<div id="container">
    <header style="overflow: hidden;">
        <div class="logocircle"><img src="<?php echo base_url(); ?>/include/image/common/logo_ibike_L.png" width="100%"/></div>
        <div class="logout"><a href="<?php echo site_url() . "login/logout"; ?>">logout</a></div>
    <div class="background_banner unselectable history">
        <div class="bikes_2"></div><div class="bikes_1"></div>
        <div class="bikes_3"></div><div class="bikes_4"></div>
        <div class="bikes_5"></div><div class="rock"></div>
        <article class="taps unselectable">
            <?php
            //  print_r($recent_4_activities_count);
            //echo "<br/> event single 36 ";
			//print_r($boxdata);
            ?>
            <div class="item"><label>start</label><div class="num"><?php echo gmdate("G:i",strtotime($boxdata["start_time"])); ?></div><label class="smalllabel">apm</label></div>
            <div class="item"><label>end</label><div class="num"><?php echo  gmdate("G:i",strtotime($boxdata["end_time"])); ?></div><label class="smalllabel">apm</label></div>
            <div class="item"><label>duration</label><div class="num"><?php echo $boxdata["avg_speed"]; ?></div><label class="smalllabel">hours</label></div>
            <div class="item"><label>distance</label><div class="num"><?php echo $boxdata["total_distance"]; ?></div><label class="smalllabel">km</label></div>
            <div class="item"><label>avg speed</label><div class="num"><?php echo $boxdata["avg_speed"]; ?></div><label class="smalllabel">km/hours</label></div>
            <div class="item"><label>photos</label><div class="num"><?php echo $photocount; ?></div><label class="smalllabel">pcs</label></div>
            <div class="item"><label>nearby</label><div class="num"><?php echo $photocount; ?></div><label class="smalllabel">buddies</label></div>
        <?php
        // print_r($recent_4_activities_count);
        ?>
        </article>
        <div class="title top">Activities History</div>
    </div>
    </header>
    <div id="body">
       <!--<pre>
            <?php 
            ?>
        </pre>-->
        <?php
        echo $bodymenu;
        ?>
    <section class="topbar unselectable">
        <div class="homeimg"><img src="<?php echo $logindata['avator']; ?>"/></div>
        <div class="nameinfo"><div class="top"><?php
        if (isset($logindata['nickname'])) { echo $logindata['nickname'];
        } else { echo $logindata['fullname'];
        }
 ?></div>
        <div class="places"><?php echo $user_date_login; ?></div></div>
       <button class="home" onclick="document.location.href='<?php echo site_url()."loginedin/";?>';">
			<a href="<?php echo site_url()."loginedin/";?>">home</a>
		</button>
		
        <button class="findfriends">friends</button>
        <div class="star"></div>
        <div class="rightfunctions">
            <a class="friends" href="<?php echo site_url() . "friend/"; ?>"><label>friends</label></a>
            <a class="photos"><label>photos</label></a>
            <a class="activities" href="<?php echo site_url() . "loginedin/"; ?>"><label>acitvity</label></a>
        </div>
    </section>
   <?php 

   
   // echo "print __ time_function_group_activities";
   // print_r($time_function_group_activities);
$start_activity_count = 0;
    foreach ($time_function_group_activities as $key=>$value) {
      if($activity_limit>$start_activity_count){
        //========================================
        ?><section class="hr"><title class="datetime single"><?php echo $key; ?></title></section><?php
        //========================================
        $start_activity_count++;
        }
        }
           ?>
            <section class="singular_detail data unselectable" act_id="<?php echo $activity_id; ?>">
                <div class="fb-like" data-href="<?php echo $activity_single_url; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="lucida grande"></div>
            <article>
            <div class="detail"><div class="title">
            <div class="titlebar container">
            <?php echo $recent_activities_serial[$activity_id]['description']; ?>
            </div></div>
            <?php 
            if(!empty($recent_activities_serial[$activity_id]['map']['html'])): ?>
            <div class="map container">
                 <div class="title">Road Map</div>
                 <title>tom son jogging in kwun tong for 2.00km</title>
                <?php //echo "the map block is in here";
                    //echo $recent_activities[0]['map']['js'];
                    echo $recent_activities_serial[$activity_id]['map']['html'];
                ?>
            </div><?php
            endif;
            ?>
            
            <?php 
            if(count($recent_activities_serial[$activity_id]['photo'])>0):
                ?>
                <div class="container">
                    <div class="title"><?php echo $photocount; ?> Photos Arhived</div>
                    <?php
                    foreach ($recent_activities_serial[$activity_id]['photo'] as $key => $value) {
                        ?><div class="framephoto">
                            <a class="trigger_photos" rel="lightbox" href="<?php echo $value["full_url"]; ?>">
                                <img class="montage" src="<?php echo $value["thumb_url"]; ?>"/></a></div><?php
                                }
                ?></div><?php
                endif;
            ?>
            <div class="comments container"><div class="fb-comments" data-href="<?php
            echo site_url() . 'loginedin/open_graph_object/' . $activity_id;
                ?>" data-width="803" data-num-posts="100" data-order-by="reverse_time">
                </div>
                </div>
            <div class="functions container"><div class="hear_icon"></div><div class="cloudred">0</div><div class="comment_icon"></div><div class="cloudblue">0</div></div>
            </div>
            <div class="daterow"><div class="row">
            <div class="timespot"><span><?php
            echo $recent_activities_serial[$activity_id]["up_hour"];
            ?><span>:<span><?php
            echo $recent_activities_serial[$activity_id]["up_min"];
            ?></span><span><?php
            echo $recent_activities_serial[$activity_id]["up_apm"];
            ?></span></div>
            <div class="ago"><?php
            echo $recent_activities_serial[$activity_id]["up_ago"];
            ?></div></div></div>
            <div class="bgline"></div>
            <?php
            $recent_activities_serial[$activity_id];
            ?></article>
            </section>
            <?php ?>
    </div>
    <?php
    echo $googlemapblock;
    echo $footer;
    ?>
</div>
</body>
</html>