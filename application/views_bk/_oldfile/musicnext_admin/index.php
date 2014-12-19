 <? 

	HtmlHeader::print_cms_header();
 
	
	echo get_content_list_table($campaign_arr);
	
	
	//Debug::d($campaign_arr);
	
	
	function get_content_list_table ($campaign_arr) {

		global $LANG,$page;

		$ui.="<table class='sec-table' width='1000px' align=center cellspacing=0 >
		<tr><th width=200px >Campaign</th><th width=200px >Artist</th><th width=100px >Start Date</th><th width=100px >End Date</th><th width=50px >Action</th></tr>";
		//
		
		if (is_array($campaign_arr)) {
			foreach ($campaign_arr as $row) {

				
				$cid=$row['campaign_id'];
				$artist_name=$row['artist_name'];
				$app_url=$row['app_url'];
				$campaign_name=$row['campaign_name'];
				$start_date=date("Y-m-d",strtotime($row['start_date']));
				$expire_date=date("Y-m-d",strtotime($row['expire_date']));
				
		//		$ui.="<div id='".$content_id."_row' >";
				$ui.="<tr><td width=100% colspan=5 height=0 >";
				$ui.="<div id='".$cid."_row' ><table width=100% height=50 border=0  cellspacing=0 cellpadding=0 >";
				$ui.="<tr style='background-color:$bgcolor' id='".$cid."_tr' >";
				$ui.="<td width=200px ><a href='$app_url' target='_blank' >$campaign_name</td>";
				$ui.="<td width=200px >$artist_name </a></td>";
				$ui.="<td  width=100px>$start_date</td><td  width=100px>$end_date</td>";
				//$checked=($row["publish"]==1)?"checked":"";
				$ui.="<td  width=50px >[ <a href='".site_url()."/musicnext_admin/contestant/?campaign_id=$cid'>View</a> ]</td>";
				//$ui.="<td  width=150px >[ <a href='javascript:delete_item($cid)'>X</a> ]</td>";
				$ui.="</tr>";
				$ui.="<tr><td colspan=5><hr></td></tr>";
				$ui.="</table></div>";
				$ui.="</td></tr>";
	
			}
		}

		$ui.="</table>";
		return $ui;
	}

 
 ?>