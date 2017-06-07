<?php ini_set('display_errors', 'On');?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php require_once("ssi/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php

	
	$menuID = intval($_GET['menu']);
	// make sure we have a good menu id from the post
	if ($menuID == 0) {
		redirect_to("new-menu.php");
	    exit;
	}
	// make sure we have a menu for the ID
	if ($menu = get_menu_by_id($menuID)) {
		$query = "DELETE FROM menuItems WHERE menuItemID = {$menuID} LIMIT 1";
		
		$result = mysql_query($query, $connection);
		if (mysql_affected_rows() == 1) {
			redirect_to("admin.php");
		} else {
			// delete failed
			echo "<p>Menu Item delete failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"index.php\"> Return to Main</a>";
		}
	} else {
		// menu didn't exist in DB
		redirect_to("index.php");
	}
	
	mysql_close($connection);
?>

