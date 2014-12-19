<?php
/*
sample:
							<script>
									function MemberLogouter(){
										//alert("ru");
										$("#Logined").ajaxSubmit();
										Member_Logout();
									}
							</script>
							<?php btn::View_loadPushButton("LogoutBtn", HTTP_WEB_SERVER."/images/member/".$LANG."/btn-logout-", "MemberLogouter()"); ?>
					
// submit button sample:
//no need to implement the onclick function:
	<?php btn::View_loadPushSubmit("RegistBtn", HTTP_WEB_SERVER."/images/index/".$LANG."/btn-submit-"); ?>
					
*/
class Btn{
	const nyroModelVar="sizes: {
										initW: 620, initH: 320,
										minW: 620, minH: 320,
										w: 620, h: 320
									},
									callbacks: {
										beforeShowCont: function() { 
											width = $('.nyroModalCont').width();
											height = $('.nyroModalCont').height();
											$('.nyroModalCont iframe').css('width', width);
											$('.nyroModalCont iframe').css('height', height);
										}
								    }";
	public static function View_loadPushButton($tagname, $location, $onClickfunc1=""){
		//general LV3 always been called. use XXXn.png and XXXo.png as the button, 
		//the onclick controller is js 
		//LV3 load button
		global $LANG;
		?>
			<script>	
				var <?php echo $tagname; ?>keep=false;
				$(document).ready(function(){
						$("#<?php echo $tagname;?>o").hide();
							$("#<?php echo $tagname;?>n").mouseover(function(){
								if(<?php echo $tagname; ?>keep==false){
									$("#<?php echo $tagname;?>o").show();
									$(this).hide();
								}else{
									$("#<?php echo $tagname;?>o").show();
									$("#<?php echo $tagname;?>n").hide();
								}
							});
							$("#<?php echo $tagname;?>o").mouseout(function(){
								if(<?php echo $tagname; ?>keep==false){
									$("#<?php echo $tagname;?>n").show();
									$(this).hide();
								}else{
									$("#<?php echo $tagname;?>o").show();
									$("#<?php echo $tagname;?>n").hide();
								}
							});
						
					});
			</script>
		<img id="<?php echo $tagname?>n" src="<?php echo $location."n.png";?>" class="btn" onclick="<?php echo $onClickfunc1; ?>" />
		<img id="<?php echo $tagname?>o" src="<?php echo $location."o.png";?>" class="btn" onclick="<?php echo $onClickfunc1; ?>" />
		<?php
	}
	public static function initNyroModel(){
		//LV1 for sample use only
		//dont call this function in this project!! 
		?>
			<link rel="stylesheet" href="styles/nyroModal.css" type="text/css" media="screen" />
			<script type="text/javascript" src="js/jquery.nyroModal.custom.js"></script>
		<?php
	}
	public static function View_loadBtnLink($tagname, $location, $href="", $nyroModel=false, $nyroModelVar=self::nyroModelVar){
		//general LV3 always been called. use XXXn.png and XXXo.png as the button, 
		//the onclick controller is js 
		//LV3 load button
		global $LANG;
		?>
			<script>	
				$(document).ready(function(){
							<?php if($nyroModel==true){ ?>
								$("#<?php echo $tagname;?>link").nyroModal({<?php echo $nyroModelVar; ?>});
							<?php } ?>
						$("#<?php echo $tagname;?>o").hide();
						$("#<?php echo $tagname;?>n").mouseover(function(){
								$("#<?php echo $tagname;?>o").show();
								$(this).hide();
							});
							$("#<?php echo $tagname;?>o").mouseout(function(){
								
								$("#<?php echo $tagname;?>n").show();
								$(this).hide();
							});
						
					});
			</script>
		<a href='<?php echo $href; ?>' id="<?php echo $tagname;?>link"  <?php if($nyroModel==true) echo 'class="nyroModel"'; ?>>
			<img id="<?php echo $tagname?>n" src="<?php echo $location."n.png";?>" class="btn" />
			<img id="<?php echo $tagname?>o" src="<?php echo $location."o.png";?>" class="btn" style="display:none;" />
		</a>
		<?php
	}
	public static function View_loadNyroModalLink($tagname, $Description, $href="", $nyroModelVar=self::nyroModelVar){
		//general LV3 always been called. use XXXn.png and XXXo.png as the button, 
		//the onclick controller is js 
		//LV3 load button
		$nyroModel=true;
		?>
			<script>
				$(document).ready(function(){
							<?php if($nyroModel==true){ ?>
								$("#<?php echo $tagname;?>link").nyroModal({<?php echo $nyroModelVar; ?>});
							<?php } ?>
				});
			</script>
			<a href='<?php echo $href; ?>' id="<?php echo $tagname;?>link"  <?php if($nyroModel==true) echo 'class="nyroModel"'; ?>>
				<?php echo $Description; ?>
			</a>	
		<?php
	}
	public static function View_loadNyroModalBtn($tagname, $btnDescription, $href="", $nyroModelVar=self::nyroModelVar){
		$nyroModel=true;
		?>
			<script>
				$(document).ready(function(){
							<?php if($nyroModel==true){ ?>
								$("#<?php echo $tagname;?>link").nyroModal({<?php echo $nyroModelVar; ?>});
							<?php } ?>
				});
			</script>
			<a href='<?php echo $href; ?>' id="<?php echo $tagname;?>link"  <?php if($nyroModel==true) echo 'class="nyroModel"'; ?>>
				<input type="button" id="<?php echo $tagname; ?>" value="<?php echo $btnDescription; ?>" />
			</a>	
		<?php
	}
	
		public static function View_loadPushSubmit($tagname, $location){
		//general LV3 always been called. use XXXn.png and XXXo.png as the button, 
		//the onclick controller is js 
		//LV3 load button
		global $LANG;
		?>
			<script>	
				$(document).ready(function(){
						$("#<?php echo $tagname;?>o").hide();
						$("#<?php echo $tagname;?>n").mouseover(function(){
								$("#<?php echo $tagname;?>o").show();
								$(this).hide();
							});
							$("#<?php echo $tagname;?>o").mouseout(function(){
								
								$("#<?php echo $tagname;?>n").show();
								$(this).hide();
							});
						
					});
			</script>
		<input type="image" id="<?php echo $tagname?>n" src="<?php echo $location."n.png";?>" class="btn"  />
		<input type="image" id="<?php echo $tagname?>o" src="<?php echo $location."o.png";?>" class="btn" style="display:none"  />
		<?php
	}
	public function View_pageheader($input, $link){
		//LV1 call in company.php
		global $LANG;
		?>
		<div  class="index_header_link">
			<a href="<?php echo HTTP_WEB_SERVER; ?>/index.php"><?php echo Loc::o('index'); ?></a> 
			<?php for($i=0;$i<count($input);$i++){ ?>
				> 
				<a href="<?php echo $link[$i]; ?>"><?php echo $input[$i]; ?></a>
			<?php } ?>
		</div>
		<?php
	}
	public function View_btnAds($tagname, $locaiton, $url, $nyroModel=false){
			//this ads image will auto run change image
		?>
					<script>
						var <?php echo $tagname;?>ads='b';
						$(document).ready(function(){
							setTimeout("chg<?php echo $tagname;?>ads()", 7000);
							<?php if($nyroModel==true){ ?>
								$("#<?php echo $tagname;?>link").nyroModal();
							<?php } ?>
						});
						function chg<?php echo $tagname;?>ads(){
							if(<?php echo $tagname;?>ads=='a'){
								$("#<?php echo $tagname;?>o").fadeOut();
								$("#<?php echo $tagname;?>n").fadeIn();
								<?php echo $tagname;?>ads='b';
							}else{
								$("#<?php echo $tagname;?>n").fadeOut();
								$("#<?php echo $tagname;?>o").fadeIn();
								<?php echo $tagname;?>ads='a';

							}
							setTimeout("chg<?php echo $tagname;?>ads()", 7000);
						}
					</script>
					<a href="<?php echo $url; ?>" id="<?php echo $tagname;?>link" <?php if($nyroModel==true) echo 'class="nyroModel"'; ?>>
						<img id="<?php echo $tagname?>n" src="<?php echo $location."n.png";?>" />
						<img id="<?php echo $tagname?>o" src="<?php echo $location."o.png";?>" style="display:none;" />
					</a>
		<?php
	}
	public static function View_selectionbox($tagname, $arr, $val, $selectedID=""){
		//LV1, use to print out the selection Box
		?>
		<select id='<?php echo $tagname;?>' name='<?php echo $tagname;?>'>
		<?php for($i=0;$i<count($arr);$i++){ ?>
			<option value='<?php echo $val[$i];?>' <?php if($selectedID==$val[$i]) echo "selected=selected"; ?>>
				<?php echo $arr[$i];?>
			</option>
		<?php } ?>
		</select>
		<?php
	}
}
?>