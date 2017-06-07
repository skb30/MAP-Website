<?php ini_set('display_errors', 'On');?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php include("ssi/header.php"); ?>

<div id='leftSideBar'>

	 <!-- Call the navigation links for the left side of the page -->
   
     <?php 
	 // grab the parms from the request
	 // find_selected_pages sets these 2 globals 1-$selectedMenu and 2- $selectedPage
	 // find_selected_page($connection);
	 // call the naviagtion function passing the vars set by find_selected_pages 
	 echo public_navigation($selectedMenu, $selectedPage, $connection);
	 ?>  
	 <ul><li><a href="index.php">Return to Public Site</a></li></ul> 
</div> <!--leftSideBar -->
	 
     
<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <h4> <?php echo "selected page is: " . $selectedPage['menuName']; ?> </h4> 
    <? 
    /*
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
    */
    
     if(isset($_GET['page'])) {
     	 $page = $_GET['page'];
     	 if ($page == 1) {
     	 	get_regression("projcl", "r310", "1st");
     	 } elseif ($page == 2) {
     	 	get_suite("projcl", "r310", "1st", "admin1");
     	 } elseif ($page == 3) {
     	 	get_script("projcl", "r310", "1st", "admin1", "PD1B006");
     	 } elseif ($page == 4) {
     	 	get_run_log("projcl", "r310", "1st", "admin1", "PD1B006");
     	 } elseif ($page == 5) {
     	 	
     	 } else {
     	 	echo "<h3> Page $page not on call stack </h3>";
     	 }
     }

    
    ?>
    
    
    
    
    
    <?php //get_regressions_by_productID('3'); 
    /*
     get_regression("projcl", "r310", "1st"); 
     get_suite("projcl", "r310", "1st", "admin1");
     get_script("projcl", "r310", "1st", "admin1", "PD1B006");
     get_run_log("projcl", "r310", "1st", "admin1", "PD1B006"); 
    */
     ?>
    <!-- 
    <a href="edit-page.php?page=<?php echo $selectedPage['pageID']; ?>&type=page">Edit Page</a>
     -->
    
</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>
