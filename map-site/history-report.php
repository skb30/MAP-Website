<?
 	ini_set('display_errors', 'On');
	require_once("ssi/connection.php"); 
 	include("ssi/functions.php"); 
 	include("ssi/header.php"); 
	$script   = $_GET['script'];
	$product  = $_GET['product'];
	$suiteID  = $_GET['suiteID'];
	

	$suiteName = getSuiteName($suiteID);
	

?>
<div id="leftSideBar"> <?php createProductLinks();?>   </div>
<div id="mainContent"><?php $regID = createHistoryReport ($script, $product);?></div>		

<?php require("ssi/footer.php"); ?>


