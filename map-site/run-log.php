<?
	 ini_set('display_errors', 'On');
	 require_once("ssi/connection.php"); 
	 include("ssi/functions.php"); 
	 include("ssi/header.php"); 
	
	 $scriptID     = $_GET['scriptID'];
?>	 
<div id='sidebar'>
	<p><a href="index.php">Return</a></p>
</div>
<? 
	 createRunLog($scriptID); 
	 include("ssi/footer.php");  
 ?>    



