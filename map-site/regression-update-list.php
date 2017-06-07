<?php
require_once("ssi/session.php"); 
include("ssi/functions.php"); 
require_once("ssi/form-functions.php"); 
require_once("ssi/connection.php"); 
include("ssi/header.php");



    /* set by the dropdown list created by createProductDropdownList */
    $selectedPrd  = $_POST['products'];
    $prd          = $_GET['product'];
    
    /* this page gets called from the set_regression function which passed the product name 
     * via GET and from update-regression-report.php.
     * 
     * update-regression-report.php issues a post passing the product.
     * 
     * if the GET is called then overlay the post var. 
     * 
     */
    if ($prd) {$selectedPrd = $prd;}

?>
<div id="leftSideBar"><?php createProductLinks();?></div>
	
<?php update_regression_list($selectedPrd, 1); ?>	
	
<script src="./javascript/map-scripts.js"></script>	
<script type="text/javascript" src="javascript/jquery-1.10.0.min.js"></script>

<?php include("ssi/footer.php");?>