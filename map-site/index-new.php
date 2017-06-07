<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php require_once("ssi/header.php"); echo "\n"; ?>
<div id='leftSideBar'>

	 <!-- Call the navigation links for the left side of the page -->
   
     <?php 
     
	 // find_selected_pages sets these 2 globals 1-$selectedMenu and 2- $selectedPage
	 find_selected_page($connection);

	 // call the naviagtion function passing the vars set by find_selected_pages 
	 echo public_navigation($selectedMenu, $selectedPage, $connection);
	 ?>   

    <li><a href="logon.php">MAP Administration</a></li>
    </ul> <!-- the opening ul tag is output in public_navigation -->
  

</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    
    <?php 
    if ($selectedPage) {
	    echo "<h4>" . htmlentities($selectedPage['menuName']) . "</h4>";
		/* only allow some tags and convert new line to br tag */
	    //echo "<p>" . strip_tags(nl2br($selectedPage['content']), "<table><b><br><p><a>") . "</p>";
	    echo "<p>" . ($selectedPage['content']) . "</p>";
	    //echo "<p>" .  htmlentities($selectedPage['content']) . "</p>";
	    /* set selected page for this menu */
	
    
    } else {
    	echo "<h2> Welcome to MAP <h2>";
    }
	?>
</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
