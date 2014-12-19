 <? 
 //$params["test"]="Test";
 //$loginUrl = $this->my_class_test->test($params["test"]); 
	
	HtmlHeader::print_cms_header();

	echo get_content_list_table($user_arr, $campaign);
	
	
	
	function get_content_list_table ($user_arr ,$campaign) {

		global $LANG,$page;
		$colspan=8;
		
		$ui.="<table class='sec-table' width='1000px' align=center cellspacing=0 >
		<tr><td colspan=$colspan style='text-align:center'><h2>$campaign[campaign_name] </h2></td></tr>
		<tr><th width=100px >youtube</th><th width=200px >Name</th><th width=50px >gender</th>
		<th width=50px >facebook</th><th width=100px >Upload Date</th>
		<th width=50px >score</th><th width=50px >publish</th><th width=150px >Action</th></tr>";

		$id_arr=array();
		if (is_array($user_arr)) {
			//$ui.="<form action='cms_action.php' method='POST' >";
			//$ui.="<input type=hidden name=product_action value='update_catalog' >";
			foreach ($user_arr as $row) {

				$cid=$row['user_campaign_data_id'];
				$user_name=$row['user_name'];
				$user_email=$row['user_email'];
				$gender=$row['user_gender'];
				$upload_date=(strstr("0000",$row['create_date']))?date("Y-m-d H:i",strtotime($row['create_date'])):"";
				$youtube_vid=$row['youtube_vid'];
				$score=$row['score'];
				$fid=$row['user_fbid'];
				$id_arr[]=$cid;
				$bgcolor=($row["publish"]==1)?"":"#dddddd";
				
		//		$ui.="<div id='".$content_id."_row' >";
				$ui.="<tr><td width=100% colspan=$colspan height=0 >";
				$ui.="<div id='".$cid."_row' ><table width=100% height=50 border=0  cellspacing=0 cellpadding=0 >";
				$ui.="<tr style='background-color:$bgcolor' id='".$cid."_tr' >";
				$ui.="<td  width=100px><a href='http://www.youtube.com/watch?v=$youtube_vid' target='_blank' ><img src='http://img.youtube.com/vi/$youtube_vid/1.jpg' height=60 ></a></td>";
				$ui.="<td width=200px >$user_name</td>";
				$ui.="<td width=50px >$gender</td>";
				$ui.="<td  width=50px><a href='http://www.facebook.com/profile.php?id=$fid' target='_blank' >open</a></td>";
				$ui.="<td  width=100px>$upload_date</td>";
				$ui.="<td width=50px ><input type='text' class='text' name='".$cid."_field' id='".$cid."_field' value='$score'  style='width:30px' maxlength=3 onkeyup='javascript:update_score($cid, this.value, event );' > </b></a></td>";
				$checked=($row["publish"]==1)?"checked":"";
				$ui.="<td width=50px style='text-align:center' > <input id='".$cid."_published'  name='".$cid."_published' type='checkbox' $checked onclick='update_published($cid)'  ></td>";
				$ui.="<td  width=150px >[ <a href='mailto:$user_email'>email</a> ] 
				[ <a href='javascript:update_winner($cid,1)' > add winner </a> ] [ <a href='javascript:delete_item($cid)'>X</a> ] </td>";
				$ui.="</tr>";
				$ui.="<tr><td colspan=$colspan ><hr></td></tr>";
				$ui.="</table></div>";
				$ui.="</td></tr>";
	
			}
			if($id_arr) 
				$id_str=implode(",",$id_arr);
			//$ui.="<input type=hidden name='ids' value='$id_str'  ";
			//$ui.="<tr><td colspan=$colspan align=right style='text-align:right' ><input type='submit' value='Update' style='width:150px' class='button' > </td></tr>";
			//$ui.="</form>";
		}

		$ui.="</table>";
		return $ui;
	}

 
 ?>