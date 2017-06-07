<?
	ini_set('display_errors', 'On');
	require_once("ssi/connection.php"); 
	include("ssi/functions.php"); 
	include("ssi/header.php"); 
	
	$productID    = $_POST['productID'];
	$product      = $_GET['product'];
	$cmd          = $_GET['cmd'];
	/* set the global debug variable */
	$debug        = $_GET['debug'];

?>

<div id="leftSideBar"><? createProductLinks(); ?> </div>
<div id="mainContent"><? 
	createRegressionsReport($product, $cmd, $productID); ?>
</div>		
<?php require("ssi/footer.php"); ?>


