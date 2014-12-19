<pre>
<?
//print_r($pets);
?>
</pre>

<html>
	<head>
		
		
		<style type="text/css">
			 <?if(isset($pets)){
				 $height = 250* count($pets)+70 ;
				 $height_content = 180* count($pets);
				 }else{
				 $height = '200';
				 $height_content = '190';
				 }
			 ?>
			#wrapper{
				background-color:#E9EAEB; 
				width:970px;
				height:<?=$height?>px;
				
			}
			#title{
				margin-top:20px;
				margin-left:20px;
				
				
			}
			#content{
				background-color:#FFFFFF;
				width:900px;
			    height:<?=$height_content?>px;
				margin-top:25px;
				padding-left:10px;
				padding-right:10px;
				padding-top:30px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				
			}
			#content_row{
				width:100%;
				border-color: #444444;
			    height:150px;
			}
			#missing_photo{
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				width:15%;
				float:left;
			}
			#missing_content{
				width:75%;
				float:left;
			}
			#lost_address{
				height:20px;
				float:left;
				
			}
			#lost_address_content{
				float:left;
				color:#F3A333;
				font-size:15px;
			}
			#lost_address_btn{
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				background-color:#919191;
				color:#FFFFFF;
				position:relative;
				left:10px;
				width:45px;
				float:left;
				padding
			}
			#lost_address_btn:hover{
				background-color:#959595;
			}
			#lost_address_btn:active{
				background-color:#FFF555;
			}
			
			#lost_desc{
				height:
			}
			#break{
				background-image:url(<?=base_url()?>/application/views/community/image/break.png);
				background-repeat:repeat-x;
			}
			#lost_info{
				
			}
			#lost_info_row{
				float:left;
			}
			#lost_info2{
				float:left;
			}
			#span_display{
				overflow:hidden;
				width:100px;
				height:20px;
				
			}
			
			#under_break{
				width:100%;
				background-image:url(<?=base_url()?>/application/views/community/image/break2.png);
				background-repeat:repeat-x;
			}
			
		
		
		</style>
	</head>
	<body> 
					 <?
					// $tmp = json_decode($pets[0]['custom_data_json'], true);
							/*if(isset($tmp[0]))
							foreach($tmp[0] as $key=>$item)
							{
								switch($key){
									
									case 'name':
									case 'description':
									case 'image':
										break;		//skip if these keys
										
									default:
										echo "{$key}: {$item}<br>";
									break;
								}	
							}*/
						?>
		<div id="wrapper">
			<div id="title"><!--This is the Title of missing pets -->
				<div style="padding-top:30px;color:#9FA0A0; font-size:25px;">
					Missing Pets
				</div>
				<div id="content"><!--The main content of missing pets -->
					
				 <?
				 
				 //$pets[1]=$pets[0];
				 if( (isset($pets))&&($pets!=null) ){
					 foreach($pets as $value){
							$tmp = json_decode($value['custom_data_json'], true);
							//print_r($tmp);
							//echo $tmp[0]['Age'];
							//print_r($pets);			 
							 	/*echo"<pre>";
								print_r($value);
								echo "</pre>";
								echo "</br>";*/
							
								?>
								<div id="content_row">
									<div id="missing_photo">
									<img width=110px; height:110px; src="<?=$value['image'];?>">
								<?//count($key);?>
									</div>
									<div id="missing_content">
										 <div id="lost_address">
										 	<div id="lost_address_content">
											 	<? if( (isset($tmp[0]['Breed']))&&($tmp[0]['Breed']!='') ){ ?>
												 	Lost - <?=$tmp[0]['Breed']?>
												<? } ?>
										 	</div>
										 	<div id="lost_address_btn">
										 		<span class="position:relative; right:5px;">
										 			<a href="<?=site_url()?>/profile/activity/<?=$value['app_users_data_id']?>" style="color:#FFFFFF;"  ><?="Details"?></a>
										 		</span>
										 	</div>
										 </div>
										 <div id="lost_desc">
											 </br>
											 	<font size="1px;" color="#6F6F6F">DESCRIPTION</font>
											 </br>	
											 	 <div style="width:700px; height:20px;overflow:hidden;"> <?=$value['description'];?></div>
											
										 </div>
									
										 <div id="lost_info"><!-- information-->
										 	 <div id="lost_info_row" style="width:150px; position:relative; ">
										 	   <font size="1px;" color="#6F6F6F"> PET NAME</font>
										 	   	</br>
										 	   	<div id="span_display">
										 	    <?=$value['name'];?>
										 	    </div>
										 	    
										 	 </div>
										 	 <div id="lost_info_row" style="width:150px; position:relative; left:50px;">
											 	 <font size="1px;" color="#6F6F6F">GENDER</font>
											 	 	</br>
											 
											 	 <?=$tmp[0]['Sex']?>
											
											 
										 	 </div>
										 	 <div id="lost_info_row"style="position:relative;left:50px;">
											 	 <font size="1px;" color="#6F6F6F">BREED</font>
											 	 </br>
											 	<div id="span_display">
											 		<? if( (isset($tmp[0]['Breed']))&&($tmp[0]['Breed']!='') ){ ?>
												 		<?=$tmp[0]['Breed']?>
												 	<? } ?>
											 	</div>
											 	 
											 	
										 	 </div>
										 	 <div id="lost_info_row"style="position:relative;left:150px;">
										 		<font size="1px;" color="#6F6F6F"> PETAGE</font>
										 		
										 		</br>
									 			<div id="span_display">
										 		<?= $tmp[0]['Age'];?>
										 		</div>
										 	 </div>
										 	
										 	
										 	 
										 </div>
										 
										 
										 
										 
										 <div id="break">
										 	&nbsp;
										 </div>
										 <div id="lost_info2" ><!-- information-->
										 	<div id="lost_info_row" style="width:150px; position:relative; ">
										 	   <font size="1px;" color="#6F6F6F"> DATE LOST</font></br>
										 	   	<div id="span_display">
										 		<?=$value['date_lost']?>
										 		</div>
										 	    
										 	 </div>
										 	 <div id="lost_info_row" style="width:150px; position:relative; left:50px;">
											 	<font size="1px;" color="#6F6F6F">LAST DETECTED</font></br>
											 	<div id="span_display">
											 	<?=$value['last_detected_activity'][0]['last_updated']?>
											 	</div>
										 	 </div>
										 	 <div id="lost_info_row"style="width:150px; position:relative;left:50px;">
											 	<font size="1px;" color="#6F6F6F">PHONE</font></br>
											 	<div id="span_display">
											 	<?=$value['phone']?>	
											 	</div>
										 	 </div>
										 </div>
									</div>
								</div><!--id=content_row-->
								
								
								<div id="under_break">
									&nbsp;
								</div>
								<!-- The break of backline -->
							<? } //foreach ?>
						<? }else{ ?>
							<div style="width: 100%; text-align:center;">There is no Pet missing.</div>
						<? } ?>
				</div>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>
