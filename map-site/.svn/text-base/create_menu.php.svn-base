<?php 
	require_once("ssi/connection.php"); 
	include("ssi/functions.php");
	
	// validate the form 

    // initialize the error array
	$errors = array();
	// init the form fields we want to verify
	$fields = array('menu_name', 'position');
	
	// verify the fields in the array
	foreach($fields as $field) {
		
		if(!isset($_POST[$field]) || empty($_POST[$field])) {
			$errors[] = $field;
		}
	}
	
	$field_lengths = array('menu_name' => 30);
	foreach($field_lengths as $name => $maxlength) {
		if (strlen(trim($_POST[$name])) > $maxlength) {
			$errors[] = $name;
			
		}
	}
	//var_dump($errors);
	if (!empty($errors)) {
		redirect_to("new-menu.php");
	}

	$menu_name = $_POST['menu_name'];
	$position  = $_POST['position'];
	$visible   = $_POST['visible'];
	
	if (empty($errors)) {
		$visible = 1;
	}
	
	
/*
     // need to debug mysql_prep 
	 $menu_name = mysql_prep($_POST['menu_name']);
	 $position  = mysql_prep($_POST['position']);
	 $visible   = mysql_prep($_POST['visible']);
 */
	 
	$query = "INSERT INTO menuItems (
				menuName, position, visible
			  ) VALUES (
			  	'{$menu_name}', {$position}, {$visible}
			)";
	//print $query;
	$result = mysql_query($query,$connection);
	if ($result) {
		// Success! Go back to home page.
		header("Location: index.php");
		exit;
	} else {
		echo "<p> Menu creation failed.</p>\n";
		echo "<p>" . mysql_error() . "</p>";
	}
?>
