<?php
$debug = 0;

		// var_dump($regressions);
		// echo count($regressions) . "<br />";

// This file is the place to store all basic PHP functions
function mysql_prep($value) {
	// allow for quotes in strings
	$magic_quotes_active = get_magic_quotes_gpc();
	$php_version = function_exists("mysql_real_escape_string");
	if ($php_version) {
		if ($magic_quotes_active) {
			$value = stripslashes( $value );
		}
	} else {
		if ( !$magic_quotes_active) {
			$value = addslashes($value);
		}
	}
	 
	print "value: $value <br />";
	return $value;
}
function confirm_query($result_set) {
	if (!$result_set) {
		die ("confirm_query - Database selection failed: " . mysql_error());
	}

}

function get_menuItems($connection, $public) {

	$query = "SELECT *
	 	       FROM menuItems ";
	if ($public) {
		$query .= "WHERE visible = 1 ";
	}
	$query .= "ORDER BY position ASC";
	//echo "get_menuItems sql: $query <br />";
	$menuItemSet = mysql_query($query, $connection);
	confirm_query($menuItemSet);
	return $menuItemSet;
}

function getProducts($connection, $public) {

	global $debug;

	$query  = "SELECT * FROM product ";
	$query .= "ORDER BY product.name, product.release ASC ";
	/*
	if ($public) {
		$query .= "WHERE visible = 1 ";
	}
	*/
    if ($debug) {
		echo "<p> get_products Query: $query</p>\n";
	}
	//echo "get_menuItems sql: $query <br />";
	$productSet = mysql_query($query, $connection);
	confirm_query($productSet);
	return $productSet;
}

function updateTable($connection, $key, $name, $rel, $vis, $notes) {

	global $debug;

	$query  = "UPDATE product "; 
	$query .= "SET product.name = '$name' , ";
	$query .= "product.release  = '$rel',  ";
	$query .= "product.visible  = '$vis',  ";
	$query .= "product.notes    = '$notes'  ";
	$query .= "WHERE product.productID = '$key';";


    if ($debug) {
		echo "<p> updateProductTable: $query</p>\n";
	}
	$result = mysql_query($query, $connection);
	if ($result) {
		return 1;
	} else {
		echo "<p> Update Failed: $query.</p>\n";
		echo "<p>" . mysql_error() . "</p>";
	}
}

function deleteFromTable($connection, $table, $id) {

	global $debug;
	$query  = "DELETE FROM $table "; 
	$query .= "WHERE $table" ."ID" . " = '$id'; ";

//	echo "<p> $query</p>\n";


	$result = mysql_query($query, $connection);
	confirm_query($result);
	echo "result = $result";
	return $result;
}

function insertProduct($connection, $name, $rel, $vis, $notes) {

	global $debug;
	$query  = "INSERT INTO product (product.name, product.release, product.notes, product.visible) ";
	$query .= "VALUES ('{$name}', '{$rel}', '{$notes}', '{$vis}'); ";

	echo "<p> $query</p>\n";
	$result = mysql_query($query, $connection);
	if ($result) {
		// Success! Go back to home page.
		header("Location: update-product-table.php");
		exit;
	} else {
		echo "<p> Product INSERT failed: $query</p>\n";
		echo "<p>" . mysql_error() . "</p>";
	}
}
function get_pages_for_menuItems ($menuItem, $connection, $public) {
	$query = "SELECT *
	FROM pages WHERE menuItemID = {$menuItem["menuItemID"]} ";
	/* if its public nav then check to see if visible is set before
	 * displaying.
	 */
	if ($public) {
		$query .= "AND visible = 1 ";
	}

	$query .= "ORDER BY position ASC";
		
	$pageSet = mysql_query($query, $connection);
	//echo "pageSet: $query";
	confirm_query($pageSet);
	return $pageSet;
}
function get_pages_by_menuID ($menuItem, $connection) {
	
	$query = "SELECT *
	FROM pages WHERE menuItemID = $menuItem
	ORDER BY position ASC";
		
	$pageSet = mysql_query($query, $connection);
	//echo "pageSet: $query";
	confirm_query($pageSet);
	return $pageSet;
}
function isSeleted ($page, $selPage) {
	if ($page == $selPage) {
		$boldClass = "class=\"selected\"";
	} else {
		$boldClass = "";
	}

	return $boldClass;

}

function  get_menu_by_id($selMenu) {

	$query  = "SELECT * ";
	$query .= "FROM menuItems ";
	$query .= "WHERE menuItemID= " . $selMenu . " ";
	$query .= "LIMIT 1";

	//echo "get_menu_by_id sql: $query<br />\n";
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return fales
	if ($menu = mysql_fetch_array($resultSet)) {
		return $menu;
	}
	else {
		return NULL;
	}

}
function createProductLinks (){
	
	global $debug;

//	$query  = "SELECT name, productID ";
	$query  = "SELECT DISTINCT name ";
	$query .= "FROM product ";
	$query .= "WHERE visible = 1 ORDER BY name ASC";
   

	//echo "get_products: $query<br />\n";
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false
	
    
	if ($debug) {
		echo "<ul><li> createProductLinks()</li></ul>\n";
	}

	$output .= "<h1>Regression Reports:</h1>\n";
	$output .= "<ul>\n";
	
	// each row
	while ($product = mysql_fetch_array($resultSet)) {
			
		$output .= "<li><a href=\"all-regressions.php?product="
		. urlencode ($product["name"]) . "&cmd=1" .
				   "\"> {$product["name"]}
		</a></li>\n";
	}
	$output .= "</ul>\n";
    
	echo $output;
    ?>
    <div class="clear">&nbsp;</div>
	<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);"> 
    <? 
}

function getSuiteName ($suiteID){

	$query  = "SELECT name ";
	$query .= "FROM suite ";
	$query .= "WHERE suiteID = '{$suiteID}' ";


    global $debug;
	if ($debug) {
		echo "getSuiteName ($suiteID)</p><p>$query</p>\n";
	}
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$suiteName = $row["name"];

	if ($suiteName == '0E0') {
			
		echo "suiteName not found for suiteID $suiteID<br />";
	}
	return $suiteName;
}
function getRegressionName ($regressionID){

	$query  = "SELECT name ";
	$query .= "FROM regression ";
	$query .= "WHERE regressionID = '{$regressionID}' ";

    global $debug;
	if ($debug) {
		echo "<p>getRegressionName ($regressionID)</p><p>$query</p>\n";
	}
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$regressionID = $row["name"];

	if ($regressionID == '0E0') {
			
		echo "Regression Name not found for regressionID $regressionID<br />";
	}
	return $regressionID;
}
function getProductName ($productID){

	$query  = "SELECT name ";
	$query .= "FROM product ";
	$query .= "WHERE productID = '{$productID}' ";


    global $debug;
	if ($debug) {
		echo "<p>getProductName ($productID)</p><p>$query</p>\n";
	}
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$productName = $row["name"];

	if ($productName == '0E0') {
			
		echo "Product Name not found for product with ID:  $productID<br />";
	}
	return $productName;
}

function getRegressionID ($suiteID){
	
	global $debug;

	$query  = "SELECT regressionID ";
	$query .= "FROM suite ";
	$query .= "WHERE suiteID = '{$suiteID}' ";
	
   global $debug;
	if ($debug) {
		echo "<p>getRegressionID ($suiteID)</p><p>$query</p>\n";
	}

	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$regressionID = $row["regressionID"];

	if ($regressionID == '0E0') {
			
		echo "regressionID not found for $regressionID<br />";
	}
	return $regressionID;
}


function getRegressionsByProduct ($prodName){
	
	global $debug;

	$query  = "SELECT regressionID ";
	$query .= "FROM suite ";
	$query .= "WHERE suiteID = '{$suiteID}' ";
	
   global $debug;
	if ($debug) {
		echo "<p>getRegressionID ($suiteID)</p><p>$query</p>\n";
	}

	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$regressionID = $row["regressionID"];

	if ($regressionID == '0E0') {
			
		echo "regressionID not found for $regressionID<br />";
	}
	return $regressionID;
}

function getRegressionIDByScriptID ($scriptID){
    global $debug;
	$query  = "SELECT regression.regressionID ";
	$query .= "FROM suite, script, regression ";
	$query .= "WHERE script.scriptID = '{$scriptID}' ";
	$query .= "AND suite.suiteID = script.suiteID  ";
	$query .= "AND suite.regressionID = regression.regressionID  ";
     
	if ($debug) {
		echo "<p> getRegressionIDByScriptID ($scriptID)</p><p>$query</p>\n";
	}
	
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$regressionID = $row["regressionID"];

	if ($regressionID == '0E0') {
			
		echo "regressionID not found for $regressionID<br />";
	}
	if ($debug) {
		echo "<p> $regressionID = getRegressionIDByScriptID ($scriptID)</p>\n";
	}
	return $regressionID;
}


function getProductIDByScriptID ($scriptID){
	global $debug;

	$query .= "SELECT product.productID ";
	$query .= "FROM   regression,  product, suite, script ";
	$query .= "WHERE  regression.productID     = product.productID ";
	$query .= "AND    regression.regressionID  = suite.regressionID ";
    $query .= "AND    suite.suiteID            = script.suiteID ";
	$query .= "AND    script.scriptID          = '{$scriptID}'";
	if ($debug) {
		echo "<p> getProductIDByScriptID ($scriptID)</p><p>$query</p>\n";
	}
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$productID = $row["productID"];

	if ($productID == '0E0') {
			
		echo "productID not found for release with ID of: $releaseID<br />";
	}
	return $productID;
}
function getProductIDByReg ($regID){
	
	
	global $debug;

	$query  = "SELECT product.productID ";
	$query .= "FROM regression, product ";
	$query .= "WHERE regression.productID = product.productID ";
	$query .= "AND regression.regressionID = '{$regID}' ";
	if ($debug) {
		echo "<p> getProductIDByReg ($regID)</p><p>$query</p>\n";
	}
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$productID = $row["productID"];

	if ($productID == '0E0') {
			
		echo "productID not found for regression with ID of: $regID<br />";
	}
	return $productID;
}
function getSuiteIDByScriptID($scriptID) {
	
	global $debug;

	
	$query  = "SELECT suiteID ";
	$query .= "FROM script ";
	$query .= "WHERE scriptID = '{$scriptID}' ";
	
	if ($debug) {
		echo "<p> getSuiteIDByScriptID($scriptID)</p><p>$query</p>\n";
	}
	$resultSet = executeQuery($query);
	
	
	

	// if no rows are returned, fetch_array will return false

	// each row
	$row = mysql_fetch_array($resultSet);
	$suiteID = $row["suiteID"];

	if ($suiteID == '0E0') {
			
		echo "suiteID not found in scritps table with a scriptID of: $scirptID<br />";
	}
	return $suiteID;
}

function executeQuery($query) {
	global $debug;
	if ($debug) {
		echo "<p> executeQuery($query)</p>\n";
	}
	
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	return $resultSet;
	
}
function createFileList($resultSet, $id, $folderName, $cmd) {
	
	
	$num_rows = mysql_num_rows($resultSet);
	/* Check for expected files. If there aren't any then tell the user */
	$output = "<table class=\"display_table\">\n";
	if ($num_rows == 0) {
		$output .= "<tr class=\"tableheading\"><th>No $folderName files found. </th></tr>\n";
	} else {
		$output .= "<tr class=\"tableheading\"><th>$folderName Files List: </th></tr>\n";
	
		/* stripe the report with blue/green rows */
		$i = 0;
		while ($row = mysql_fetch_array($resultSet)) {
			if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
			$output .= "<td>\n";
			$output .= "<a href=display-text-data.php?&cmd=$cmd";
			$output .= "&id=$id";
			$output .= "&type=list";
			$output .= "&name={$row["name"]}>";
			$output .= "{$row["name"]}</a>\n";
			$output .= "</td></tr>\n";
			$i++;
		}
	}
	
	$output .= "</table>\n</div>\n";
	echo $output;
	$output = " ";
}

function displayTextData ($id, $cmd, $type, $name) {

	/*
	 * Displays the contents of a table column.
	 * Called by display-text-data.php and used to display
	 * the RTS, run-log and script source
	 */
	
	
	global $debug;
	if ($debug) {
		echo "<p> displayTextData (id=$id, cmd=$cmd,  type=$type, name=$name) </p>\n";
	}
	
	/* display the source file*/
	if ($cmd == 1) {
		
		getTitleByScriptID ($id, "Source Listing");
		$query .= "SELECT  source, name ";
		$query .= "FROM   script ";
		$query .= "WHERE  scriptID = {$id} ";
	
		
		$resultSet = mysql_query($query);
		if ($debug) {
			echo "<br /> $query <br />";
		}
		confirm_query($resultSet);
	
		$row = mysql_fetch_array($resultSet);
		$output  = "<h4>Source Display for {$row["name"]} </h4> \n";
		$output .= "<pre> {$row["source"]} </pre>";
    /* display the run log */
	} elseif ($cmd == 2) {
		getTitleByScriptID ($id, "Run Log");
		$query .= "SELECT  log, name ";
		$query .= "FROM   script ";
		$query .= "WHERE  scriptID = {$id} ";
	
		//echo "<br /> $query <br />";
		$resultSet = mysql_query($query);
		confirm_query($resultSet);
	
		$row = mysql_fetch_array($resultSet);
		$output  = "<h4>Run Log for {$row["name"]} </h4> \n";
		$output .= "<pre> {$row["log"]} </pre>";
	/* display the MAP Run Time Settings*/	
	} elseif ($cmd == 3) {
		$query .= "SELECT  regression.rts, regression.name AS REG, product.release AS REL, product.name AS PRD ";
		$query .= "FROM   regression, product ";
		$query .= "WHERE  regressionID = {$id} ";
		$query .= "AND    regression.productID = product.productID ";
	
		//echo "<br /> $query <br />";
		$resultSet = mysql_query($query);
		confirm_query($resultSet);
	
		$row = mysql_fetch_array($resultSet);
		$output  = "<h4>MAP Settings for  {$row["PRD"]} {$row[REL]} Regression {$row["REG"]} </h4> \n";
		$output .= "<pre> {$row["rts"]} </pre>";
	/* display the expected files */	
	} elseif ($cmd == 4 ) {
		// show the contents of the file selected
        getTitleByScriptID ($id, "Expected Files List");
		if ($type == "list") {
			
			$query .= "SELECT  name, contents ";
			$query .= "FROM   exp_files ";
			$query .= "WHERE  scriptID = {$id} ";
			$query .= "AND    name     = '{$name}' ";
		
			//echo "<br /> $query <br />";
			$resultSet = mysql_query($query);
			confirm_query($resultSet); 
			$output  = "<h4>Expected file contents for $name</h4> \n";
			while ($row = mysql_fetch_array($resultSet)) {	
				$output .= "<pre>{$row["contents"]}</pre>\n";
			}	

		// show the list box	
		} else {
			
			$query .= "SELECT  name ";
			$query .= "FROM   exp_files ";
			$query .= "WHERE  scriptID = {$id} ";
	
			$resultSet = mysql_query($query);
			confirm_query($resultSet);
			createFileList ($resultSet, $id, "Expected", '4');
		}
	/* display the current files */	
	} elseif ($cmd == 5) {
		getTitleByScriptID ($id, "Expected Files List");
		if ($type == "list") {
			$query .= "SELECT  name, contents ";
			$query .= "FROM   current ";
			$query .= "WHERE  scriptID = {$id} ";
			$query .= "AND    name     = '{$name}' ";
			//echo "<br /> $query <br />";
			$resultSet = mysql_query($query);
			confirm_query($resultSet);
			
			$output  = "<h4>Current file contents for $name</h4> \n";
			while ($row = mysql_fetch_array($resultSet)) {	
				$output .= "<pre>{$row["contents"]}</pre>\n";
			}
			
		} else {
			$query .= "SELECT  name, contents ";
			$query .= "FROM   current ";
			$query .= "WHERE  scriptID = {$id} ";
		
			//echo "<br /> $query <br />";
			$resultSet = mysql_query($query);
			confirm_query($resultSet); 
			$num_rows = mysql_num_rows($resultSet);
			createFileList ($resultSet, $id, "Current", '5');		
		}
		
	/* display the difference files */	
	} elseif ($cmd == 6) {	
		
		    getTitleByScriptID ($id, "Expected Files List");
			if ($type == "list") {
			$query .= "SELECT  name, contents ";
			$query .= "FROM   differences ";
			$query .= "WHERE  scriptID = {$id} ";
			$query .= "AND    name     = '{$name}' ";
			//echo "<br /> $query <br />";
			$resultSet = mysql_query($query);
			confirm_query($resultSet);
			
			$output  = "<h4>Difference file contents for $name</h4> \n";
			while ($row = mysql_fetch_array($resultSet)) {	
				$output .= "<pre>{$row["contents"]}</pre>\n";
			}
			
		} else {
			$query .= "SELECT  name, contents ";
			$query .= "FROM   differences ";
			$query .= "WHERE  scriptID = {$id} ";

			$resultSet = mysql_query($query);
			confirm_query($resultSet);
			$num_rows = mysql_num_rows($resultSet);
			createFileList ($resultSet, $id, "Differences", '6');
		}
					
	} else {
		echo "<p id=\"warning\">Unknown cmd of $cmd </p><br />";
	}

	echo $output;
	
}

function createHistoryReport ($scriptName, $productName) {
	/*
	 * Report this history run of a script.
	 */
	
	global $debug;

	$query .= "SELECT script.scriptID, script.name AS script, script.start, script.end, script.elapsed, script.status, ";
	$query .= "regression.name AS reg, suite.name AS suite, product.release AS rel , product.name AS product, regression.regressionID ";
	$query .= "FROM   script, suite, regression,  product ";
	$query .= "WHERE  script.suiteID       = suite.suiteID ";
	$query .= "AND    suite.regressionID   = regression.regressionID ";
	$query .= "AND    regression.productID = product.productID ";
	$query .= "AND    script.name          = '{$scriptName}' ";
	$query .= "AND    product.name         = '{$productName}' ORDER BY regression.start";

	if ($debug) {
		echo "<p>createHistoryReport(scriptName:$scriptName productName:$productName)</p><p>$query</p>";
	}
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$output  = "<h1>History List for: $scriptName </h1> \n";
	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">\n";
	$output .= "<th>*Script</th>";
	$output .= "<th>Product</th>";
	$output .= "<th>Release</th>";
	$output .= "<th>Suite</th>";
	$output .= "<th>Run Date</th>";
//	$output .= "<th>End</th>";
	$output .= "<th>*Run Log</th>";
//	$output .= "<th>Status</th>\n";
	$output .= "</tr>\n";
	
	$i = 0;
	while ($row = mysql_fetch_array($resultSet)) {
		/* stripe the report with blue-green rows */
        if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
        
		$output .= "<td><a href=\"display-text-data.php?cmd=1";
		$output .= "&id={$row["scriptID"]}";
		$output .= "\"> {$row["script"]} </a></td>\n";
		$output .= "<td>{$row["product"]} </td>\n";
		$output .= "<td>{$row["rel"]} </td>\n";
		$output .= "<td>{$row["suite"]} </td>\n";
		$output .= "<td>{$row["start"]} </td>\n";
//		$output .= "<td>{$row["end"]}</td>\n";
//		$output .= "<td><a href=\"display-text-data.php?cmd=2&id={$row["scriptID"]}\"\>View</a></td>\n";
		/* if it failed lets print red text in this column */
		if ( $row["status"] == "Failed") {
			$output .= "<td id=\"red-text\"> <a href=\"display-text-data.php?cmd=2&id={$row["scriptID"]}\">{$row["status"]}</a></td>\n";
		} else {
			$output .= "<td> <a href=\"display-text-data.php?cmd=2&id={$row["scriptID"]}\" >{$row["status"]}</a></td>\n";
		}
		$output .= "</tr>\n";
		$i++;
	}
	$output .= "</table>\n";

	$output .= "<pre> {$row["log"]} </pre>";
	echo $output;
	
	return $regID = $row["regressionID"];

}

function createFTPdocument ($regID) {
	global $debug;
	
	if ($debug) {
		echo "<p>createFTPdocument(regressionID:$regID)</p><p>$query</p>";
	}
	
	$query .= "SELECT product.release AS REL, regression.name AS REG, product.name";
	$query .= " AS PRD, suite.name AS Suite, script.name AS Script, script.start,";
	$query .= " script.end, script.elapsed, script.status ";
    $query .= "FROM regression, product, suite, script ";
    $query .= "WHERE regression.productID = product.productID ";
    $query .= "AND regression.regressionID ='{$regID}' ";
    $query .= "AND suite.regressionID = regression.regressionID ";
    $query .= "AND script.suiteID = suite.suiteID";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	
	if ($debug) {
		echo "<p>$query</p>";
	}
	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">";
	$output .= "<th>Suite</th><th>Script</th><th>Start</th><th>End</th><th>P/F</th><th>History</th>";
	$output .= "</tr>";
	$i = 0;
	while ($row = mysql_fetch_array($resultSet)) {
		/* stripe the report with blue/green rows */
		if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
		$output .=  "<td> {$row["Suite"]}</td>";
		$output .=  "<td> {$row["Script"]}</td>";
		//remove spaces from date and time 
        $start   =  replaceBlanksInString($row["start"], '-'); 
		$output .=  "<td> $start </td>";
		$end     =  replaceBlanksInString($row["end"], '-');
		$output .=  "<td> $end</td>";
		$output .=  "<td> {$row["status"]}</td>";
// 		$elpased =  replaceBlanksInString($row["elapsed"], '-');
// 		$output .=  "<td>$elpased</td>";
		$output .= "<td> <a href=\"history-report.php?&script={$row["Script"]}&suiteID={$row["suiteID"]}&product={$row["PRD"]}\"\>History</a></td>\n";
	    $output .= "</tr>";
	    $i++;
	}
	$output .= "</table>";
	echo $output;
}
function replaceBlanksInString ($string, $replace ) {
	
	$pattern = '/\s/';
	
	// set the default replace char
	if (!$replace) {
		$replace = '-';
	}
	$replace = preg_replace($pattern, $replace, $string);
	
	return $replace;
	
}
function createSuiteReport($suiteID, $cmd) {
	
	global $debug;


	/* get the summary info   */
	$query .= "SELECT product.release AS REL, regression.name AS REG, regression.buildinfo, ";
	$query .= "regression.regressionID AS REGID, product.name AS PRD, suite.name AS SUITE ";
	$query .= "FROM   regression, product, suite ";
	$query .= "WHERE  suite.suiteID           = '{$suiteID}' ";
	$query .= "AND    regression.productID    = product.productID ";
	$query .= "AND    regression.regressionID = suite.regressionID ";

	if ($debug) {
		echo "<br />createSuiteReport($suiteID, $cmd)<br />$query<br />\n";
	}
	
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["PRD"];
	$releaseName   = $title["REL"];
	$regID         = $title["REGID"];
	$regName       = $title["REG"];
	$suiteName     = $title["SUITE"];
	$buildInfo     = $title["buildinfo"];

    createRegressionHeading ($suiteName, $productName, $releaseName, $regName, $buildInfo);
	
	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">\n";

	/* add the suite colunm because we were called by the regression page. */
	if ($cmd > 3) {
		$output .= "<th>Suite</th>";
	}

	$output .= "<th>*Script</th>";
	$output .= "<th>*Log</th>";
	$output .= "<th>Start</th>";
// 	$output .= "<th>End</th>";
	$output .= "<th>Elapsed</th>";
// 	$output .= "<th>*Run Log</th>";
	$output .= "<th>*History</th>\n";
	$output .= "</tr>\n";

	$query = "SELECT script.scriptID, script.name, script.start, script.end, ";
	$query .= "script.elapsed, script.status, script.source, script.log ";

	/*
	 * if we're called from the regression page then we need to add the suite table
	 * as the first column of the report.
	 */

	if ($cmd <= 3) {
		$query  = "SELECT script.scriptID, script.name, script.start, script.end, ";
		$query .= "script.elapsed, script.status, script.source, script.log ";
		$query .= "FROM   script ";
	} else {
		$query = "SELECT suite.name AS Suite, script.scriptID, script.name, script.start, script.end, ";
		$query .= "script.elapsed, script.status, script.source, script.log ";
		$query .= "FROM   script, suites ";
	}

	/* page controller */
	if       ($cmd == 1) {
		$query .= "WHERE  script.suiteID           = '{$suiteID}' ";
	} elseif ($cmd == 2) {
		$query .= "WHERE  script.suiteID           = '{$suiteID}' ";
		$query .= "AND    script.status            = 'passed' ";
	} elseif ($cmd == 3) {
		//echo "create failed link<br />";
		$query .= "WHERE  script.suiteID           = '{$suiteID}' ";
		$query .= "AND    script.status            = 'failed' ";
	} elseif ($cmd == 4) {
		//echo "create all passed <br />";
		$query .= "WHERE  suites.regressionID       = '{$regID}' ";
		$query .= "AND    script.suiteID           = suites.suiteID ";
		$query .= "AND    script.status            = 'passed' ";
	} elseif ($cmd == 5) {
		//echo "create all failed<br />";
		$query .= "WHERE  suites.regressionID       = '{$regID}' ";
		$query .= "AND    script.suiteID           = suites.suiteID ";
		$query .= "AND    script.status            = 'failed' ";
	}
	else {
		echo "Unknown cmd: $cmd<br />";
		return -1;
	}
	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
    $i = 0;
	while ($row = mysql_fetch_array($resultSet)) {
		
		/* stripe the report with blue/green rows */
		if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
		
		if ($cmd > 3) {
			$output .= "<td>{$row["Suite"]} </td>\n";
		}
		$output .= "<td> <a href=\"display-text-data.php?&cmd=1&id=";
		$output .= "{$row["scriptID"]}";

		$output .= "\"> {$row["name"]} </a></td>\n";
	
		/* if it failed lets print red text in this column */
		if ( $row["status"] == "Failed") {
			$output .= "<td id=\"red-text\">";
			$output .= "<a href=\"display-text-data.php?&cmd=2&id={$row["scriptID"]}\">";
			$output .= "{$row["status"]}</a></td>\n";	
		} else {
			$output .= "<td><a href=\"display-text-data.php?&cmd=2&id={$row["scriptID"]}\">";
			$output .= "{$row["status"]}</a></td>\n";
		}	
		$output .= "<td> {$row["start"]} </td>\n";
		$output .= "<td> {$row["elasped"]}</td>\n";
		$output .= "<td> <a href=\"history-report.php?&script={$row["name"]}&suiteID=$suiteID&product=$productName\"\>History</a></td>\n";
		$output .= "</tr>\n";
		$i++;
	}
	$output .= "</table>\n";
	echo $output;
}

function get_run_log ($product, $release, $regression, $suite, $script) {
	$productuc = strtoupper($product);
	$releaseuc = strtoupper($release);
	$suiteuc   = strtoupper($suite);
	$scriptuc  = strtoupper($script);
	 
	$output  = "<h4> $productuc $releaseuc Resgression $regression $suiteuc  $script Run Log Display </h4> \n";

	$query .= "SELECT  script.log, script.name ";
	$query .= "FROM   script, suites, regressions, releases, products ";
	$query .= "WHERE  products.productID = releases.productID ";
	$query .= "AND    regressions.regressionID = suites.regressionID ";
	$query .= "AND    suites.suiteID = script.suiteID ";
	$query .= "AND    products.name    = '{$product}' ";
	$query .= "AND    releases.name    = '{$release}' ";
	$query .= "AND    regressions.name = '{$regression}' ";
	$query .= "AND    suites.name      = '{$suite}' ";
	$query .= "AND    script.name     = '{$script}' ";

	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$regression = mysql_fetch_array($resultSet);
	$output .= "<pre> {$regression["log"]} </pre>";
	echo $output;

}

function get_suite ($product, $release, $regression, $suite) {
	$productuc = strtoupper($product);
	$releaseuc = strtoupper($release);
	$suiteuc   = strtoupper($suite);
	 
	$output  = "<h4> $productuc $releaseuc Resgression $regression $suiteuc Scripts List </h4> \n";

	$query .= "SELECT  script.name AS Script, script.start, script.end, script.status ";
	$query .= "FROM   script, suites, regressions, releases, products ";
	$query .= "WHERE  products.productID = releases.productID ";
	$query .= "AND    regressions.regressionID = suites.regressionID ";
	$query .= "AND    suites.suiteID = script.suiteID ";
	$query .= "AND    products.name    = '{$product}' ";
	$query .= "AND    releases.name    = '{$release}' ";
	$query .= "AND    regressions.name = '{$regression}' ";
	$query .= "AND    suites.name      = '{$suite}' ";

	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<th>Script</th><th>Start</th><th>End</th><th>Passed</th>";

	while ($regression = mysql_fetch_array($resultSet)) {
		$output .= "<tr>\n";
		$output .= "<td class=\"bg-green\" scope=\"row\"><a href=\"content.php?page="
		. urlencode ($regression["Script"])
		. "\"> {$regression["Script"]} </a></td>\n";

		$output .= "<td class=\"bg-green\" scope=\"row\">{$regression["start"]} </td>\n";
		$output .= "<td class=\"bg-green\" scope=\"row\">{$regression["end"]} </td>\n";
		$output .= "<td class=\"bg-blue\" scope=\"row\">{$regression["status"]} </td>\n";
		$output .= "<td class=\"bg-green\" scope=\"row\"><a href=\"content.php?page="
		. urlencode ($regression["status"])
		. "\"> {$regression["status"]} </a></td>\n";
		$output .= "</tr>\n";

	}
	$output .= "</table>\n";
	echo $output;

}
function get_status_count ($regressionID, $type) {
    global $debug;
	$query .= "SELECT  COUNT(*) AS total ";
	$query .= "FROM regression, suite, script ";
	$query .= "WHERE  ";
	$query .= "regression.regressionID = suite.regressionID ";
	$query .= "AND suite.suiteID = script.suiteID ";
	$query .= "AND regression.regressionID = '{$regressionID}' ";
	$query .= "AND script.status ='{$type}' ";


	if ($debug) {
		echo "<br />get_status_count ($regressionID, $type)<br />\n";
		echo "$query<br /><br /><br />\n";
	}
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	while ($row = mysql_fetch_array($resultSet)) {
		$count = $row["total"];
	}

	return $count;
}
function getSuiteStatus ($suiteID, $type) {
	 global $debug;
	if ($type == "passed" || $type == "failed") {
		 
		$query  = "SELECT  COUNT(script.status) AS TOTAL  ";
		$query .= "FROM   script ";
		$query .= "WHERE  script.suiteID = '{$suiteID}'  ";
		$query .= "AND script.status =  '{$type}' ";
		$query .= "GROUP BY script.status";
		if ($debug) {
			echo "<br />getSuiteStatus ($suiteID, $type)<br />\n";
			echo "$query<br /><br /><br />\n";
		}
		$resultSet = mysql_query($query);
		confirm_query($resultSet);
			
		$row = mysql_fetch_assoc($resultSet);
		$total        = $row["TOTAL"];

	} else {
		echo "<br /> getSuiteStatus has invalid type parameter of: $type <br />";
		return -1;
	}
	if (empty($total)) { $total = 0; }
	return $total;
}
function getStatusPercentage ($total, $div) {

	/* returns the formated printable percentage */

	if ($total == 0 || $div == 0) {
		$percent_passed = 0;
	} elseif ($total > 0  && $div > 0) {
		$percent_passed = ($div / $total) * 100;
		$percent_passed = sprintf("%2d",$percent_passed) . "%";
	} else {
		$percent_passed = ' ';
	}
	 
	return $percent_passed;

}


function getTitleByScriptID ($scriptID, $heading) {
	global $debug;


	/* get the summary info   */
	$query .= "SELECT product.release AS REL, regression.name AS REG, ";
	$query .= "product.name AS PRD, product.productID, regression.buildinfo AS BUILD, suite.name AS SUITE, ";
	$query .= "script.name AS SCRIPT, script.status AS STATUS ";
	$query .= "FROM   regression, product, suite, script ";
	$query .= "WHERE  regression.productID     = product.productID ";
	$query .= "AND    regression.regressionID  = suite.regressionID ";
    $query .= "AND    suite.suiteID            = script.suiteID ";
	$query .= "AND    script.scriptID = '{$scriptID}'";

	if ($debug) {
		echo "getTitleByScriptID (id $scriptID)<br /><br />$query<br />\n";
	}
	 
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["PRD"];
	$releaseName   = $title["REL"];
	$regName       = $title["REG"];
	$build         = $title["BUILD"];
	$suite         = $title["SUITE"];
	$script        = $title["SCRIPT"];
	$status        = $title["STATUS"];
	$productID     = $title["productID"];
	
	$status = strtoupper($status);
	$script = strtoupper($script);
	
	echo "<h3>$script $heading</h3>";
	echo "<table class=\"display_table\">";
	echo "<tr class=\"tableheading\"><th>Suite</th><th>Product</th><th>Release</th><th>Reg #</th><th>Suite</th><th>Build</th></tr>";
	echo "<tr class=\"bg-green\"><td>$suite</td><td>$productName</td><td>$releaseName</td><td>$regName</td><td>$suite</td><td>$build</td></tr>";
	echo "</table>";

	//echo "<h4>Product: $productName<br /> Release: $releaseName <br />Regression: $regName <br />Build: $build <br />Suite:  $suite<br />Script:  $script <br /></h4> \n";
    
	if ($status == 'FAILED') {
		echo "<h4 id=\"failed\"> $status</h4>";
	} else {
		echo "<h4 id=\"passed\"> $status</h4>";
	}
	return $productID;
}

function createRegressionHeading ($suiteName, $productName, $releaseName, $regName, $build) {
	global $debug;
    if ($debug) {
		echo "createRegressionHeading ($suiteName, $productName, $releaseName, $regName, $build, $cics, $db2 )\n";
	}
	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">\n";
	if ($suiteName == ' ') {
		$output .= "<th>Product</th>";
		$output .= "<th>Release</th>";
		$output .= "<th>Regression</th>";
		$output .= "<th>Build Info</th>\n";
		$output .= "</tr>\n";
		$output .= "<tr class=\"bg-green\">\n";
		$output .= "<td>$productName</td>";
		$output .= "<td>$releaseName</td>";
		$output .= "<td>$regName</td>";
		$output .= "<td>$build</td>";
		$output .= "</tr>\n";
		$output .= "</table> \n";
		
	} else {
		$output .= "<th>Suite</th>\n";
		$output .= "<th>Product</th>";
		$output .= "<th>Release</th>";
		$output .= "<th>Regression</th>";
		$output .= "<th>Build Info</th>\n";
		$output .= "</tr>\n";
		$output .= "<tr class=\"bg-green\">\n";
		$output .= "<td>$suiteName</td>";
		$output .= "<td>$productName</td>";
		$output .= "<td>$releaseName</td>";
		$output .= "<td>$regName</td>";
		$output .= "<td>$build</td>";
		$output .= "</tr>\n";
		$output .= "</table> \n";
	}
    echo $output;
    
   
}
function createSuitesByRegression ($regressionID) {
	

	global $debug;


	/* get the summary info   */

	$query .= "SELECT product.release AS REL, regression.name AS REG, ";
	$query .= "product.name AS PRD, regression.buildinfo AS BUILD, subsystem.name AS SUB, ";
	$query .= "subsystem.version AS VER, lpar.name AS LPAR, subsystem.notes AS DB2 ";
	$query .= "FROM   regression,  product, subsystem, lpar ";
	$query .= "WHERE  regression.productID     =  product.productID ";
	$query .= "AND    regression.regressionID  = '{$regressionID}' ";
	$query .= "AND    regression.subsystemID   = subsystem.subsystemID ";
	$query .= "AND    regression.lparID        = lpar.lparID ";

	if ($debug) {
		echo "<p>createSuitesByRegression (id $regressionID)</p><p>$query</p>\n";
	}
	 
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["PRD"];
	$releaseName   = $title["REL"];
	$regName       = $title["REG"];
	$build         = $title["BUILD"];
	$cics          = $title["SUB"];
	$ver           = $title["VER"];
	$db2           = $title["DB2"];
	
	createRegressionHeading (" ", $productName, $releaseName, $regName, $build);
	
	/* get detailed records */
	$query  = "SELECT suite.suiteID, suite.subsystemID AS subID, suite.name AS suite, COUNT(suite.name) ";
	$query .= "AS NUM_OF_SCRIPTS ";
	$query .= "FROM   script, suite ";
	$query .= "WHERE  suite.regressionID = '{$regressionID}'  ";
	$query .= "AND    script.suiteID = suite.suiteID  ";
	$query .= "GROUP BY suite.name ";

	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	$output .= "<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">\n";
	if ($productName == 'ESW-SMARTTEST') {
		$output .= "<th>Subsystem</th>";
		$output .= "<th>Release</th>";
		$output .= "<th>% Passed</th>";
		$output .= "<th>*Total</th>";
		$output .= "<th>*Passed</th>";
		$output .= "<th>*Failed</th>";
//		$output .= "<th>Notes</th>";
	} else {
		$output .= "<th>Suite</th>";
		$output .= "<th>% Passed</th>";
		$output .= "<th>*Total</th>";
		$output .= "<th>*Passed</th>";
		$output .= "<th>*Failed</th>";
//		$output .= "<th>Notes</th>";
	}
	$output .= "\n</tr>\n";
	$i = 0;
	while ($row = mysql_fetch_array($resultSet)) {
		$passed  = getSuiteStatus ($row["suiteID"], 'passed');
		$failed  = getSuiteStatus ($row["suiteID"], 'failed');
		 
		$percent_passed = getStatusPercentage ($row["NUM_OF_SCRIPTS"], $passed);
		$suite = $row["suite"];
		
		/* stripe the report with blue/green rows */
		if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
		$output .= "<td> $suite</td>\n";
		
		// need to add subsystem version number fields for ESW-SMARTTEST
		if ($productName == 'ESW-SMARTTEST') {
			$ver = getSubsystemVer ($row["subID"]);
			$output .= "<td> $ver</td>\n";
		}
		
	
		$output .= "<td> $percent_passed </td>\n";
		$output .= "<td> <a href=\"suite-report.php?";
		$output .= "suiteID=$regression{$row["suiteID"]}";
		$output .= "&cmd=1\"> {$row["NUM_OF_SCRIPTS"]} </a></td>\n";
		 
		$output .= "<td> <a href=\"suite-report.php?suiteID=$regression{$row["suiteID"]}&cmd=2\">";
		$output .= "$passed</td></a>\n";
		 
		$output .= "<td> <a href=\"suite-report.php?suiteID=$regression{$row["suiteID"]}&cmd=3\">";
		$output .= "$failed</td></a>\n";
			
		$output .= "</tr>\n";
		$i++;
	}
	$output .= "</table>\n";
	echo $output;
}
function updateSuitesByRegression ($regressionID) {
	

	global $debug;


	/* get the summary info   */

	$query .= "SELECT product.release AS REL, regression.name AS REG, ";
	$query .= "product.name AS PRD, regression.buildinfo AS BUILD, subsystem.name AS SUB, ";
	$query .= "subsystem.version AS VER, lpar.name AS LPAR, subsystem.notes AS DB2 ";
	$query .= "FROM   regression,  product, subsystem, lpar ";
	$query .= "WHERE  regression.productID     =  product.productID ";
	$query .= "AND    regression.regressionID  = '{$regressionID}' ";
	$query .= "AND    regression.subsystemID   = subsystem.subsystemID ";
	$query .= "AND    regression.lparID        = lpar.lparID ";

	if ($debug) {
		echo "<p>updateSuitesByRegression (id $regressionID)</p><p>$query</p>\n";
	}
	 
	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["PRD"];
	$releaseName   = $title["REL"];
	$regName       = $title["REG"];
	$build         = $title["BUILD"];
	$cics          = $title["SUB"];
	$ver           = $title["VER"];
	$db2           = $title["DB2"];

     createRegressionHeading ($productName, $releaseName, $regName, $build, $ver, $db2);
	/* get detailed records */
	$query  = "SELECT suite.suiteID, suite.subsystemID, suite.name AS suite, COUNT(suite.name) ";
	$query .= "AS NUM_OF_SCRIPTS ";
	$query .= "FROM   script, suite ";
	$query .= "WHERE  suite.regressionID = '{$regressionID}'  ";
	$query .= "AND    script.suiteID = suite.suiteID  ";
	$query .= "GROUP BY suite.name ";
	
	if ($debug) {echo "<p>updateSuitesByRegression Detail: $query</p>\n";}

	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
//   $output .= "<p>* indicates a Point and Shoot (PnS) column.</p>\n";
//   $output .= "<form id=\"regUpdate\" action=\"processTableUpdate.php\" method=\"post\">";
	$output .= "\n<table class=\"display_table\">\n";
	$output .= "<th></th>";
	

	if ($productName == 'ESW-SMARTTEST') {
		$output .= "<th>Suite</th><th class=\"bg-blue\">Release</th>";;
	} else {
		$output .= "<th class=\"bg-blue\">Suite</th><th>% Passed</th>";
	}
	$output .= "<th class=\"bg-blue\">*Total</th><th>*Passed</th>";
	$output .= "<th class=\"bg-blue\">*Failed</th><th>Notes</th>";
	$index = 1;
	while ($row = mysql_fetch_array($resultSet)) {
		
		$passed  = getSuiteStatus ($row["suiteID"], 'passed');
		$failed  = getSuiteStatus ($row["suiteID"], 'failed');
		$subID   = $row["subsystemID"];
		$suiteID = $row["suiteID"]; 
		$percent_passed = getStatusPercentage ($row["NUM_OF_SCRIPTS"], $passed);
		$suite = $row["suite"];

		$output .= "<tr>\n";
		// Display ESW subsystem version numbers
		if ($productName == 'ESW-SMARTTEST') {
			$output .= "<td class=\"bg-green\"><input type=\"button\" onclick=\"updateSubsystem($subID, $index, $suiteID, $regressionID)\" ";
			$output .= "name=\"uSubsys\" value=\"Update\" /></td>\n";
			$output .= "<td class=\"bg-blue\">$suite</td>\n";
// 			$output .= "<td class=\"bg-blue\"><input type=\"text\"  id=\"ver$index\" maxlength=\"25\" value=\"$ver\" /></td>\n";

			/* get all versions for the subsystem (suite) */
			$query  = "SELECT subsystemID, version ";
			$query .= "FROM subsystem  ";
			$query .= "WHERE name = '{$suite}'  ";
			
			$versionSet = mysql_query($query);
			$num_rows   = mysql_num_rows($versionSet);

			confirm_query($versionSet);
			$output .= "<td class=\"bg-green\">";
			
			// check if there are any records in the set. If not, then skip select tag.
			if ($num_rows > 0) {
				$output .= "<select id=\"subver$index\" name=\"subver\">\n";
				while ($ver = mysql_fetch_array($versionSet)) {
					$subVer  = $ver["version"];
					$subID   = $ver["subsystemID"];
					// set selected 
					if ($subID ==  $row["subsystemID"]) {
						$output .= "<option value=\"$subID\" selected>$subVer</option>\n";
					} else {
						$output .= "<option value=\"$subID\">$subVer</option>\n";
					}
				}
				$output .= "</select></td>\n";
			}
		}

		// need to add subsystem version number fields for ESW-SMARTTEST

		$output .= "<td class=\"bg-green\">$percent_passed </td>\n";
		$output .= "<td class=\"bg-blue\"> {$row["NUM_OF_SCRIPTS"]}</td>\n";
		 
		$output .= "<td class=\"bg-green\">";
		$output .= "$passed</td>\n";
		 
		$output .= "<td class=\"bg-blue\">";
		$output .= "$failed</td>\n";
			
		$output .= "</tr>\n";
		$index++;
	}
	$output .= "</table>\n";
	$output .=  "</form>\n";
	echo $output;
}
function setRegVersion ($connection, $subID, $suiteID) {
	global $debug;


	$query  = "UPDATE suite ";
	$query .= "SET suite.subsystemID = '$subID'  ";
	$query .= "WHERE suite.suiteID = '$suiteID' ";

	if ($debug) {
		echo "<p> setRegVersion: $query</p>\n";
		exit;
	}
	$result = mysql_query($query, $connection);
	if ($result) {
		return 1;
	} else {
		echo "<p>setRegVersion - Update Failed: $query.</p>\n";
		echo "<p>" . mysql_error() . "</p>";
		exit();
	}
}

function setRegVersion999 ($connection, $regID, $name, $newVer) {
	global $debug;
	
	/* check to see if the regID is in the subssytem table.
	 * If it's not then we need to add it because it's a new regression. 
	 * 
	 * */
	
	$query = "SELECT regressionID FROM subsystem WHERE subsystem.regressionID = '{$regID}' ";
	$query .= "AND subsystem.name = '{$name}' ";
	if ($debug) {
		echo "<p> $query</p>\n";
	}
	$result = mysql_query($query, $connection);
	$num_rows = mysql_num_rows($result);

	/* check to see if we need to add the record to the subsystem table.
	 * 
	 */
	if ($num_rows == 0) { /* insert record into subsystem table */
		echo "Couldn't find $regID $name in subsytem table";
		$query  = "INSERT INTO subsystem (subsystem.name, subsystem.regressionID, subsystem.version) ";
		$query .= "VALUES ('{$name}', '{$regID}', '{$newVer}'); ";
		$result = mysql_query($query, $connection);
		if ($result) {
			return 1;
		} else {
			echo "<p>setRegVersion - Update Failed: $query.</p>\n";
			echo "<p>" . mysql_error() . "</p>";
			exit();
		}
	}
	
    /* already in table so let's update the version field. */
    $query  = "UPDATE subsystem "; 
	$query .= "SET subsystem.version = '$newVer'  ";
	$query .= "WHERE subsystem.regressionID = '$regID' ";
	$query .= "AND subsystem.name = '$name' ";

    if ($debug) {
		echo "<p> setRegVersion: $query</p>\n";
		exit;
	}
	$result = mysql_query($query, $connection);
	if ($result) {
		return 1;
	} else {
		echo "<p>setRegVersion - Update Failed: $query.</p>\n";
		echo "<p>" . mysql_error() . "</p>";
		exit();
	}
}
function setRegression ($connection, $regID, $osID, $lparID, $subID) {

	global $debug;
	/*
	 * If we were called via SmartTest then subid will be empty
	 *
	 */
	if ($subID != "undefined") {
	    $query  = "UPDATE regression  "; 
		$query .= "SET regression.osID            = '$osID',  ";
		$query .= "regression.lparID              = '$lparID', ";
		$query .= "regression.subsystemID         = '$subID' ";
		$query .= "WHERE regression.regressionID  = '$regID' ";
	} else {
		$query  = "UPDATE regression  ";
		$query .= "SET regression.osID            = '$osID',  ";
		$query .= "regression.lparID              = '$lparID' ";
		$query .= "WHERE regression.regressionID  = '$regID' ";
	}
    if ($debug) {echo "<p> setRegression: $query</p>\n";}
   
	$result = mysql_query($query, $connection);
	if ($result) {
		$prdID    = getProductIDByReg($regID);
		$prodname = getProductName($prdID);
		redirect_to ("all-regressions.php?product=$prodname&cmd=2");

	} else {
		echo "<p>setRegression - Update Failed: $query.</p>\n";
		echo "<p>" . mysql_error() . "</p>";
	}
	return;
}
function createProductDropDownList () {
	global $debug;

	$query  = "SELECT DISTINCT name ";
	$query .= "FROM product ";
	$query .= "WHERE visible = 1 ORDER BY name ASC";
   

	//echo "get_products: $query<br />\n";
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
    
	if ($debug) {
		echo "<ul><li> createProductDropDownList()</li></ul>\n";
	}

	$output  = "<h1>Product Selection List</h1>\n";
	$output .= "<FORM METHOD=\"POST\" ACTION=\"regression-update-list.php\" > ";
	$output .= "<select name=\"products\">\n";
    $offset  = 1;
	while ($product = mysql_fetch_array($resultSet)) {
			
		$output .= "<option value=\"" . $product["name"] . "\">" . $product["name"]  . "</option>\n";
        $offset++;
	}
	$output .= "</select>\n";
	$output .= "<INPUT TYPE=\"SUBMIT\" VALUE=\"Select\">";
	$output .= "</form>\n";
    
	echo $output;
}
function getSubsysVerByRegID($regID) {
	global $debug;
	
	if ($debug) {
		echo "<p>getSubsysIDbyRegID ($regID)</p>\n";
	}
	
	$query  = "SELECT name, version ";
			$query .= "FROM subsystem ";
			$query .= "WHERE subsystemID = (SELECT subsystemID FROM regression WHERE regressionID = '{$regID}') ";

			if ($debug) {
				echo "<p>getSubsysVerByRegID SQL: $query</p>\n";
			}
			 
			//echo "<br /> $query <br />";
			$resultSet = mysql_query($query);
			confirm_query($resultSet);
			$row = mysql_fetch_assoc($resultSet);
			$ver   = $row["version"];
		return $ver;
	
}
function getSubsystemVer($subsystemID) {
	global $debug;

	if ($debug) {
		echo "<p>getSubsystemVer ($subsystemID)</p>\n";
	}

	$query  = "SELECT name, version ";
	$query .= "FROM subsystem ";
	$query .= "WHERE subsystemID = '{$subsystemID}' ";

	if ($debug) {
		echo "<p>getSubsystemVer SQL: $query</p>\n";
	}

	//echo "<br /> $query <br />";
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	$row = mysql_fetch_assoc($resultSet);
	$ver   = $row["version"];
	
	if ($debug) {
		echo "<p>returns: $ver</p>\n";
	}
	return $ver;

}
function createRegressionDetail($regID, $cmd) {
	/*
	 * This function creates the details for a regression by product, release and regression.
	 * It's contents are displayed on regression-report.php
	 */
	 
	global $debug;

	$query .= "SELECT product.release AS REL, regression.name AS REG, regression.buildinfo, ";
	$query .= "regression.regressionID AS REGID, product.name AS PRD, suite.name AS SUITE, ";
	$query .= "script.name AS Script, script.start, script.end, script.elapsed, script.status, ";
	$query .= "script.scriptID ";
	$query .= "FROM regression,  product, suite, script ";
	$query .= "WHERE regression.productID  = product.productID ";
	$query .= "AND regression.regressionID = suite.regressionID ";
	$query .= "AND suite.suiteID           = script.suiteID ";
	$query .= "AND regression.regressionID =  '{$regID}' ";

	if ($cmd == 4) {
		$query .= "AND script.status =  'passed' ";
	}elseif ($cmd == 5) {
		$query .= "AND script.status =  'failed' ";
	}

	if ($debug) {
		echo "<br />createRegressionDetail(regID: $regID, cmd:$cmd )<br />$query <br />\n";
	}

	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["PRD"];
	$releaseName   = $title["REL"];
	$regID         = $title["REGID"];
	$regName       = $title["REG"];
	$suiteName     = $title["SUITE"];
	$buildInfo     = $title["buildinfo"];

	$output  = "<table class=\"display_table\">\n";
	$output .= "<tr class=\"bg-blue\">$productName $releaseName $regName $buildInfo</tr> \n";
	//$output .= "\n<table class=\"display_table\">\n";
	$output .= "<tr class=\"tableheading\">";
	

	/* add the suite colunm because we were called by the regression page. */
	if ($cmd > 1) {
		$output .= "<th>Suite</th>";
	}

	$output .= "<th>*Script</th>";
	$output .= "<th>*Log</th>";
	$output .= "<th>Start Time </th>";
	$output .= "<th>Elapsed</th>";
	$output .= "<th>*History</th>";

	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	$i = 0;
	$td_color;

	
	while ($row = mysql_fetch_array($resultSet)) {
		
		if ($i % 2 == 0) {
			$output .= "<tr class=\"bg-blue\">\n";
			$td_color = "blue";
		} else {
			$output .= "<tr class=\"bg-green\">\n";
			$td_color = "green";
		}

		if ($cmd > 1) {
			$output .= "<td>{$row["SUITE"]} </td>\n";
		}

		$output .= "<td> <a href=\"display-text-data.php?";
		$output .= "cmd=1&id={$row["scriptID"]}";
	  
		$output .= "\"> {$row["Script"]} </a></td>\n";
		
		/* if it failed lets print red text in this column */
		if ( $row["status"] == "Failed") {
			$output .= "<td id=\"red-text\"><a href=\"display-text-data.php?&cmd=2&id={$row["scriptID"]}\">{$row["status"]}</a></td>\n";
		} else {
			$output .= "<td><a href=\"display-text-data.php?&cmd=2&id={$row["scriptID"]}\">{$row["status"]}</a></td>\n";
		}
		$output .= "<td> {$row["start"]} </td>\n";
		$output .= "<td> {$row["elapsed"]}</td>\n";
		$output .= "<td> <a href=\"history-report.php?&script={$row["Script"]}&product=$productName\"\>History</a></td>\n";
		$output .= "</tr>\n";
		$i++;
	}

	$output .= "</table>\n";
	echo $output;
}
function createRegressionsReport ($productName, $cmd, $productID){
	// echo "<p> productID = $productID </p>";
	/* determine if we need to create the 'all' report.
	 * if we do then we're going to have to pull the productName 
	 * from the productID. 
	 * 
	 * When the user selects the all-regressions from the drop-downn the product name is passed via the productID
	 */
	if ($match  = preg_match('/^all/', $productID)) {
		$parmProductName = substr($productID, '4');
		
		/* I set the productID to -1 because no products in the product table have an
		 * ID of -1 and I can check to see if I need to build the all report.
		 */ 
		$productID = -1;

	}

	/*
	 * This function creates a list of regressions that have been published
	 * for a product. The report is displayed on all-regressions.php
	 *
	 * 2 SQL queries are issused. The first is to get the title/product name
	 * and the second is for the detail records per product regression
	 */
	 
	/* get summary info for the titles */
	global $debug;
	
    /*
     * If we have a productID that means we were called via the dropdown list.
     * The dropdown list passes the productID to us and can have either a valid 
     * productID or and all-ProductName value. If the productID is -1 that means
     * we have to pull the productName from the productID.
     */
	if ($productID){
		if ($productID == -1) {
			$productName = $parmProductName;
		} else {
			$productName = getProductName($productID);
		}
	}
	
    $query  = "SELECT name, productID ";
	$query .= "FROM product ";
	$query .= "WHERE visible = 1 AND name = '$productName' ORDER BY name ASC";
	 
	if ($debug) {
		echo "createRegressionsReport(product = $productName, cmd=$cmd)<br /><br />\n";
		echo "$query<br /><br /><br />\n";
	}

	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	$productName   = $title["name"];
	$output .= "<h4> All Regressions for $productName</h4>* indicates a Point and Shoot (PnS) column.";
	
	$query  = "SELECT DISTINCT productID, name, product.release ";
	$query .= "FROM product ";
	$query .= "WHERE visible = 1 AND name = '{$productName}' ORDER BY product.release ASC";
	
	//echo "$query\n";
	
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	/* build the dropdown list form */
	$output  = "<h3>Regressions for $productName </h3>\n";
	$output .= "<FORM METHOD=\"POST\" ACTION=\"all-regressions.php\" > \n";
	$output .= "<select name=\"productID\">\n";
	$output .= "<option value=\"" . "all-$productName" . "\">" . "All $productName regressions" . "</option>\n";
	$offset  = 1;
	while ($product = mysql_fetch_array($resultSet)) {
		/* set the default to the selected product because the dropdown also serves as a title. */
		if ($productID == $product["productID"]) {
			$output .= "<option selected=\"selected\" value=\"" . $product["productID"] . "\">" . $product["name"] . "-" . $product["release"] . "</option>\n";
		} else {
			$output .= "<option value=\"" . $product["productID"] . "\">" . $product["name"] . "-" . $product["release"] . "</option>\n";
		}
		$offset++;
	}
	$output .= "</select>\n";
	$output .= "<INPUT TYPE=\"SUBMIT\" VALUE=\"Select\">";
	$output .= "</form>\n";
	
	
	/* if we got a productID from the form then list all regressions
	 * for that productID
	 */
	
	if ($productID) {

		$query  = "SELECT os.name AS OS, regression.regressionID, product.name AS PRD, product.release AS REL, site.name AS SITE,  ";
		$query .= "os.version AS OSREL, lpar.name AS LPAR, subsystem.name AS SUB, subsystem.version AS SUBREL, regression.name AS REG,  ";
		$query .= "regression.start, regression.buildinfo, regression.rts, regression.passed, regression.failed ";
		$query .= "FROM product, regression, os, lpar, site,  subsystem  ";

		if ($productID == -1) {
		// list all regressions for the product
			$query .= "WHERE product.name = '{$parmProductName}' ";
		} else {
			$query .= "WHERE product.productID = '{$productID}' ";
		}
		$query .= "AND   regression.productID = product.productID ";
		$query .= "AND   regression.siteID = site.siteID ";
		$query .= "AND   regression.osID = os.osID ";
		$query .= "AND   regression.subsystemID = subsystem.subsystemID ";
		$query .= "AND   regression.lparID = lpar.lparID ";
		$query .= "ORDER BY start ";
		if ($debug) {
			echo "$query<br />\n";
		}
	
		$resultSet = mysql_query($query);
	
		confirm_query($resultSet);
	
		/* setup the table/column headings */
		$output .= "\n<table class=\"display_table\">\n";
		$output .= "<tr class=\"tableheading\">\n";
	
		$output .= "<th> Release - Regression</th>\n";
		$output .= "<th> Regression Date/Time</th>\n";
		$output .= "<th> *Total</th>\n";
		$output .= "<th> *Passed</th>\n";
		$output .= "<th> *Failed</th>\n";
		$output .= "<th> % Passed</th>\n";
		$output .= "<th> OS - Version</th>\n";
		$output .= "<th> LPAR</th>\n";
		$output .= "<th> SubSytem</th>\n";
		$output .= "<th> *MAP Settings</th>\n";
		$output .= "<th> *List All Scripts</th>\n";
		$output .= "</tr>\n";
	
		$i = 0;
	
		while ($regression = mysql_fetch_array($resultSet)) {
	
			/* stripe the report with blue/green rows */
			if ($i % 2 == 0) {$output .= "<tr class=\"bg-blue\">\n";} else {$output .= "<tr class=\"bg-green\">\n";}
	
			$output .= "<td title='{$regression["buildinfo"]}' id='ballons'>{$regression["REL"]} - {$regression["REG"]} </td>\n";
			$output .= "<td> {$regression["start"]} </td>\n";
		
			// uncomment the following 2 lines to dynmaically compute the pass/fail count via query
			
 			$passed = get_status_count($regression["regressionID"], "passed");
 			$failed = get_status_count($regression["regressionID"], "failed");
			
			
			// pull from the regression table. much faster 
			//$passed = $regression["passed"];
			//$failed = $regression["failed"];
	
			$total  = $passed + $failed;
			$percent_passed = getStatusPercentage ($total, $passed);
	
			$output .= "<td> <a href=\"regression-report.php?regID="
			. urlencode ($regression["regressionID"])
			. "&cmd=1\">$total</a></td>\n";
			$output .= "<td> <a href=\"regression-report.php?regID={$regression["regressionID"]}";
			$output .= "&cmd=4\">";
			$output .= "$passed</a></td>\n";
	
			$output .= "<td> <a href=\"regression-report.php?regID={$regression["regressionID"]}";
			$output .= "&cmd=5\">";
			$output .= "$failed</a></td>\n";
	
			$output .= "<td> $percent_passed</td>\n";
	
			$output .= "<td> {$regression["OS"]} - {$regression["OSREL"]} </td>\n";
			$output .= "<td> {$regression["LPAR"]} </td>\n";
			/*
			 * ESW-SMARTTEST has regression/subsystem  one to many relationship therefore it doesn't make
			 * sense to have a subsystem release at this level.
			 */
			if ($productName == 'ESW-SMARTTEST') {
				$output .= "<td> N/A</td>\n";
			} else {
				$output .= "<td> {$regression["SUB"]} - {$regression["SUBREL"]} </td>\n";
			}
	
	
			$output .= "<td> <a href=\"display-text-data.php?id=";
			$output .= "{$regression["regressionID"]}";
			$output .= "&cmd=3\">MAP Settings</a></td>\n";
	
			
			$output .= "<td><a href=\"create-ftp.php?regID=";
			$output .=  "{$regression["regressionID"]}\">";
			$output .= "All-Scripts</a></td>\n";
			$output .= "</tr>\n";
			
			$output .= "</tr>\n";
			$i++;
	
		}
			$output .= "</table>\n";
	}	
	echo $output;
}
function update_regression_list ($productName) {
	
	//echo "<p> product: $productName </p>";
	global $debug;
	
	/* local vars */
	$osID;
    
    $query  = "SELECT name, productID ";
	$query .= "FROM product ";
	$query .= "WHERE visible = 1 AND name = '$productName' ORDER BY name ASC";
	 
	if ($debug) {
		echo "update_regression_list(product = $productName)<br /><br />\n";
		echo "$query<br /><br /><br />\n";
	}

	$resultSet = mysql_query($query);
	confirm_query($resultSet);

	$title = mysql_fetch_assoc($resultSet);
	
	$productName   = $title["name"];
	$output .= "<h4> Regressions  List For $productName</h4>";
	
	$query  = "SELECT os.name AS OS, os.osID, regression.regressionID, ";
	$query .= "product.name AS PRD, product.release AS REL, site.name AS SITE,  ";
	$query .= "os.version AS OSREL, lpar.name AS LPAR, lpar.lparID, ";
	$query .= "subsystem.name AS SUB, subsystem.version AS SUBREL, subsystem.subsystemID, ";
	$query .= "regression.name AS REG,  ";
	$query .= "regression.start, regression.buildinfo, regression.rts ";
	$query .= "FROM product, regression, os, lpar, site,  subsystem  ";
	$query .= "WHERE product.name = '{$productName}' ";
	$query .= "AND   regression.productID = product.productID ";
	$query .= "AND   regression.siteID = site.siteID ";
	$query .= "AND   regression.osID = os.osID ";
	$query .= "AND   regression.subsystemID = subsystem.subsystemID ";
	$query .= "AND   regression.lparID = lpar.lparID ";
	$query .= "ORDER BY regression.start ";

    
	if ($debug) {
		echo "$query<br />\n";
	}
	
	$resultSet = mysql_query($query);
	confirm_query($resultSet);
	
	/* setup the table/column headings */
	$output  .= "\n<table class=\"display_table\">\n";
	$output  .= "<tr class=\"tableheading\">\n";
	$output .= "<th>*Update Release - Regression</th>\n";
	$output .= "<th>Regression Date/Time</th>\n";
	$output .= "<th>*Total</th>\n";
	$output .= "<th>*Passed</th>\n";
	$output .= "<th>*Failed</th>\n";
	$output .= "<th>% Passed</th>\n";
	$output .= "<th>OS - Version</th>\n";
	$output .= "<th>LPAR</th>\n";
	$output .= "<th>SubSytem</th>\n";
	$output .= "<th>Admin</th>\n";
	$output .= "</tr>\n";

    $index = 1;
	/* if no rows are returned, fetch_array will return fales.
	 * 
	 *  Now display the formated results with the input fields. 
	 * 
	 * 
	 * */
	while ($regression = mysql_fetch_array($resultSet)) {

		$output .= "<tr>\n";
		
		$output .= "<td class=\"bg-blue\" title='{$regression["buildinfo"]}' id='ballons'>";
		/* smarttest is the only product that has subsystem updates at the suite level */
		if ($productName == 'ESW-SMARTTEST') {
			$output .= "<a href=\"update-regression-report.php?regID={$regression["regressionID"]}&cmd=1\">{$regression["REL"]} - {$regression["REG"]}</a></td>\n";
		} else {
			$output .= "{$regression["REL"]} - {$regression["REG"]}</td>\n";
		}
		
		$output .= "<td class=\"bg-green\">{$regression["start"]} </td>\n";
		$passed = get_status_count($regression["regressionID"], "passed");
		$failed = get_status_count($regression["regressionID"], "failed");
		
		$total  = $passed + $failed;
		$percent_passed = getStatusPercentage ($total, $passed);

		$output .= "<td class=\"bg-blue\">$total</a></td>\n";
		$output .= "<td class=\"bg-green\">";
		$output .= "$passed</td>\n";

		$output .= "<td class=\"bg-blue\">";
		$output .= "$failed</td>\n";
		$output .= "<td class=\"bg-green\">$percent_passed</td>\n";
		
		/* call routine to query db getting all os's */
		$query  = "SELECT os.name, os.version, os.osID ";
		$query .= "FROM os  ";
		$query .= "ORDER BY os.version ";
		
		$osSet = mysql_query($query);
		confirm_query($osSet);
		$output .= "<td class=\"bg-blue\">";
		$output .= "<select id=\"osrel$index\" name=\"osrel\">\n";
		while ($os = mysql_fetch_array($osSet)) {
			$osName = $os["name"];
			$osVer  = $os["version"];
			$osID   = $os["osID"];
			
			/* set the selected value to the default on page load */
			if ($osID == $regression["osID"] ) {
				$output .= "<option value=\"$osID\" selected>$osName $osVer</option>\n";
			} else {
				$output .= "<option value=\"$osID\">$osName $osVer</option>\n";
			}
			
		}
	    $output .= "</select></td>\n";
	    
		//$output .= "<td class=\"bg-green\">";
		/* load dropdown from mysql*/
		$query  = "SELECT lpar.name,  lpar.lparID ";
		$query .= "FROM lpar  ";
		$query .= "ORDER BY lpar.name ";
		
		$lparSet = mysql_query($query);
		confirm_query($lparSet);
		$output .= "<td class=\"bg-blue\">";
		$output .= "<select id=\"lpar$index\" name=\"lpar\">\n";
		/* load the list box */
	    
		while ($os = mysql_fetch_array($lparSet)) {
			$lparName   = $os["name"];
			$lparID     = $os["lparID"];
				
			/* set the selected value to the default on page load */
			
			/*
			 * use the sql lparID as the value id used by jscript
			 * to update the regression table. 
			 */
			if ($lparID == $regression["lparID"] ) {
				$output .= "<option value=\"$lparID\" selected>$lparName</option>\n";	
			} else {
				$output .= "<option value=\"$lparID\">$lparName</option>\n";
			}
		}
	    $output .= "</select></td>\n";
	    
		/*
		 * ESW-SMARTTEST has regression/subsystem  one to many relationship therefore it doesn't make
		 * sense to have a subsystem release at this level.
		 */
		if ($productName == 'ESW-SMARTTEST') {
			$output .= "<td class=\"bg-blue\">N/A</td>\n";
		} else {
			/* load the SubSystem dropdown from mysql */
			$query  = "SELECT subsystem.name, subsystem.version, subsystemID ";
			$query .= "FROM subsystem  ";
			$query .= "ORDER BY subsystem.name ";
			
			$subsysSet = mysql_query($query);
			confirm_query($subsysSet);
			$output .= "<td class=\"bg-blue\">";
			$output .= "<select id=\"sub$index\">\n";
			while ($os = mysql_fetch_array($subsysSet)) {
				$subName   = $os["name"];
				$subver    = $os["version"];
				$subID     = $os["subsystemID"];
				if ($subID == $regression["subsystemID"] ) {
					$output .= "<option value=\"$subID\" selected>$subName - $subver</option>\n";
				} else {
					$output .= "<option value=\"$subID\">$subName - $subver</option>\n";
				}
			}
		    $output .= "</select></td>\n";
		}
		$regID = $regression["regressionID"];
		$output .= "<td class=\"bg-green\">";
		/* pass the index of the dropdown and the regression id to javascript for processing */
	    $output .= "<input type=\"button\" onclick=\"updateRegList($index, $regID)\"  value=\"Update\">";
		$output .= "</td>";
		$output .= "</tr>\n";
		$index++;
	}
	$output .= "</table>\n";
//    $output .= "<script type=\"text/javascript\" src=\"javascript/jquery-1.10.0.min.js\"></script>\n";
//    $output .= "<script type=\"text/javascript\">\n";
//    $output .= "var subsys = $('#subsys').find(\":selected\").text();\n";
//    $output .= "alert(subsys);\n";
//    $output .= "</script>\n";
//    $output .= "<script type=\"text/javascript\"> $(\"document\").ready(function() { alert(\" The page just loaded\");}); </script>";

	echo $output;
}

function  get_page_by_id($selPage) {
	//echo "inside by_id: $selPage </ br>\n";
	$query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE pageID= " . $selPage . " ";
	$query .= "LIMIT 1";
	//echo "$query<br />";
	$resultSet = mysql_query($query);

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return fales
	if ($page = mysql_fetch_array($resultSet)) {
		return $page;
	}
	else {
		return NULL;
	}

}
function find_selected_page($connection) {

	/*
	 * Uses the URL parms to query the DB and get the rows
	 * for the selected menu or page items
	 */

	// make global so I don't have to return them.
	global $selectedMenu;
	global $selectedPage;
		
	// echo "Inside find_selected_page() <br />";
	// grab the parms from the request
	if(isset($_GET['menu'])) {
		//echo "menu passed via GET<br />";
		$selectedMenu = get_menu_by_id($_GET['menu']);
		//var_dump($selectedMenu);
		$selectedPage = set_default_page($selectedMenu['menuItemID'], $connection);
	} elseif (isset($_GET['page'])) {
		//echo "page passed via GET<br />";
		$selectedPage = get_page_by_id($_GET['page']);
		$selectedMenu = NULL;
		// $selectedMenu = set_default_menu($_GET['page'], $connection);
	} else {
		//echo "nothing passed via GET<br />";
		$selectedPage = NULL;
		$selectedMenu = NULL;
	}
}

function set_default_page($id, $connection) {
	//echo "Inside set_default($id, $connection)<br />\n";
	$pageSet = get_pages_by_menuID($id, $connection, true);
	//var_dump($pageSet);
	$first_page = mysql_fetch_array($pageSet);
	if ($first_page) {
		return $first_page;
	} else {
		NULL;
	}

}

function set_default_menu($pageID, $connection) {
	echo "Inside set_default_menu($pageID, $connection)<br />\n";
	$menuID = get_menuID($pageID, $connection);
	// $selectedMenu = get_menu_by_id($menuID);
	//	 if ($selectedMenu) {
	//	 	 echo "*** Selected Menu Set! ***\n";
	//	 } else {
	//	 	echo "+++  Failed to set Selected Menu! +++\n";
	//	 }

}

function get_menuID($pageID) {
	//echo "inside get_menuID ($pageID) \n";
	$query  = "SELECT menuItemID FROM pages WHERE pageID = $pageID ";
	$query .= "LIMIT 1";


	$resultSet = mysql_query($query);

	//echo "rs: $query<br />\n ";

	confirm_query($resultSet);
	// if no rows are returned, fetch_array will return fales

	while ($row = mysql_fetch_array($resultSet, MYSQL_NUM) ) {
		printf("ID: %s Name %s", $row[0], $row[1]);
	}

	//		if ($row = mysql_fetch_array($resultSet)) {
	//
	//			$count =  count($row);
	//			echo "Number of elements: $count\n<br />";
	//			foreach ($menus as $field) {
	//					echo "*** $field ***<br \>\n";
	//			}
	//			//return $menu;
	//		}
	//		else {
	//			return NULL;
	//		}
}

function navigation($selectedMenu, $selectedPage, $connection, $public = false) {

	// fetch the menuItems and their corresponding pages and build the left sidebar
	$menuItemSet = get_menuItems($connection, $public);
	//var_dump($menuItemSet);
	// need to initialize $output before going into the loop otherwise things fail.
	$output = "<ul>\n";

	// ok, now let's process the rows one at a time
	while ($menuItem = mysql_fetch_array($menuItemSet)) {

		$bold = isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"]);
		$output .=  "<li><a $bold href=\"edit-menu.php?menu=" .  urlencode($menuItem["menuItemID"]) . "\"> {$menuItem["menuName"]}</a></li>\n";
		$pageSet = get_pages_for_menuItems($menuItem, $connection, $public);
		$output .= "<ul>\n";
		while ($page = mysql_fetch_array($pageSet)) {
			$bold = isSeleted ($page["pageID"], $selectedPage["pageID"]);
			$output .= "<li $bold><a href=\"content.php?page=" . urlencode ($page["pageID"]) . "\"> {$page["menuName"]}</a></li>\n";
		}

	}
	//	$output .= "</ul>\n";
	return $output;
}

function public_navigation($selectedMenu, $selectedPage, $connection, $public = true) {
	// fetch the menuItems and their corresponding pages and build the left sidebar
	$menuItemSet = get_menuItems($connection, $public);
	//var_dump($menuItemSet);

	$output = "<ul>\n";

	// ok, now let's process the rows one at a time
	while ($menuItem = mysql_fetch_array($menuItemSet)) {
		$bold = isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"]);
		$output .=  "<li><a $bold href=\"index.php?menu=" .  urlencode($menuItem["menuItemID"]) . "\"> {$menuItem["menuName"]} </a></li>\n";
		$pageSet = get_pages_for_menuItems($menuItem, $connection, $public);

			
		if (isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"])) {
			$output .= "<ul>\n";
			while ($page = mysql_fetch_array($pageSet)) {
				$bold = isSeleted ($page["pageID"], $selectedPage["pageID"]);
				$output .= "<li $bold><a href=\"content.php?page=" . urlencode ($page["pageID"]) . "\"> {$page["menuName"]}</a></li>\n";
			}
			$output .= "</ul>\n";
		}
			
			
	}
	$output .= "<li><a href=\"content.php?page=1\">ProJCL R310 Regression 1</a></li>\n";
	$output .= "<li><a href=\"content.php?page=2\">ProJCL R310 Admin1</a></li>\n";
	$output .= "</ul>\n";
	return $output;
}


function map_page_navigation($selectedPage, $connection) {
	// fetch the menuItems and their corresponding pages and build the left sidebar

	//var_dump($menuItemSet);
	$output = "<ul>\n";

	// ok, now let's process the rows one at a time
	while ($menuItem = mysql_fetch_array($menuItemSet)) {
		$bold = isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"]);
		$output .=  "<li><a $bold href=\"index.php?menu=" .  urlencode($menuItem["menuItemID"]) . "\"> {$menuItem["menuName"]} </a></li>\n";
		$pageSet = get_pages_for_menuItems($menuItem, $connection, $public);

			
		if (isSeleted ($selectedMenu["menuItemID"], $menuItem["menuItemID"])) {
			$output .= "<ul>\n";
			while ($page = mysql_fetch_array($pageSet)) {
				$bold = isSeleted ($page["pageID"], $selectedPage["pageID"]);
				$output .= "<li $bold><a href=\"content.php?page=" . urlencode ($page["pageID"]) . "\"> {$page["menuName"]}</a></li>\n";
			}
			$output .= "</ul>\n";
		}
			
			
	}
	$output .= "</ul>\n";
	return $output;
}

function display_pages_by_menuID($menuID, $connection) {

	//echo "display_pages_by_menuID($menuID) <br />\n";
	$pageSet = get_pages_by_menuID($menuID, $connection);
	//var_dump($pageSet);
	$output .= "<ul>\n";

	// build the menu pages for the selected menu
	while ($page = mysql_fetch_array($pageSet)) {
		$output .= "<li $bold><a href=\"index.php?page=" . urlencode ($page["pageID"]) . "\"> {$page["menuName"]}</a></li>\n";
	}
	$output .= "</ul>\n";
	echo $output;
}
 
function redirect_to ($location = NULL) {
   
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}
function verify_form_field ($label) {

	// pull the content from the form
	$content = $_POST[$label];

	//print "printing content from verifyform: $content <br />\n";

	if (!isset($content) || empty($content)) {
		//append to the array
		//print "adding $field to errors array <br />\n";
		//$errors[] = $content;
		return FALSE;
	} else {
		//print "$content is verifed! <br />\n";
		return TRUE;
	}
}


function verify_form_fields ($connection, $type) {
	$errors = array();

	if ($type == 'page') {
		$required_fields = array('menu_name', 'position', 'visible', 'content');
	} else {
		$required_fields = array('menu_name', 'position', 'visible');
	}

	foreach ($required_fields as $fieldName) {
		if (!isset($_POST[$fieldName]) || (empty($_POST[$fieldName])  && !is_numeric($_POST[$fieldName]))) {
			$errors[] = $fieldName;
		}
	}


	$fields_with_lengths = array('menu_name' => 30);
	foreach ($fields_with_lengths as $fieldname => $maxlength) {
		if (strlen(trim($_POST[$fieldname])) > $maxlength) {
			$errors[] = $fieldname;
		}
	}

	/* we got a clean form so let's do the UPDATE to the DB */
	if (empty($errors)) {
		/* passed via URL */
		 	
		/* passed via post */
		$menu_name = $_POST['menu_name'];
		$position  = $_POST['position'];
		$visible   = $_POST['visible'];
		$content   = $_POST['content'];
			
		$query = "UPDATE pages SET
		menuName = '{$menu_name}',
		position = {$position},
		visible  = {$visible},
		content  = '{$content}'
		WHERE pageID = {$id}";
		//echo "SQL: $query </ br>\n";
		$results = mysql_query($query, $connection);
			
		/* determine if the query was able to update the row */
		if (mysql_affected_rows() == 1) {
			$message = "Update Successful.";
		}
		else {
			$message = "Update Unsuccessful.";
			$message .= "<br />" . mysql_error();
			$message .= "<br /> sql query: $query";
		}
			
	} else {
		$message = "There were " . count($errors) . " error(s) in the form.\n";
	}
}
?>