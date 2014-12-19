


<p>
	If you have added your users onto the action list, choose a corresponding action on the submenu such as post to wall or email.
	The action will be marked and performed on the backend.
</p>

<form method="post">
	<input type="submit" name="clear_list" value="Clear List"/>
</form>

<?php
	//echo create_table_html($user_details, site_url("admin/user_details"), site_url("admin/index"), $sort_by, true);
	echo create_table_html($user_details);
?>


