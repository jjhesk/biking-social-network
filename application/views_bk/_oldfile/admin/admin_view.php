

<script type="text/javascript">
function hide_post_to_wall() 
{
	document.getElementById("post_to_wall").style.display = 'none';
}

function show_post_to_wall() 
{
	document.getElementById("post_to_wall").style.display = 'block';
}
</script>


<p><a target="_blank" href="<?=site_url("admin/users_excel/sort_order/{$sort_direction}/sort_by/{$sort_by}")?>">Export Users to Excel</a></p>

<form method="get" >
	<select name="search_key">
	  <!--<option value="all">All</option>-->
	  <option value="user_name">Name</option>
	  <option value="user_email">Email</option>
	  <option value="user_bday">Birthday</option>
	  <option value="user_likes">Likes</option>
	</select>
	
	<input type="text" name="search_value"/>
	<input type="submit" value="search" />
</form>

<form method="post">

<?php
//	debug($user_details);
	echo create_table_html($user_details, site_url("admin/user_details"), site_url("admin/index"), $sort_by, true);
?>

<?php  if(isset($pagination)) echo $pagination.'<p>';?>
	
<input type="radio" name="admin_action" value="add_to_action_list" onclick="hide_post_to_wall()"  checked="checked"/>Add selected user(s) to action list<br />
<input type="radio" name="admin_action" value="post_to_wall" onclick="show_post_to_wall()" />Directly Post to selected users' facebook wall (Will not work if token is expired)<br />

	<span id='post_to_wall' style="display:none">
	<table>

		<tr>
			<td>Content for the post :</td>
			<td><textarea name="content" cols="64" rows="5" >Share the great news!</textarea><br></td>
		</tr>

		<tr>
			<td>Link for the post :</td>
			<td><textarea name="link" cols="64" rows="1" >http://www.facebook.com</textarea><br></td>
		</tr>

		<tr>
			<td>Name of the link :</td>
			<td><textarea name="name" cols="64" rows="1" >Name of Link</textarea><br></td>
		</tr>

		<tr>
			<td>Caption :</td>
			<td><textarea name="caption" cols="64" rows="1" >My Caption</textarea><br></td>
		</tr>

		<tr>
		<td colspan="2" valign="top">
		Sample for the post :
		<img src="<?=base_url('upload/post_sample.png')?>" />
		</td>
		</tr>

	</table>
	</span>

<input type="radio" name="admin_action" value="remove_user" onclick="hide_post_to_wall()" />Remove selected user<br />
<input type="radio" name="admin_action" value="add_admin" onclick="hide_post_to_wall()" />Promote selected user as adminisrator<br />
<input type="radio" name="admin_action" value="remove_admin" onclick="hide_post_to_wall()" />Remove selected user from administrators<br />

<input type="submit" value="submit"/>

<?
/*	print_r ($user_details);
	foreach($_POST['selected_users'] as $selected_users)
	echo $selected_users;


	foreach( $user_details as $user => $details)
	echo $details['user_fbid'].'<br>';
	echo $user.'<br>';
	echo $details.'<br>'; // */
//	$item_count = count($_POST['buy']);
//	echo $item_count;



?>

</form>

