<?
 	ini_set('display_errors', 'On');
	require_once("ssi/connection.php"); 
 	include("ssi/functions.php"); 
 	include("ssi/header.php"); 
	$suiteID        = $_GET['suiteID'];
	$cmd            = $_GET['cmd'];
    $debug          = $_GET['debug'];
	
	/* get regressionID */
	$regID = getRegressionID($suiteID, $debug);

?>

<div id="leftSideBar"><?php createProductLinks();?></div>

<div id="mainContent"><? createSuiteReport ($suiteID, $cmd);?></div>		

<?php require("ssi/footer.php"); ?>


