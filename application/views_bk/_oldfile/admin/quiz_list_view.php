
<?php

/*	echo '<pre>';
	print_r ($quiz_list);
	echo '</pre>'; 
	// */
?>



<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load('visualization', '1', {packages: ['corechart']});
</script>


<script type="text/javascript">
	function drawVisualization() // Create and populate the data table.
	{
		var data = google.visualization.arrayToDataTable
		([
			['Gender', 'Number of people'],
			['Male', <?=$stat['total_male']?>],
			['Female', <?=$stat['total_female']?>],
		]);
  
        // Create and draw the visualization.
		new google.visualization.PieChart(document.getElementById('gender')).
		draw(data,{
			title:"Gender distribution",
			titleTextStyle: {fontSize:12},
			chartArea: {width:"80%"},
			is3D:true,
		});
	}
	google.setOnLoadCallback(drawVisualization);
</script>

<script type="text/javascript">
	function drawVisualization() // Create and populate the data table.
	{
		var data = google.visualization.arrayToDataTable
		([
			['Age group', 'Number of people'],
			['15 or below', <?=$stat['age <= 15']?>],
			['16 - 25', <?=$stat['15 < age <= 25']?>],
			['26 - 35', <?=$stat['25 < age <= 35']?>],
			['36 - 45', <?=$stat['35 < age <= 45']?>],
			['46 - 55', <?=$stat['45 < age <= 55']?>],
			['56 - 65', <?=$stat['55 < age <= 65']?>],
			['Above 65', <?=$stat['65 < age']?>],
		]);
  
        // Create and draw the visualization.
		new google.visualization.PieChart(document.getElementById('age')).
		draw(data,{
			title:"Age distribution",
			titleTextStyle: {fontSize:12},
			chartArea: {width:"80%"},
			is3D:true,
		});
	}
	google.setOnLoadCallback(drawVisualization);
</script>



<b>General Statistic</b>
<br>

<table>
	<tr>
		<td><div id="gender" style="width: 300px; height: 200px;"></div></td>
		<td><div id="age" style="width: 300px; height: 200px;"></div></td>
	</tr>
</table>



<b>Quiz List</b>
<br><br>

<table border="1">
	<tr>
		<th>Quiz id</th>
		<th align="left">Quiz Name</th>
		<th>Creation at</th>
		<th>Last update</th>
		<th>Updated by</th>
	</tr>
<?
	foreach($quiz_list as $quiz)
	{	?>
		
	<tr>
		<td><a href="<?=site_url("admin/quiz_details/{$quiz['quiz_id']}")?>"><?=$quiz['quiz_id']?></a></td>
		<td><a href="<?=site_url("admin/quiz_details/{$quiz['quiz_id']}")?>"><?=$quiz['quiz_name']?></a></td>
		<td><?=$quiz['creation_date']?></td>
		<td><?=$quiz['date_last_update']?></td>
		<td><?=$quiz['who_last_update']?></td>
	</tr>
<?	}	?>
	
</table>




