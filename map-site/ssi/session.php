<?php
    /* start a MAP session */
	session_start();
	
	 /*
     * check to see if the user is already logged in
     * if not, then redirect them back to the logon page.
     */
	
	function logged_in () {	
		return isset($_SESSION['user_id']);
	}
 
	function confirm_logged_in(){
		if(!logged_in()) {
			redirect_to("logon.php");
		}
	}
	
?>