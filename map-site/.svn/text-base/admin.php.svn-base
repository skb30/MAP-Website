<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php $create_user = false; include("process-user.php") ?>
<?php confirm_logged_in(); 
      $debug   = $_GET['debug'];
?>

<?php require_once("ssi/header.php"); ?>
<script src="./javascript/map-scripts.js"></script>
<div id="leftSideBar"><?php createProductLinks();?></div>

<div id='mainContent'>
    <h1> MAP Administration </h1>
    <h2> Welcome to MAP Administration</h2>
    <p> You are logged in as user <?php echo "<b>" . $_SESSION['user_name']. "</b>";?> </p>
    
    <h4>Select the admin function</h4>
    <form name="admin">
    <select name="navigate">
        <option value="update-product-table.php">Update Products Table</option>
    	<option value="add-product-table.php">Add a Product</a></option>
    	<option value="update-regression-report.php?cmd=2">Update Regressions</option>
    	<option value="create-user.php">Add A User</option>
    	<option value="logoff.php">Logout</option>
    </select>
    <INPUT TYPE="BUTTON" VALUE="Select" onclick="processAdminFunction()">
    </form>
	      
</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
