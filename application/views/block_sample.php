<script src="js/jquery/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#left_container a").each(function(index){
			var href=$(this).attr("href");
			$.get(href, function(data){
				$("#right_container").html(data);
			});
		});
		
	});
</script>
<div id="outer_container">
	<div id="left_container" style="float:left;">
		<a href="location1.php">
			location 1
		</a>
		<a href="location2.php">
			location 2
		</a>
	</div>
	<div style="float:left;">
		<div id="right_container">
			
		</div>
	</div>
</div>