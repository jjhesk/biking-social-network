    <section class="topbar unselectable">
        <a href="<?php echo $selflink; ?>" class="homeimg"><img src="<?php echo $logindata['avator']; ?>"/></a>
        <div class="nameinfo">
            <div class="top">
            <?php
                if (isset($logindata['nickname'])) { echo $logindata['nickname'];
                } else { echo $logindata['fullname'];
                }
 ?>
            </div>
            <div class="places"><?php echo $user_date_login ?></div>
        </div>
        <!--<button class="home" onclick="document.location.href='<?php echo site_url()."loginedin/";?>';">
            <a href="<?php echo site_url()."loginedin/";?>">home</a>
        </button>
        <button class="findfriends">friends</button>-->
        <div class="star"></div>
        <div class="rightfunctions">
            <a class="friends" href="<?php echo site_url() . "friend/"; ?>"><label>friends</label></a>
            <a class="photos"><label>photos</label></a>
            <a class="activities" href="<?php echo site_url() . "loginedin/"; ?>"><label>acitvity</label></a>
        </div>
    </section>