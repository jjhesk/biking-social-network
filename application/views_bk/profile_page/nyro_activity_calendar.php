<div class="calendar">
<?=$calendar?>
</div><script>
 	jQuery(".cal.arrow").click(function(){
 	 var k=jQuery(this).attr("href");
 		colorbox_cal(k.toString());
 	});
 	jQuery(".cal_event_click").click(function(){
 		jQuery(".calendar").html(loading_content);
 		jQuery.colorbox.close();
 	});
</script>