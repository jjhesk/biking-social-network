<?php 
    $start_activity_count = 0;
   // echo "print __ time_function_group_activities";
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
            <section class="serial data unselectable <?php echo $hasmap ? "" : "nomap"; ?>" act_id="<?php echo $activity_id; ?>">
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
               <a href="<?php echo $profile_activity_link; ?>"><img src="<?php echo $recent_activities_serial[$activity_id]['profile_image']; ?>"/></a>
               <span class="imageUserName"><a href="<?php echo $profile_activity_link; ?>"><?php echo $userName; ?></a></span>
               <span class="imageUserName button"><a href="<?php echo $fb_link; ?>">Facebook</a></span>
               <span class="imageUserName">
                   <div class="fb-like" data-href="<?php echo $activity_single_url; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="lucida grande">
                   </div>
               </span>
           </div>
            <div class="detail">
            <?php 
            if($hasmap): ?>
            <div class="map container">
               <?php //  <div class="title">Road Map</div> ?>
                 <title>someone jogging in kwun tong for 2.00km</title>
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
                <div class="container photosection">
                    <div class="title"><?php echo count($recent_activities_serial[$activity_id]['photo']); ?> photos arhived at this place.</div>
                    <?php
                    foreach ($recent_activities_serial[$activity_id]['photo'] as $key => $value) {
                        ?><div class="framephoto">
                            <a class="trigger_photos" rel="lightbox" href="<?php echo $value["full_url"]; ?>">
                                <img class="montage" src="<?php echo $value["thumb_url"]; ?>"/></a></div><?php
                                }
                ?></div><?php
                endif;
            ?>
            <div class="comments"><div class="fb-comments" data-href="<?php
            echo site_url() . 'loginedin/open_graph_object/' . $activity_id;
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
            }
        ?>
    </div>
<?php  echo $googlemapblock; ?>