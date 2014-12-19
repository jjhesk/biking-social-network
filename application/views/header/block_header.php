<!--<img src="<?php echo base_url(); ?>images/index/search-bg-01.png" style="float: right;top: 25px;position: relative;">-->
<div class="index_nav_menu <?php echo isset($is_logined)&&$is_logined==TRUE?'logined':'';?>"><?php
if(isset($profile_tabs_html)){
echo $profile_tabs_html;
}
echo $view_block_login_area;
?></div>
