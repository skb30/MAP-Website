<?php

function check_required_fields ($required_fields_array) {
	//echo "inside check_required_fields($required_fields_array)<br />\n";
	
	$field_errors = array();
	
	foreach ($required_fields_array as $fieldName) {
		if (!isset($_POST[$fieldName]) || (empty($_POST[$fieldName])  && !is_numeric($_POST[$fieldName]))) {
			//echo "adding errors <br />";
			$field_errors[] = $fieldName;
		}
	}
	
	return $field_errors;
	
}


function check_max_field_length ($field_length_array) {
	$field_errors = array();
	foreach ($field_length_array as $fieldname => $maxlength) {
		//echo "fieldName: $fieldname<br />\n";
		if (strlen(trim($_POST[$fieldname])) > $maxlength) {
			$field_errors[] = $fieldname;
		}
	}
	return $field_errors;
}


function display_form_errors ($errors) {
	echo "Review the following fields for errors: <br />";
    foreach ($errors as $error) {
    	echo " - " . $error . "<br />\n";
    }
}
?>