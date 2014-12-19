
<?php

	/*echo '<pre>';
	print_r ($quizzes);
	echo '</pre>'; */
	// */
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


	
<?
	}
?>


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


	<table>
	  <tr>
	  	 <td>
	  	 	<div id="age" style="width: 300px; height: 200px;"></div>
	  	 </td>
	  	 <td>
		    <div id="gender" style="width: 300px; height: 200px;"></div>
		</td>
		<td>
		    <div id="quiz<?=$quiz['quiz_id']?>" style="width: 300px; height: 200px;"></div>
		</td>
	  </tr>

</table>








<table style='text-align:left'>
	<tr><th><u>QUIZ LIST1</u></th><br/>
	
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<th>Quiz Name</th>
           <tr>
           <td><?php echo $quizzes[1]['quiz_name'];?></td>
           	</tr>
           <th>Question name</th>
           <tr>
           	<td><?php echo $quizzes[1]['questions'][0]['question_content'];?></td>
           </tr>
          </table>
         <table style='text-align:left'> 
         <tr>
         	<th>Answers Name</th>
         	<th>&nbsp;</th>
         	<td>&nbsp;</td>
         	<th>Result</th>
         	<th>Result Image</th>
        	<td><?php foreach($quizzes[1]['questions'][0]['answers'] as $quiz)
	{	?>
		<tr>
           	 <td><?php echo $quiz['answer_content'];?></td>
             <td>&nbsp;</td>
			 <td><img src = "../../../upload/<?php echo $quiz['image_url']?>"width="150" height="150"/></td>
              <td><?php 
              		$tmpstr=$this->admin_model->get_result_content($quiz['result_id']);
					echo $tmpstr[0]['result_content'];
				 ?></td>
			  <td><img src ="../../../upload/<?php 
			  $tmpstr=$this->admin_model->get_result_content($quiz['result_id']);
			       echo $tmpstr[0]['result_image_url'];
			  ?>"width="150" height="150"/></td>
		
           </tr>				
<?	}	?>
				
				
        	</td>
         </tr>
         

	
</table>








<?php 
/*Answers
 * 
 *  <th>Answers</th>
           <tr>
           	 <td ><?php echo $quizzes[1]['questions'][0]['answers'][0]['answer_content'];?></td>
           	 <td>&nbsp;</td>
			 <td><img src = "../../../upload/<?php echo $quizzes[1]['questions'][0]['answers'][0]['image_url']?>"width="160" height="160"/></td>
			 <td><?php echo $quizzes[1]['questions'][0]['answers'][0]['result_id'];?></td>
			 <td><?php echo $result[0]['result_content']?></td>
           </tr>
 * 
           <tr>
           	 <td><?php echo $quizzes[1]['questions'][0]['answers'][1]['answer_content'];?></td>
             <td>&nbsp;</td>
			 <td><img src = "../../../upload/<?php echo $quizzes[1]['questions'][0]['answers'][1]['image_url']?>"width="160" height="160"/></td>
             <td><?php echo $quizzes[1]['questions'][0]['answers'][1]['result_id'];?></td>
           </tr>
           <tr>
           	 <td><?php echo $quizzes[1]['questions'][0]['answers'][2]['answer_content'];?></td>
           	 <td> &nbsp;</td>
			 <td><img src = "../../../upload/<?php echo $quizzes[1]['questions'][0]['answers'][2]['image_url']?>"width="160" height="160"/></td>
             <td><?php echo $quizzes[1]['questions'][0]['answers'][2]['result_id'];?></td>
           </tr>
           <tr>
          	 <td><?php echo $quizzes[1]['questions'][0]['answers'][3]['answer_content'];?></td>
          	 <td> &nbsp;</td>
			 <td><img src = "../../../upload/<?php echo $quizzes[1]['questions'][0]['answers'][3]['image_url']?>"width="160" height="160"/></td>
			 <td><?php echo $quizzes[1]['questions'][0]['answers'][3]['result_id'];?></td>
          </tr>
          <tr>
          	 <td><?php echo $quizzes[1]['questions'][0]['answers'][4]['answer_content'];?></td>
          	 <td> &nbsp;</td>
             <td><img src = "../../../upload/<?php echo  $quizzes[1]['questions'][0]['answers'][4]['image_url']?>"width="160" height="160"/></td>
             <td><?php echo $quizzes[1]['questions'][0]['answers'][4]['result_id'];?></td>
          </tr>
          <tr>
          	 <td><?php echo $quizzes[1]['questions'][0]['answers'][5]['answer_content'];?></td>
          	 <td> &nbsp;</td>
             <td><img src = "../../../upload/<?php echo $quizzes[1]['questions'][0]['answers'][5]['image_url']?>"width="160" height="160"/></td>
             <td><?php echo $quizzes[1]['questions'][0]['answers'][5]['result_id'];?></td>
          </tr>
 *  */







































/* The following code is get Image_url path 
 * 	 <td><b>Image_url:</b><?php $image= $quizzes[1]['questions'][0]['answers'][0]['image_url'];
			     echo $image;?></td>*/
 /* <tr><td><img src = "../../../upload/quiz/1/A.png">   </td></tr>*/
 
 
 /*<img src ='<?php HTTP_WEB_SERVER.$quizzes[1]['questions'][0]['answers'][0]['image_url']

******The following code is original show quiz date.
<th>Quiz ID</th>
	<th>Quiz Name</th>
	<th>Creation date</th>
	<th>Created by</th>
<?
	foreach($quizzes as $quiz)
	{	?>
	<tr>
		
		<td><?=$quiz['quiz_id']?></td>
		<td><?=$quiz['quiz_name']?></td>
		<td><?=$quiz['creation_date']?></td>
		<td><?=$quiz['who_last_update']?></td>
		
		
		<td><?=$quiz['questions'][0]['answers'][1]?></td>
	</tr>

	
	
<?	}	?>*/




?>

