<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php include("ssi/header.php"); ?>


<div id='leftSideBar'>
	
     <?php
	 // grab the parms from the request
	 if(isset($_GET['menu'])) {
		 $selMenu = $_GET['menu'];
		 $selPage = "";
	 } elseif (isset($_GET['page'])) {
		 $selPage = $_GET['page'];
		 $selMenu = "";
	 } else {
		 $selPage = "";
		 $selMenu = "";
	 }
	 
	 $selectedMenu = get_menu_by_id($selMenu, $connection);
	 
	 // fetch the menuItems and their corresponding pages and build the left sidebar 
	 $menuItemSet = get_menuItems($connection);
     
     while ($menuItem = mysql_fetch_array($menuItemSet)) {
		 $bold = isSeleted ($menuItem["menuItemID"], $selMenu);
		 echo "<a $bold href=\"index.php?menu=" .  urlencode($menuItem["menuItemID"]) . "\"> {$menuItem["menuName"]} </a>";
		 $pageSet = get_pages_for_menuItems($menuItem, $connection);
		 echo "<ul>";
		 while ($page = mysql_fetch_array($pageSet)) {
            $bold = isSeleted ($page["pagesID"], $selPage); 
		    echo "<li $bold><a href=\"index.php?page=" . urlencode ($page["pagesID"]) . "\"> {$page["menuName"]}</a></li>\n";
		 }
		 echo "</ul>";
	 }
	 
	 ?>
<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    
    <?php echo $selectMenu['menuName']; ?> <br />
    <?php echo $selPage; ?> <br />
</div> <!--End main_content -->      


</div> <!--leftSideBar -->

<div id='rightSideBar'><h3>Right Side Links </h3></div>

<?php require("ssi/ssi/footer.php"); ?>
