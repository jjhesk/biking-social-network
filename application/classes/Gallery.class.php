<?php
class Gallery{
	public static function View_galleryTab($photos, $defaultImage, $typelink="", $num="", $width="380", $height="260"){
		//LV1 call in index.php ownerzone area, ownerzone_photo.php or surveydetail.php
		?>
		
		<table border=0 cellpadding=0 cellspacing=0 style=" position: relative; left: 10px; top: 10px;">
			<tr><td align=left valign=middle>
					<img src="<?php echo HTTP_WEB_SERVER;?>/images/ownerzone/btn-l1.png" onclick="ownerzone_thumbarearight()" />
				</td><td align=left valign=top>
					<?php self::View_Rolling($photos, $defaultImage, $typelink, $num, $width, $height); ?>
				</td><td>
					<img src="<?php echo HTTP_WEB_SERVER;?>/images/ownerzone/btn-r1.png" onclick="ownerzone_thumbarealeft()" />
				</td></tr>
		</table>
		<?php
	}
	public static function View_Rolling($photos, $defaultImage="", $typelink="", $num="", $width="380", $height="260"){
		//LV2 should load the database!
		//the gallery area should call View_GalleryArea at the top of the htmlheader, next to the body tag, 
		//otherwise some overflow hidden area will eat the background shadow. 
		//$photos[i]={imagelink, thumblink, $LANG.'_description'}
		//$defaultImage=$_GET['id'] in ownerzone_photo.php
		//$typelink=HTTP_WEB_SERVER."/ownerzone_photo.php?id= in index.php
		//$num=the number of image load in the table row
		//the size of full image is 520X483
		//the size of thumb image is 77 X 77
		
		global $LANG;
		//$this->photos=$this->get_photos();
		if($num=="") $num=3;
		?>
		<script>
			function loadOwnerzoneGalleryContent(loc, fulllink){
				<?php if($typelink!=""){ ?>
					//document.location.href="<?php echo HTTP_WEB_SERVER."/ownerzone_photo.php?id="; ?>"+loc;
					document.location.href="<?php echo $typelink; ?>";
				<?php }else{ ?>
						$("#ownerzone_galleryImg").fadeOut();
						setTimeout("loadimage('"+loc+"', '"+fulllink+"')", 500);
						//$("#ownerzone_galleryImg").fadeIn();
				<?php } ?>
			}
			function loadimage(loc, fulllink){
				$("#ownerzone_galleryImg").DivCrapImage(loc, <?php echo $width;?>, <?php echo $height;?>).attr( "href", fulllink ).nyroModal();
				setTimeout("reviveimg('"+loc+"')", 500);
			}
			function reviveimg(){
				if($("#ownerzone_galleryImg").css("display")=="none")
						$("#ownerzone_galleryImg").animate({opacity: "toggle"}, 500);
			}
			
			<?php if($typelink==''){ ?>
				$(document).ready(function(){
					<?php if($defaultImage!=""){?>
						$("#ownerzone_galleryImg").DivCrapImage("<?php echo $defaultImage; ?>", <?php echo $width;?>, <?php echo $height;?>).attr( "href", "<?php echo $defaultImage; ?>"  ).nyroModal();
					<?php }else {?>
						//alert("<?php echo HTTP_WEB_SERVER.$photos[0]['imagelink']; ?>");
						//$("#ownerzone_galleryImg").DivCrapImage("<?php echo HTTP_WEB_SERVER.$photos[0]['imagelink']; ?>", 520, 483);
						loadOwnerzoneGalleryContent("<?php echo HTTP_WEB_SERVER.$photos[0]['imagelink']; ?>", "<?php echo HTTP_WEB_SERVER.$photos[0]['fulllink']; ?>" );
					<?php } ?>
				});
			<?php } ?>
			
			var ownerzone_currentImg=0;
			var pushlock=0;
			function ownerzone_thumbarealeft(){
				if(pushlock==0){
					pushlock=1;
					
					if(ownerzone_currentImg-1>=<?php echo $num-count($photos);?>){
						ownerzone_currentImg=ownerzone_currentImg-1;
						tempx=ownerzone_currentImg*87;
						$("#ownerzone_thumbarea").animate({left: tempx+"px"}, 200);
					}else{
						ownerzone_currentImg=0;
						tempx=ownerzone_currentImg*87;
						$("#ownerzone_thumbarea").animate({left: tempx+"px"}, 200);
					}
					setTimeout("ownerzone_unlock()", 300);
				}
			}
			function ownerzone_unlock(){
				pushlock=0;
			}
			function ownerzone_thumbarearight(){
				if(pushlock==0){
					pushlock=1;
					if(ownerzone_currentImg+1<=0){
						ownerzone_currentImg=ownerzone_currentImg+1;
						tempx=ownerzone_currentImg*87;
						$("#ownerzone_thumbarea").animate({left: tempx+"px"}, 200);
					}else{
						ownerzone_currentImg=<?php echo $num-count($photos);?>;
						tempx=ownerzone_currentImg*87;
						$("#ownerzone_thumbarea").animate({left: tempx+"px"}, 200);
					}
					setTimeout("ownerzone_unlock()", 300);
				}	
			}
			
		</script>
		<div id="ownerzone_thumbouter" style="width: <?php echo $num*87;?>px;">
			<div id="ownerzone_thumbarea">
				<table border=0 cellpadding=0 cellspacing=0  id="ownerzone_gallery1_img">
					<tr>
						<?php for($i=0;$i<count($photos);$i++){ ?>
								<td align=left valign=top class="ownerzone_gallery1_img">
									<img style="width:87px; height:87px;" src="<?php echo HTTP_WEB_SERVER.$photos[$i]['thumblink']; ?>"  onclick="loadOwnerzoneGalleryContent('<?php echo HTTP_WEB_SERVER.$photos[$i]['imagelink']; ?>', '<?php echo HTTP_WEB_SERVER.$photos[$i]['fulllink']; ?>')" />
								</td>
						<?php } ?>
					</tr>
					<tr>
						<?php for($i=0;$i<count($photos);$i++){ ?>
								<td align=left valign=top class="ownerzone_gallery1_word">
									<div><?php echo $photos[$i][$LANG.'_description']; ?></div>
								</td>
						<?php } ?>
					</tr>	
				</table>
			</div>
		</div>
		<?php
	}
	public static function View_galleryBody($width="520", $height="483"){
		?>
			<div id="ownzone_imgarea" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
				<a id="ownerzone_galleryImg" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; margin:auto;">
				</a>
			</div>
		<?php
	}
}	
?>