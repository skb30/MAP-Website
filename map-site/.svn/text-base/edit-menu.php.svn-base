<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
    // Redirect must come before the HTML header is created and
	// no blank lines can proceed. 
	
	// Make sure we have an good int from the GET
 	$menuID = intval($_GET['menu']);
	if ($menuID == 0) {
		redirect_to("new-menu.php");
	    exit;
	}
	require_once("ssi/header.php");
	require_once("ssi/form-functions.php");
 
	/* if we got a POST then verify the form fields */
	if (isset($_POST['submit'])) {
		$field_errors = array();
		$length_errors = array();
		
		/* validate required fields */
		$required_fields = array('menu_name', 'position', 'visible');
	    $field_errors = check_required_fields($required_fields);
   
		/* validate lenght fields */
		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge ($field_errors, check_max_field_length($fields_with_lengths));
		
		/* we got a clean form so let's do the UPDATE to the DB */
		if (empty($errors)) {
			/* passed via URL */
			$menu_id   = $_GET['menu']; 
			/* passed via form */   
			$menu_name = $_POST['menu_name'];
			$position  = $_POST['position'];
			$visible   = $_POST['visible'];
			
			$query = "UPDATE menuItems SET
			           menuName = '{$menu_name}',
			           position = {$position},
			           visible  = {$visible}
			          WHERE menuItemID = {$menu_id}"; 
			$results = mysql_query($query, $connection);
			
			/* determine if the query was able to update the row */
			if (mysql_affected_rows() == 1) {
				$message = "Update Successful.";
			}
			else {
				$message = "Update Failed!";
				$message .= "<br />" . mysql_error();
				$message .= "<br /> sql query: $query";
			}
			
		} else {
			$message = "There were " . count($errors) . " error(s) in the form.\n";
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
	 
	 <li><a href="index.php">Return to Public Site</a></li>
	 </ul>
</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <?php 
      
    	$col      = get_menu_by_id($selectedMenu["menuItemID"]);
    	$menuName = $col['menuName'];
		$position = $col['position'];
		$visible  = $col['visible'];
		$menuID   = $col['menuItemID'];
    	echo "<h4> Edit Menu: $menuName </h4>\n";
    	if (!empty($message)) {
    		echo "<p id=\"message\">$message <br />\n";
			if (!empty($errors)) {
				display_form_errors ($errors);
			}
    		echo "</p>";
    	}
	?>
    <br />
    
    <!--Single page form submission -->
    <form action="edit-menu.php?menu=<?php echo $menuID;?>" method="post">
    <p>
    	Menu Name:
        <input type="text" name="menu_name" value="<?php echo $menuName; ?>" id="menuName" />
    </p>
    <p> Position:
    	<select name="position">
         <?php 
			$menuSet = get_menuItems($connection);
			$numOfMenus = mysql_num_rows($menuSet);
			
			for ($count = 1; $count <= $numOfMenus + 1; $count++) {	
				echo "<option value={$count}";
			    if ($count == $position ) {
					echo " selected";
				}
				echo ">{$count}</option>\n";
			}
			
		?>
         </select>
        
    </p>
    <p> Visible:

        <input type="radio" name="visible" value="0" 
        <?php if ($visible == 0) { echo " checked"; } ?>
        /> No
		
        <input type="radio" name="visible" value="1"
        <?php if ($visible == 1) { echo " checked"; } ?>
        /> Yes 
    </p>
    <input type="submit" name="submit" value="Edit Menu Item" />
    &nbsp;&nbsp;<a href="delete-menu-item.php?menu=<?php echo "$menuID\""; ?> 
    onclick="return confirm('Are you sure')">Delete Menu Item</a>
    &nbsp;&nbsp;<a href="new-page.php?menu=<?php echo "$menuID\""; ?> ">Add Page</a>
    
    </form>
    <br />
    
    <a href="index.php">Cancel</a>
    

</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>
