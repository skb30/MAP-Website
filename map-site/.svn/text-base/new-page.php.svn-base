<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php ini_set('display_errors', 'On');?>
<?php confirm_logged_in(); ?>

<?php 
$menuID = intval($_GET['menu']);
	if ($menuID == 0) {
		redirect_to("index.php");
	    exit;
	}
	
	require_once("ssi/header.php");
 
	/* if we got a POST then verify the form fields */
	if (isset($_POST['submit'])) {
		$errors = array();
		$required_fields = array('page_name', 'position', 'visible', 'content');
		foreach ($required_fields as $fieldName) {
			if (!isset($_POST[$fieldName]) || (empty($_POST[$fieldName])  && !is_numeric($_POST[$fieldName]))) {
				$errors[] = $fieldName;
			}
		}
		$fields_with_lengths = array('page_name' => 30);
		foreach ($fields_with_lengths as $fieldname => $maxlength) {
			if (strlen(trim($_POST[$fieldname])) > $maxlength) {
				$errors[] = $fieldname;
			}
		}
		/* we got a clean form so let's do the UPDATE to the DB */
		if (empty($errors)) {
			
			
			/* passed via URL */
			$page_id   = $_GET['page']; 
			/* passed via form */   
			$page_name = $_POST['page_name'];
			$position  = $_POST['position'];
			$visible   = $_POST['visible'];
			$content   = $_POST['content'];
		
			$query = "INSERT INTO pages (
			           menuItemID,
			           menuName,
			           position,
			           visiblE, 
			           content 
			           )
			          VALUES ({$menuID}, '{$page_name}', {$position}, {$visible}, '{$content}');";
			
			
			$results = mysql_query($query, $connection);
			if ($result) {
				$message = "Update Successful.";
			} else {
				$message = "Update Failed:(";
				$message .= "<br />" . mysql_error();
				$message .= "<br /> sql query: $query";
			}
			
		} else {
			$message = "There were " . count($errors) . " error(s) in the form.\n";
			echo "$message <br />\n";
			
			foreach ($errors as $error) {
				echo "$error <br />\n";
				
			}
		}
	}

?>


<div id='leftSideBar'>	
     <?php
		 find_selected_page($connection); 
		 echo navigation($selectedMenu, $selectedPage, $connection);
	 ?>   
</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <?php 
    	$id       = $selectedMenu["menuItemID"];
    	$col      = get_menu_by_id($id);
    	$menuName = $col['menuName'];
    
    ?>
    <h4>Add  a page to menu item <?php echo $menuName;  ?></h4>
    <br />
    

    <form action="new-page.php?menu=<?php echo $id;  ?>" method="post">
    <?php $new_page = true;?>
    <?php include "page-form.php"?>

    <input type="submit" name="submit" value="Add Page" /> 
    </form>
    <br />
    
    <a href="index.php">Cancel</a>
    

</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
