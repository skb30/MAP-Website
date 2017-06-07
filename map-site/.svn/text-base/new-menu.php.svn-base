<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/header.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php confirm_logged_in(); echo "\n";?>
<div id='leftSideBar'>	
     <?php
		 find_selected_page($connection); 
		 echo navigation($selectedMenu, $selectedPage, $connection);
	 ?> 
	  <a href="index.php">Return to Public Site</a>
 
</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> MAP Administration </h1>
    <p> Logged in as user: <?php echo "<b>" . $_SESSION['user_name']. "</b>";?> </p>
    <h4>Add  a menu item to the sidebar naviagation</h4>
    <br />
    

    <form action="create_menu.php" method="post">
    <p>
    	Menu Name:
        <input type="text" name="menu_name" value="" id="menuName" />
    </p>
    <p> Position:
    	<select name="position">
        <?php 
			$menuSet = get_menuItems($connection);
			$numOfMenus = mysql_num_rows($menuSet);
			
			for ($count = 1; $count <= $numOfMenus + 1; $count++) {	
				echo "<option value=\"$count\">$count</option>";
			}
		?>	
        </select>
    </p>
    <p> Visible:
        <input type="radio" name="visible" value="0"/> No
        &nbsp;
        <input type="radio" name="visible" value="1"/> Yes
    </p>
    <input type="submit" value="Add Menu Item" />
    </form>
    <br />
    
    <a href="index.php">Cancel</a>
    

</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
