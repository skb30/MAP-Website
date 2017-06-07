<?php require_once("ssi/header.php"); ?>
<?php require_once("ssi/session.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php require_once("ssi/form-functions.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<script src="./javascript/map-scripts.js"></script>

<?php  
	//print_r($_POST);

    $update       = $_POST['submit'];
    $delete       = $_GET['delete'];
    $verUpdate    = $_GET['updateVer']; 
    $updateReg    = $_GET['updateReg'];
    
    if ($verUpdate) {
    	$subsysID  = $_GET['id'];
    	$suiteID   = $_GET['suiteID'];
    	$regID     = $_GET['regID'];
    	$rc = setRegVersion ($connection, $subsysID, $suiteID); 
    	if ($rc == 1) {
    		redirect_to("regression-report.php?regID=$regID&cmd=1");
    	}
		return;
    }
    /*
     * Called by regression-update-list.php/map-script.js 
     * 
     */
    if ($updateReg) {
    	$regID  = $_GET['regID'];
    	$osID   = $_GET['osID'];
    	$lparID = $_GET['lparID'];
    	$subID  = $_GET['subID'];

    	//echo "regID: $regID </br> osID: $osID </br>lparID: $lparID";
    	/* update regression table with values selected by the user */
    	
    	
    	/* setReression will redirect to all-regressions.php */
    	setRegression ($connection, $regID, $osID, $lparID, $subID);
    	return;
    }
    /*
     * the delete function is performed via javascript.js allows me to prompt the user before
     * deleting. The reason the GET is used instead of the POST is because the jscript passes 
     * the id via url. 
     * 
     * See jscript verifyDelete 
     */
    
    
    $insert       = $_POST['insert'];

    /* get the form vars */
	$index        = trim($_POST['offset']);
	$primaryKey   = trim($_POST['id']);
	$name    	  = trim($_POST['product']);
	$rel          = trim($_POST['release']);
	$vis          = trim($_POST['visible']);
	$notes        = trim($_POST['notes']);
	
	
	/* make a copy for validation */ 
	$orgRel   = $rel;
	$orgName  = $name;
	$orgVis   = $vis;
	$orgNotes = $notes;
		
	/* pull the values out of the post array */
	 if (isset($update)) {
	    $id      = trim($_POST['id']);
	 	$name    = trim($_POST['product']);
		$rel     = trim($_POST['release']);
		$vis     = trim($_POST['visible']);
		$notes   = trim($_POST['notes']);
		
		/*
		 * check to see if there were any updates.
		 * If not, no need to go to the DB. 
		 */
		//if ($name == $orgName && $rel == $orgRel && $vis == $orgVis && $notes == $orgNotes) { redirect_to("update-product-table.php");}
		
	 	$result  = updateTable($connection, $id, $name, $rel, $vis, $notes);
	    if ($result == 1) {
	    	redirect_to("update-product-table.php");
	    }
	 } elseif (isset($delete)) {
	 	echo  "<div><input type=\"button\" onclick=\"verifyCancel()\" name=\"Cancel\" value=\"Cancel\"> </div>";
	 	
	 	$id      = trim($_POST['id']);
	 	/* the id was passed via jscript */
	 	$conformation = trim($_GET['id']);
	 	if($conformation) {
	 		$result  = deleteFromTable($connection, 'product', $conformation);
	 		
		 	if ($result == 1) {
		 		redirect_to("update-product-table.php");
	 		}
	 	}	
	 } elseif (isset($insert)) {
	 	
	 	$id = insertProduct($connection,$name,$rel,$vis,$notes);
	 	echo "hit insert<br />";
	 	return;
	 }
	 else  {
	 	/*
	 	 * build the process form with the values from the update-product-table. 
		 * The user can change them on this form and after clicking the  
		 * submit button the update will be processed. 
		*/
		$output .= "<h4>Update Panel Key: $primaryKey</h4>\n";
		$output .= "<table border=1>\n";
		$output .= "<tr>\n";
		$output .= "<td>Product Name</td>\n";
		$output .= "<td>Release</td>\n";
		$output .= "<td>Visible</td>\n";
		$output .=    "<td>Notes</td>\n";
		$output .= "</tr>\n";
		
 
		$output .= "<form action=\"processTableUpdate.php\" method=\"post\">\n";
		$output .= "<tr>\n";
		$output .= "<td><input type=\"text\" name=\"product\" maxlength=\"40\" value=\"$name\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"release\" maxlength=\"40\" value=\"$rel\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"visible\" maxlength=\"1\" value=\"$vis\"></td>\n";
		$output .= "<td><input type=\"text\" name=\"notes\" maxlength=\"255\" value=\"$notes\"></td>\n";
		$output .= "<input type=\"hidden\" name=\"id\" value=\"$primaryKey\>\n";
		$output .= "<input type=\"hidden\" name=\"update\" value=\"$primaryKey\">\n";
		$output .= "<td><input type=\"button\" onClick=\"cancelUpdate()\" name=\"Cancel\" value=\"Cancel\"></td>\n";
		$output .= "<td><input type=\"submit\" name=\"submit\" value=\"submit\"></td>\n";
		$output .= "</tr>\n";
		$output .=  "</form>\n";

		
	 }
		
	echo $output;
?>
