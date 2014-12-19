<style>
<? $this->load->file('css/page.css.php'); ?>
</style>

<style>
	.iframe_summary {
		font-family: 'dinlight';
background: #b4b4b4; /* Old browsers */
background: -moz-linear-gradient(left,  #b4b4b4 0%, #ffffff 58%, #b7b7b7 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#b4b4b4), color-stop(58%,#ffffff), color-stop(100%,#b7b7b7)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  #b4b4b4 0%,#ffffff 58%,#b7b7b7 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  #b4b4b4 0%,#ffffff 58%,#b7b7b7 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  #b4b4b4 0%,#ffffff 58%,#b7b7b7 100%); /* IE10+ */
background: linear-gradient(to right,  #b4b4b4 0%,#ffffff 58%,#b7b7b7 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4b4b4', endColorstr='#b7b7b7',GradientType=1 ); /* IE6-9 */

	}
</style>
	
<script type="text/javascript" src="https://www.google.com/jsapi">
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
</script>

<script type="text/javascript">

function drawPie1() {
        // Create and populate the data table.
       var data = google.visualization.arrayToDataTable([
        ['Route Type', 'No of Routes'],
         ['<?=$chart_data['pie_chart'][0]['shade']?>', <?=$chart_data['completed_routes']['incomplete']?>],
         ['<?=$chart_data['pie_chart'][0]['normal']?>', <?=$chart_data['completed_routes']['completed']?>]
    	]); 
    	
    	var options = {
          backgroundColor: 'transparent',
          legend: {position: 'none'},
          chartArea: {width: "75%", height: "75%"},
          pieSliceText: 'none',
          slices: {0:{color:'<?=$color_hex['normal']?>'},1:{color:'<?=$color_hex['shaded']?>'}},
        };
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('routes')).
            draw(data, options);
      }
      
function drawPie2() {
        // Create and populate the data table.
       var data = google.visualization.arrayToDataTable([
        ['Time', 'Time Spent'],
        ['<?=$chart_data['pie_chart'][1]['shade']?>', <?=$chart_data['time']['not_spend']?>],
        ['<?=$chart_data['pie_chart'][1]['normal']?>', <?=$chart_data['time']['spent']?>],
    	]);
    	
       var options = {
          backgroundColor: 'transparent',
          legend: {position: 'none'},
          chartArea: {width: "75%", height: "75%"},
          pieSliceText: 'none',
          slices: {0:{color:'<?=$color_hex['normal']?>'},1:{color:'<?=$color_hex['shaded']?>'}},

        };
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('time_spent')).
            draw(data, options);
      }      
      
function drawPie3() {
        // Create and populate the data table.
       var data = google.visualization.arrayToDataTable([
        ['Total Distance', 'Distance'],
         ['<?=$chart_data['pie_chart'][2]['shade']?>', <?=$chart_data['distance']['not_travel']?>],
         ['<?=$chart_data['pie_chart'][2]['normal']?>', <?=$chart_data['distance']['travelled']?>],
    	]);
    	
      var options = {
          backgroundColor: 'transparent',
          legend: {position: 'none'},
          chartArea: {width: "75%", height: "75%"},
          pieSliceText: 'none',
          slices: {0:{color:'<?=$color_hex['normal']?>'},1:{color:'<?=$color_hex['shaded']?>'}},

        };
        
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('distance')).
            draw(data, options);
}


      google.setOnLoadCallback(drawPie1);
      google.setOnLoadCallback(drawPie2);
      google.setOnLoadCallback(drawPie3);
      
</script>

<div class="iframe_summary" style="background-color: #D9D9D9; color: #333333;">
	
	<div style= "height: 80px; ">
		
		<div style= "float:left; height: 130px; width:90px;"></div>
		
		<div class="classname1"></div>
		<div id="routes" style= "width: 80px; float: left; height: 75px; "></div>
		<div style= "margin-top:5px; width: 200px; height: 70px; float: left; font-size: 14px"><p style="font-size:16px; margin-bottom: 0px;"><?=$chart_data['pie_chart'][0]['label']?></p><?=$chart_data['pie_chart'][0]['value']?></div>
		
	
		<div id="time_spent" style= "width: 80px; float: left; height: 75px; "></div>
		<div style= "margin-top:5px; width: 200px; height: 70px; float: left; font-size: 14px"><p style="font-size:16px; margin-bottom: 0px;"><?=$chart_data['pie_chart'][1]['label']?></p><?=$chart_data['pie_chart'][1]['value']?></div>
		
	
		<div id="distance" style= "width: 80px; float: left; height: 75px; "></div>
		<div style= "margin-top:5px; width: 200px; height: 70px; float: left; font-size: 14px"><p style="font-size:16px; margin-bottom: 0px;"><?=$chart_data['pie_chart'][2]['label']?></p><?=$chart_data['pie_chart'][2]['value']?></div>
		
	<!--
		<div style= "width: 80px; float: left; height: 75px;">
			<div style= "width: 57px; height: 57px; border-radius: 100%; background-color: <?=$color_hex['shaded']?> ; margin-top: 10px; margin-left: 10px; font-size:40px; text-align: center; color: <?=$color_hex['normal']?>;"><div style="padding-top:5px;"><?=$chart_data['active']['rank']?></div> </div>
		</div>
		<div style= "margin-top:10px; width: 120px; height: 65px; float: left; font-size: 14px"><p></p><?=$chart_data['display_number']['label']?> <?=$chart_data['active']['total']?></div>
		
		</div>
	-->
</div>