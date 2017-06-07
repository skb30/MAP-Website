
<?
	ini_set('display_errors', 'On');
	require_once("ssi/connection.php"); 
	include("ssi/functions.php"); 
	include("ssi/header.php"); 
    $create_user = false; include("process-user.php");
    confirm_logged_in(); 
	
	$regressionID = $_GET['regID'];
	$cmd          = $_GET['cmd'];
	$debug        = $_GET['debug'];
	$prdID        =  getProductIDByReg ($regressionID); 
	$prdName      =  getProductName ($prdID);
 
?>

<div id="leftSideBar"><?php createProductLinks();?></div>
<div id="mainContent">
<? 

if ($cmd == 1) {
	updateSuitesByRegression ($regressionID, $cmd, $debug);
} elseif ($cmd == 2) {
	createProductDropDownList($regressionID, $cmd, $debug);
} 
?>
</div>	

<div><? //get_regression_by_ID ($regressionID) ?></div>		

<?php require("ssi/footer.php"); ?>


