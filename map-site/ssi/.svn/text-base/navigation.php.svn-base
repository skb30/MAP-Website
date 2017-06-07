
<div id='leftSideBar'>
	
     <?php
	 /*
	  * grab the parm from the request and call the DB and setting either the
	  * selected page or selected menu
	  */
	 if(isset($_GET['menu'])) {
		 $selectedMenu = get_menu_by_id($_GET['menu'], $connection);
		 $selectedPage = NULL;
	 } elseif (isset($_GET['page'])) {
		 $selectedPage = get_page_by_id($_GET['page'], $connection);
		 $selectedMenu = NULL;
	 } else {
		 $selectedPage = NULL;
		 $selectedMenu = NULL;
	 }
	 
	 // fetch the menuItems and their corresponding pages and build the left sidebar 
	 $menuItemSet = get_menuItems($connection);
   
     while ($menuItem = mysql_fetch_array($menuItemSet)) {
		 $bold = isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"]);
		 //echo "{$selectedMenu["menuItemID"]}, {$menuItem["menuItemID"]}";
		 echo "<a $bold href=\"index.php?menu=" .  urlencode($menuItem["menuItemID"]) . "\"> {$menuItem["menuName"]} </a>\n";
		 $pageSet = get_pages_for_menuItems($menuItem, $connection);

		 while ($page = mysql_fetch_array($pageSet)) { 
            $bold = isSeleted ($page["pageID"], $selectedPage["pageID"]); 
		    echo "<li $bold><a href=\"index.php?page=" . urlencode ($page["pageID"]) . "\"> {$page["menuName"]}</a></li>\n";
		 }
	 }
	 /*
	  * build MAP links
	  */
	 ?>   
     
     <a href="new-menu.php">+New Menu</a> 

</div> <!--leftSideBar -->

