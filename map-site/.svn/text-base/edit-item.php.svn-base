<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php ini_set('display_errors', 'On');?>
<?php confirm_logged_in(); 



    /* get the parms */
	$itemID = $_GET['itemID'];
	$type   = $_GET['type'];
	
	/* validate the ID */
	if ($type == "menu") {
		$id = intval($_GET['itemID']);
	} else {
		$id = intval($_GET['itemID']);
	}
	
 	if(isset($id)) {
	 	/* good ID ? */
		if ($id == 0) {
			redirect_to("index.php");
		    exit;
		}
 	}
	require_once("ssi/header.php");
 
	/* if we got a POST then verify the form fields */
	if (isset($type)) {
		//verify_form_fields ($connection, $type);
		
	} else {
		// produce no type error
	}
?>
<div id='leftSideBar'>	
     <?php
         /* 
          * query the DB to load the form fields using the URL parm
         */
     
     
         //  ************ important note *******************
         // need to update this function before completing this page.
         // I've changed the parms so find_seletecd_page doesn't work anymore
         
		 find_selected_page(); 
		 /* build the navigtion links */
		 echo navigation($selectedMenu, $selectedPage, $connection);
	 ?>   
</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <?php 
        //echo " </ br>";
    	$col      = get_page_by_id($selectedPage["pageID"]);
    	$menuName = $col['menuName'];
		$position = $col['position'];
		$visible  = $col['visible'];
		$menuID   = $col['menuItemID'];
		$content  = $col['content'];
    	echo "<h4> Edit Page: $menuName </h4>\n";
    	if (!empty($message)) {
    		echo "<p id=\"message\">$message <br />\n";
			display_form_errors ($errors);
    		echo "</p>";
    	}
	?>
    <br />
    
    <!--Single page form submission -->
    <form action="edit-item.php?page=<?php echo $pageID;?>" method="post">
    <p>
    	Menu Name:
        <input type="text" name="menu_name" value="<?php echo $menuName; ?>" id="menuName" />
    </p>
    
    <p>
    	Content:
        <input type="text" name="content" value="<?php echo $content; ?>" id="content" />
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
    <input type="submit" name="page" value="Edit Page Item" />
    &nbsp;&nbsp;<a href="delete-menu-item.php?page=<?php echo "$pageID\""; ?> 
    onclick="return confirm('Are you sure')">Delete Page</a>
    </form>
    <br />
    
    <a href="index.php">Cancel</a>
    

</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>
