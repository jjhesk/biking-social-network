
<?
//please use color
 		$color_hex['normal'];
		$color_hex['shaded'];		  
?>


<script src="https://maps.googleapis.com/maps/api/js?sensor=false"  type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="<?=base_url(); ?>js/jquery/jquery.js"></script>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.load('visualization', '1', {packages: ['table']});
</script>

<script type="text/javascript">

function json_decode_drawVisualization(chart1 ,chart2){
	//alert("iframe_record_analysis 22 ");
	eval("var tmp1="+chart1+";");
	eval("var tmp2="+chart2+";");
	
	
	//var tmp=['time', 'aaa', 'bbb'];
	//alert(tmp[0]['time']);
	var result=new Array();
	result[0]=['Time', '<?=$block_record_analysis_field[0]['name']?>', '<?=$block_record_analysis_field[1]['name']?>',];
	for(i=0;i<tmp1.length;i++)
	{
		result[parseInt(i+1)]=new Array();
		result[parseInt(i+1)][0]=tmp1[i]['time'];
		result[parseInt(i+1)][1]=parseInt(tmp1[i]['<?=$block_record_analysis_field[0]['name']?>']);
		result[parseInt(i+1)][2]=parseInt(tmp2[i]['<?=$block_record_analysis_field[1]['name']?>']);
		//result[parseInt(i+1)][3]=parseFloat(tmp2[i]['temperature']);
	}
	//alert(result);
	return result;
}

var coordinates_json;
var custom_data_json;

function initial_chart_data() {

    coordinates_json='<?=$chart['coordinates_json']?>';
    custom_data_json='<?=$chart['custom_data_json']?>';
}

function drawVisualization() {
   //Create and populate the data table.
   //alert("iframe_record_analysis 46");
   //alert('<?=$chart['coordinates_json']?> <?=$chart['custom_data_json']?>');
    //console.log('draw visualization');

	var dataarray=json_decode_drawVisualization(coordinates_json, custom_data_json);
	var data = google.visualization.arrayToDataTable(dataarray);
  // Create and draw the visualization.
   var options = {
          legend: {position: 'none',},
          hAxis: {textPosition: 'none', baselineColor: '#C7C7C7'},
          vAxis: {gridlines:{color: 'none'}, baselineColor: '#C7C7C7'},
          width: 480,
          height: 98,
          backgroundColor: '#333333',
          series:{0:{color:'#01A5E7', targetAxisIndex:1}, 1:{color:'#FF1F84'}}, 
          vAxes:{0:{title:'<?=$block_record_analysis_field[1]['title']?>', titleTextStyle: {color: '#FF1F84'}, textStyle:{color: '#FF1F84',}}, 1:{title:'<?=$block_record_analysis_field[0]['title']?>', titleTextStyle: {color: '#01A5E7'}, textStyle:{color: '#01A5E7',}}},
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
}

function ajax_get_live_data() {

	console.log("iframe record analysis line 77 :ajax getting char record...");
	$.ajax({
		  type: 'GET',
		  url: '<?=site_url()?>/profile_page/ajax_get_record_analysis',
		  data: '<?=$_SERVER['QUERY_STRING']?>',
		  cache: false,
		  success: function(data) {
		     result=data.split('||');
		    // console.log("iframe_record_analysis line 85 , heart rate json :\n "+result[1]);
		     coordinates_json=result[0];
		     custom_data_json=result[1];
		     drawVisualization();
		  },
	});

	
}

google.setOnLoadCallback(drawVisualization);

$(document).ready(function() {
	initial_chart_data();
	<?if ($is_live=="true") {?> 
		setInterval(ajax_get_live_data, 3500);
	 <? }?>	
});

</script>
<div id="chart_div" style="padding-top:6px;"></div>
<!--<? print_r($chart['coordinates_json']);?>-->