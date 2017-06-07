
function cancelUpdate() {
//   alert("hello");
	window.location = "./update-product-table.php";
}
function verifyDelete (prod, release, id) {
  if (confirm("Are you sure you want to delete this record: " + prod + " " + release + " HJE24sb" +
  		"ProductID of: " + id + "? ")) {
  	document.location = "processTableUpdate.php?delete=1&id=" + id;
  }
  else {
    document.location = "update-product-table.php";
  }
}
function loadThrobber (productID){
	
//	$('button').click(function () {
		var toAdd = $('<div id="throbber"></div>');
		alert(toAdd);
		$("body").append(toAdd);
//	});
	
	
}
function updateSubsystem(subID, index, suiteID, regID ) {
    //alert(regID);
	var subElementID  = "#subver" + index;
	// get the value of the selected statement using JQuery
	var subSysID  = $(subElementID).val();
	
	document.location = "processTableUpdate.php?updateVer=1&id=" + subSysID + "&suiteID=" + suiteID + "&regID=" + regID;
}
function updateRegList( index, regID) {
    //alert ("regid=" + regID);
    /* 
    *  This routine is called by the onclick event handler on the update button
    *  created by regression-update-list.php/update_regression_list() onClick. 
    *
    *  JQuery to determine which dropdown list values have been set by the user. 
    *  The values are routed to processTableUpdate.php for processing.
    *  The index parm is the offset to the user selected option.
    */
    var osrelID = "#osrel" + index;
    var lparID  = "#lpar" + index;
    var subID   = "#sub" + index;
  
    /* don't really need the actual data in the dropdown just the table IDs which are stored
     * in the value attributes.
     * The following is an example of how to access the dropdown data using JQuery:
     *  var osrel  = $(osrelID).find(":selected").text();
     *  var lpar   = $(lparID).find(":selected").text();
 
     * Get the selected values from the dropdown list. 
     * the values contain the table IDs used to update the
     * regression table.
     * */
    var osID       = $(osrelID).val();
    var thislparID = $(lparID).val();
    var thisSubID  = $(subID).val();
    //alert("osrel name: " + osrel + "osrelID:" + osID + "lpar name: " + lpar + "lparID:" + thislparID);
    //alert(thisSubID);
    
    document.location = "processTableUpdate.php?updateReg=1&regID=" + regID + "&osID=" + osID + "&lparID=" + thislparID + "&subID=" + thisSubID;
}
function processAdminFunction() {
	/*
	 * admin.php calls this function
	 * Form   stmt name  = admin
	 * Select stmt name  = navigate
	 * Option stmt value = url
	 * 
	 */
	document.location = document.admin.navigate.value;
}


