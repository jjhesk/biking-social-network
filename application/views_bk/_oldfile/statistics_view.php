

<?php

	echo '<pre>';
	print_r ($stat);
//	print_r ($quiz_list);
	echo '</pre>';
	
?>



	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
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



<?php 
/*	foreach($quizzes as $quiz)
	{ // */
?>

<?
//	}
?>








<b><u>Statistics</u></b> <p>

Total number of users : <?=$stat['total_user_number']?> <p>

Total visits of all quiz : <?=$stat['total_results']?> <p>

<?php 
/*	foreach($quiz_list as $quiz)
	{
?>
	Total visits for quiz <?=$quiz['quiz_id']?>: <?=$quiz['quiz_result']?><p>
<?
	} // */
?>


<br><br><br><br><br>

Answers & results for each quiz : <p>



<table>
	<tr>
		<td>
		    <div id="gender" style="width: 300px; height: 200px;"></div>
		</td>
		<td>
		    <div id="age" style="width: 300px; height: 200px;"></div>
		</td>
	</tr>

<?php 
	foreach($quizzes as $quiz)
	{
?>
		<script type="text/javascript">
		function drawVisualization() // Create and populate the data table.
		{
			var data = google.visualization.arrayToDataTable
			([
				['Answers', 'Times choosed'],
				['a', 2],
				['b', 3],
				['c', 4],
			]);
      
	        // Create and draw the visualization.
			new google.visualization.PieChart(document.getElementById("quiz<?=$quiz['quiz_id']?>")).
			draw(data,{
				title:"Age distribution",
				titleTextStyle: {fontSize:12},
				chartArea: {width:"80%"},
				is3D:true,
			});
		}
		google.setOnLoadCallback(drawVisualization);
	</script>


	<tr>
		<td>
		    <div id="quiz<?=$quiz['quiz_id']?>" style="width: 300px; height: 200px;"></div>
		</td>
	</tr>
<?
	}
?>

</table>


