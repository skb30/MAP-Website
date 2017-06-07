<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/header.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php 
		confirm_logged_in(); echo "\n";
		$debug   = $_GET['debug'];
?>



 <div id="leftSideBar"><?php createProductLinks();?></div>

<div id='mainContent'>
    <h1> MAP Administration Page</h1>
    <p> Logged in as user: <?php echo "<b>" . $_SESSION['user_name']. "</b>";?> </p>
    <h4>Insert Into Product Table Page</h4>
    <br />
<?php 

	$output  =  "<table border=1>\n";
	$output .= "<tr>";
	$output .= "<td></td>";
	$output .= "<td>Product</td>";
	$output .= "<td>Release</td>";
	$output .= "<td>Visible (0=yes 1=no)</td>";
	$output .= "<td>Notes</td>";
	$output .= "</tr>";
  
	$output .= "<tr>\n";
	$output .= "<form action=\"processTableUpdate.php\" method=\"post\">";
	$output .= "<td><input type=\"submit\" name=\"insert\" value=\"Insert\"</td>\n";
	$output .= "<td><input type=\"text\" name=\"product\" maxlength=\"40\" value=\"{$row["name"]}\"</td>\n";
	$output .= "<td><input type=\"text\" name=\"release\" maxlength=\"40\" value=\"{$row["release"]}\"</td>\n";
	$output .= "<td><input type=\"text\" name=\"visible\" maxlength=\"40\" value=\"{$row["visible"]}\"</td>\n";
	$output .= "<td><input type=\"text\" name=\"notes\" maxlength=\"255\" value=\"{$row["notes"]}\"</td>\n";
	$output .=  "</form>";
	$output .= "</tr>\n";
	
	$output .=  "</table>\n";
	$output .= "</div>\n";
	echo $output;
?>	

</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>


