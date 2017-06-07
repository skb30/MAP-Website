<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/functions.php"); ?>

<?php 

	// Four steps to closing a session (i.e. logging out)
	
	// 1. Find the session
	session_start();
	
	//2. Unset all the session variables
	$_SESSION = array();
	
	//3 Destroy the session cookie
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

   //4. Destory session
   session_destroy();
   
   redirect_to("logon.php?logout=1");

?>


