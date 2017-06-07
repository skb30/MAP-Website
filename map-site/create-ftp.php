<?
	ini_set('display_errors', 'On');
	require_once("ssi/connection.php"); 
	include("ssi/functions.php"); 
	include("ssi/header.php"); 
	
	$regid = $_GET['regID'];

	$debug   = $_GET['debug'];

?>

<div id="leftSideBar"><? createProductLinks(); ?> </div>
<div id="mainContent"><? createFTPdocument($regid); ?></div>		

<?php require("ssi/footer.php"); ?>


