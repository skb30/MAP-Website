<?php ini_set('display_errors', 'On');?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php require_once("ssi/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php

	
	$pageID = intval($_GET['page']);
	// make sure we have a good menu id from the post
	if ($pageID == 0) {
		redirect_to("new-menu.php");
	    exit;
	}
	// make sure we have a menu for the ID
	if ($page = get_page_by_id($pageID)) {
		$query = "DELETE FROM pages WHERE pageID = {$pageID} LIMIT 1";
		
		$result = mysql_query($query, $connection);
		if (mysql_affected_rows() == 1) {
			redirect_to("admin.php");
		} else {
			// delete failed
			echo "<p>Page delete failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"admin.php\"> Return to Main</a>";
		}
	} else {
		// menu didn't exist in DB
		redirect_to("index.php");
	}
	
	mysql_close($connection);
?>

