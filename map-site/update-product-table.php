<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/header.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php 
		confirm_logged_in(); echo "\n";
		$debug   = $_GET['debug'];
?>

<div id="leftSideBar"><?php createProductLinks();?></div>
<?php 

     
	$productSet = getProducts($connection,$public);
	$numOfProducts = mysql_num_rows($productSet);
?>	
<div id='mainContent'>
    <h1>Update Product Table</h1>
    <p> Logged in as user: <?php echo "<b>" . $_SESSION['user_name']. "</b>";?> </p>
    <h4>Product Table Contents (<?php echo $numOfProducts;?>)</h4>
    <br />
<?php     
//	$productSet = getProducts($connection,$public);
//	$numOfProducts = mysql_num_rows($productSet);
	
	$cnt = 0;
	
	$output  =  "<table border=1 id=\"productTbl\">\n";
	$output .= "<tr>";
	$output .= "<td></td>";
	$output .= "<td></td>";
	$output .= "<td>Product Name</td>";
	$output .= "<td>Release</td>";
	$output .= "<td>Visible?</td>";
	$output .= "<td>Notes</td>";
	$output .= "</tr>";
   
	while ($row = mysql_fetch_array($productSet)) {
		$cnt++;
		$output .= "<tr>\n";
		$output .= "<form action=\"processTableUpdate.php\" method=\"post\">";
//		$output .= "<td><input type=\"checkbox\" name=\"check_box$cnt\" value=\"select\" </td>\n";
		$output .= "<td><input type=\"submit\" name=\"usubmit\" value=\"Update\"</td>\n";
		$output .=  "<input type=\"hidden\" name=\"offset\" value=\"$cnt\" />";
		$output .=  "<input type=\"hidden\" name=\"id\" value=\"{$row["productID"]}\" />";
		$output .= "<td><input type=\"button\" onclick=\"verifyDelete('{$row["name"]}','{$row["release"]}','{$row["productID"]}')\" name=\"dsubmit\" value=\"Delete\"  </td>\n";
		$output .= "<td><input type=\"text\" name=\"product\" maxlength=\"40\" value=\"{$row["name"]}\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"release\" maxlength=\"40\" value=\"{$row["release"]}\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"visible\" maxlength=\"40\" value=\"{$row["visible"]}\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"notes\" maxlength=\"255\" value=\"{$row["notes"]}\"></td>\n";
		$output .=  "</form>";
		$output .= "</tr>\n";
	}
	$output .=  "</table>\n";
	$output .= "</div>\n";
	echo $output;
?>	

</div> <!--End main_content --> 

<?php require("ssi/footer.php"); ?>



