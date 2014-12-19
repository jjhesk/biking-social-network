<script src="https://maps.googleapis.com/maps/api/js?sensor=false"  type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">

	google.load("visualization", "1", {packages:["corechart"]});
	google.load('visualization', '1', {packages: ['table']});
</script>

<script type="text/javascript">

function json_decode_drawVisualization(chart1 ,chart2){
	eval("var tmp1="+chart1+";");
	eval("var tmp2="+chart2+";");
	//var tmp=['time', 'aaa', 'bbb'];
	//alert(tmp[0]['time']);
	var result=new Array();
	result[0]=['Time', 'Speed', 'Heart Rate',];
	for(i=0;i<tmp1.length;i++)
	{
		result[parseInt(i+1)]=new Array();
		result[parseInt(i+1)][0]=tmp1[i]['time'];
		result[parseInt(i+1)][1]=parseInt(tmp1[i]['speed']);
		result[parseInt(i+1)][2]=parseInt(tmp2[i]['heart_rate']);
		//result[parseInt(i+1)][3]=parseFloat(tmp2[i]['temperature']);
	}
	return result;
}

function drawVisualization() {
   //Create and populate the data table.
	var dataarray=json_decode_drawVisualization('<?=$chart['coordinates_json']?>', '<?=$chart['custom_data_json']?>');
	var data = google.visualization.arrayToDataTable(dataarray);
  // Create and draw the visualization.
   var options = {
          legend: {position: 'none',},
          hAxis: {textPosition: 'none', baselineColor: '#C7C7C7'},
          vAxis: {gridlines:{color: 'none'}, baselineColor: '#C7C7C7'},
          width: 780,
          height: 225,
          backgroundColor: '#333333',
          series:{0:{color:'#01A5E7', targetAxisIndex:1}, 1:{color:'#FF1F84'}}, 
          vAxes:{0:{title:'Heart Rate (bpm)', titleTextStyle: {color: '#FF1F84'}, textStyle:{color: '#FF1F84',}}, 1:{title:'Speed (km/h)', titleTextStyle: {color: '#01A5E7'}, textStyle:{color: '#01A5E7',}}},
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
}

<?
/*
$activity['total_distance'] = '25.31 km';
$activity['elapse_time'] = '02:13:25';
$activity['avg_speed'] = '14 km/h';
$activity['total_calories'] = '1203 J';
$activity['last_updated'] = '2012-09-21 08:12:45';
$activity['max_speed'] = '17.5 km/h';
$activity['avg_heart_rate'] = '124 bpm';
$activity['max_heart_rate'] = '172 bpm';
*/
?>


function drawSummary() {
      // Create and populate the data table.
      var data = google.visualization.arrayToDataTable([
        ['Summary', '',],
        ['Distance:', ''+<?=$activity['total_distance']?>,],
        ['Time:', '<?=$activity['elapse_time']?>',],
        ['Avg Speed:', ''+<?=$activity['avg_speed']?>,],
        ['Calories:', ''+<?=$activity['total_calories']?>,],
      ]);
      
      var options = {
      	width: 300,
      };    
      // Create and draw the visualization.
      var visualization = new google.visualization.Table(document.getElementById('summary'));
      visualization.draw(data, options);
    }
    
function drawDetails() {
      // Create and populate the data table.
      var data = google.visualization.arrayToDataTable([
        ['Details', '',],
        ['Timing', '',],
        ['Last Activity Date:', '<?=$activity['last_updated']?>',],
        ['Time:', '<?=$activity['elapse_time']?>',],
        ['Avg Speed:', ''+<?=$activity['avg_speed']?>,],
        ['Max Speed:', ''+<?=$activity['max_speed']?>,],
        ['Total Distance:', ''+<?=$activity['total_distance']?>,],
        ['Heart Rate', '',],
        ['Avg Heart Rate:', ''+<?=$activity['avg_heart_rate']?>,],
        ['Max Heart Rate:', ''+<?=$activity['max_heart_rate']?>,],
        ['Calories:', ''+<?=$activity['total_calories']?>,],
      ]);
      
      var options = {
      	width: 300,
      }    
      // Create and draw the visualization.
      var visualization = new google.visualization.Table(document.getElementById('details'));
      visualization.draw(data, options);
    }

    google.setOnLoadCallback(drawDetails);
    google.setOnLoadCallback(drawSummary);
    google.setOnLoadCallback(drawVisualization);
      
      
      
</script>
<style>
	.text_font{
		font-size:14px;
		color:#666;
		float:left;
	}
	.content_number{
		font-size:14px;
		color:#333;
		position:relative;
		left:-10px;
		width:210px;
		background-color:#E3E3E3;
		float:right;
		padding:0px 10px 0px 10px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		
	}
	
</style>
	
	<div id="chart_div" style="padding-top:6px;"></div>

		<!--Summary-->
		<div style="width: 372px;float: left; text-align: left; padding-top: 15px; padding-left: 15px;font-size: 21px"><!--E0E0E0-->
			<div style="font-size:21px;">Summary</div>
			<?php for($i=0;$i<4;$i++){
				$summary_title=array('Distance','Time','Avg Speed','Calories');
				$summary_num=array($activity['total_distance'],$activity['elapse_time'],$activity['avg_speed'],$activity['total_calories']);
				$summary_unit=array('km','mins','km/h','cal');
			?>
			<!-- break image-->
			<div style="position:relative;left:-15px; float:left; margin-top:5px; width:390px; height:13px; background-repeat:repeat-n;
				background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
			</div>
			<div class="text_font">
				<?=$summary_title[$i];?>
			</div>
			<div class="content_number">
				<div style="float:left;"><?=$summary_num[$i];?></div>
				<div style="float:right;"><?=$summary_unit[$i];?></div>
			</div>
			<?	}?>
			<!-- break image-->
			<div style="position:relative;left:-15px; float:left; margin-top:5px; width:390px; height:13px; background-repeat:repeat-n;
				background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
			</div>
		</div>
		
		<!--Details-->
		<div style="width: 374px;position:absolute; left:395px; overflow:hidden;  text-align: left; padding-top: 15px; padding-left: 15px; font-size: 21px">
			<div style="font-size:21px;">Details</div>

			<?php for($i=0;$i<8;$i++){
				$summary_title=array('Last Activity Date','Time','Avg Speed','Max Speed','Total Distance','Avg Heart Rate','Max Heart Rate','Calories');
				$summary_num=array($activity['last_updated'],$activity['elapse_time'],$activity['avg_speed'],$activity['max_speed'],$activity['total_distance'],$activity['avg_heart_rate'],$activity['max_heart_rate'],$activity['total_calories']);
				$summary_unit=array('yy-mm-dd','mins','km/h','km/h','km','bpm','bpm','cal');
			?>
			<!-- break image-->
			<div style="position:relative;left:-15px; float:left; margin-top:5px; width:390px; height:13px; background-repeat:repeat-n;
				background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
			</div>
			<div class="text_font">
				<?=$summary_title[$i];?>
			</div>
			<div class="content_number">
				<div style="float:left;"><?=$summary_num[$i];?></div>
				<div style="float:right;"><?=$summary_unit[$i];?></div>
			</div>
			<?	}?>
			<!-- break image-->
			<div style="position:relative;left:-15px; float:left; margin-top:5px; width:390px; height:13px; background-repeat:repeat-n;
				background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
			</div>
		</div>
	
	
	
</div>

<!-- <div id="summary"></div>
<br>
<div id="details"></div> -->