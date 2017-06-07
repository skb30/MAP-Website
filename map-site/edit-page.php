<?php ini_set('display_errors', 'On');?>
<?php require_once("ssi/session.php"); ?>
<?php include_once("ssi/functions.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php confirm_logged_in(); ?>

<?php
    // Redirect must come before the HTML header is created and
	// no blank lines can proceed. 
	
	// Make sure we have an good int from the GET
 	$pageID = intval($_GET['page']);
	if ($pageID == 0) {
		redirect_to("index.php");
	    exit;
	}
	require_once("ssi/header.php");
	require_once("ssi/form-functions.php");
 
	/* if we got a POST from this form then verify the form fields */
	if (isset($_POST['submit'])) {
		$field_errors  = array();
		$length_errors = array();
		
		/* validate required fields */
		$required_fields = array('page_name', 'position', 'visible', 'content');
	    $field_errors = check_required_fields($required_fields);
   
		/* validate lenght fields */
		$fields_with_lengths = array('page_name' => 30);
		/* merge the errors into one array */
		$errors = array_merge ($field_errors, check_max_field_length($fields_with_lengths));
		
		/* passed via URL */
		$page_id   = $_GET['page']; 
		/* passed via form */   
		$menu_name = trim($_POST['page_name']);
		$position  = $_POST['position'];
		$visible   = $_POST['visible'];
		$content   = $_POST['content'];
		
		/* if we don't have any errors on the form then update the  DB */
		if (empty($errors)) {
			$query = "UPDATE pages SET
				           menuName    = '{$menu_name}',
				           position    = {$position},
				           visible     = {$visible},
				           content     = '{$content}'
			          WHERE pageID = {$page_id}"; 
			
			$results = mysql_query($query, $connection);
			//echo "results: $results<br />\n";
			
			/* determine if the query was able to update the table */
			if (mysql_affected_rows() == 1) {
				$message = "Update Successful.";
			}
			else {
				$message = "Update Failed!";
				$message .= "<br />" . mysql_error();
				$message .= "<br /> sql query: $query";
			}
			
		} else {
			if (count($errors) == 1) {
				$message = "There was an error in the form.\n";
				display_form_errors ($errors);
			} else {
				$message = "There were " . count($errors) . " errors in the form.\n";
				display_form_errors ($errors);
			}
		}
		
	}
?>
<div id='leftSideBar'>	
     <?php
         /* 
          * query the DB to load the form fields using the URL parm
         */
		 find_selected_page($connection); 
		 /* build the navigtion links */
		 echo navigation($selectedMenu, $selectedPage, $connection);
		 
	 ?> 
	 <a href="index.php">Return to Public Site</a>   
</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <?php 
        if (!empty($message)) {
    	echo "<p id=\"message\">$message <br />\n";
		if (!empty($errors)) {
			display_form_errors ($errors);
		}
    	echo "</p>";
    	}
    ?>	

    <!--Single page form submission -->
    <form action="edit-page.php?page=<?php echo $pageID;?>" method="post">
    <?php include "page-form.php"?>
    <input type="submit" name="submit" value="Update Page" />
    &nbsp;&nbsp;<a href="delete-page.php?page=<?php echo "$pageID\""; ?> 
    onclick="return confirm('Are you sure')">Delete Page</a>
    </form>
    <br />
    <a href="index.php">Cancel</a>
</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>
