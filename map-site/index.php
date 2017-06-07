<?php 

require_once("ssi/connection.php"); 
include("ssi/functions.php"); 
require_once("ssi/header.php"); echo "\n"; 
$debug   = $_GET['debug'];

?>


<div id="leftSideBar">

 
 	 <!-- Call the navigation links for the left side of the page -->
   
     <?php 
     
		 // find_selected_pages sets these 2 globals 1-$selectedMenu and 2- $selectedPage
		 // find_selected_page($connection);
	
		 // call the naviagtion function passing the vars set by find_selected_pages 
		 //echo public_navigation($selectedMenu, $selectedPage, $connection);
		 //echo public_navigation($selectedMenu, $selectedPage, $connection);
		 
		 createProductLinks();
		 
	 
	 ?>   
</div>

<div id='mainContent'>
 <h1> Mainframe Automation Project (<span style= "color:#1B3C9F;">MAP</span>)</h1> 
    <p>Welcome to the <span style= "color:#1B3C9F;">MAP</span> Results Server. 
    This site provides access to MAP related resources.
	As more products are migrated to MAP automation their resources can be found here.
	Please send comments and suggestions to: <a href="mailto:scott.barth@asg.com">MAP Team</a>
	</p>
	
</div> 
<?php require("ssi/footer.php"); ?>

