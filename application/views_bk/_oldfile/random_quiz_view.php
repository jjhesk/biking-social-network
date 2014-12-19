
<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	echo '<pre>';
	print_r($question);
	echo create_table_html($question);
	echo '</pre>';
?>

<form method="post" >

<?php 
	$i=1;
	$answers = array();
	foreach($question as $item) {
		$ans[0]	= $item['answer'];
		$ans[1]	= $item['fake_answer_1'];
		$ans[2]	= $item['fake_answer_2'];
		$ans[3]	= $item['fake_answer_3'];
?>

<b><?php echo $i++; ?>. <?=$item['question']?></b>
<p>

<?php 
	$question_order = array(0, 1, 2, 3);
	shuffle($question_order);
	$j=0;
	foreach($question_order as $number) {

		if($number == 0)	//save answer to array
			$answers[]=$j;

?>
<input type="radio" name="a[]" value="<?=$j++?>"> <?=$ans[$number]?> <br>

<?php } ?>
<hr>

<?php } 

	$this->session->set_flashdata('answers', $answers);

?>

<input type="submit"/>


</form>



$this->session->set_flashdata('item', 'value');

$this->session->flashdata('item');

$this->session->keep_flashdata('item');