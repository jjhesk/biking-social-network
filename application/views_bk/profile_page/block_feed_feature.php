				<div id="right_bar" style="width:220px; ">
						<div style=" width:220px; height:700px; ">
							<div style="width:220px;height:50px;">
								<div style="width:110px; height:50px;  float:left; "><p style="padding-top:5px;"> Request <img src="<?php echo base_url();?>/images/index/msg_box.png"/></p></div>
								<div style="width:110px; height:50px;  float:left;"><p style="padding-top:5px;">Message <img src="<?php echo base_url();?>/images/index/msg_box.png"/></p></div>	
							</div>
							<div style="width:220px; height:336px; background-color:#FFFFFF; margin-top:10px; ">
								<div style="padding:5px; height:46px;">
									<div>
									<h5 style="padding:8px;color:#000000;">News feed<a  id="index_title"  class="nyroModal" style="color:#999999;" href="<?=site_url()?>/profile_page/nyro_news_feed">...</a> </h3>	
									</div>
									<?php foreach ($news_feeds as $news_feed){
											echo  "
									<div class='index_feed'>
										<div style='color:#1FB0EA;'>
										{$news_feed['display_name']}
										</div>
										<div style='style='color:#7F7F7F''>
										{$news_feed['feed']}
										</div>
									</div>
									";
									}
								
									?>
								
								</div>
							</div>	
							<div style="height:34px; background-color:#555555; margin-top:10px; padding:5px;">
								<div class="index_feature">
								<p>Feature Cyclist<a id="index_title" class="nyroModal" style="color:#999999;" href="<?=site_url()?>/profile_page/nyro_featured_persons">...</a> </p>
								</div>
							</div>
							<?php for($i=0; $i<count($feature_friends); $i++){
								$site_url=site_url();
								echo "
								<div class='index_feature2'>
									<div style='float:left; width:60px; text-align:right; margin-right:10px; margin-top:10px;'>
										<a href='{$site_url}/profile_page/index/{$feature_friends[$i]['id']}' class='load_on_profile_tab'><img src='{$feature_friends[$i]['image_url']}' width=50 height=50></a>
									</div>
									<div style='float:left;'>
										<div style='float:left;'>
											<div style='width:100px;'>
											<a href='{$site_url}/profile_page/index/{$feature_friends[$i]['id']}' class='load_on_profile_tab'>{$feature_friends[$i]['name']}</a>
											</div>
											<div>
											{$feature_friends[$i]['fans']} Fans
											</div>
											<div style='width:72px; height:20px; border-style:solid; border-width:thin; text-align:center;'>
											+ Follow
											</div>
										</div>
									</div>
								</div>
								";
							}?>
						</div>
				</div>