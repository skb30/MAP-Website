<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/form-functions.php"); ?>
<?php 
    ini_set('display_errors', 'On');
    if (!isset($create_user)) {
     		$create_user = false;
    }
    /* if this call came from the logon page then don't show the admin stuff */
    if (isset($_POST['logon'])) {
    	$create_user = false;
    }
    $userName = " ";
    $password = " ";
	$message  = " ";
	/* check if the post came from the logon or create page */
	
    if (isset($_POST['logon']) || isset($_POST['create'])) {
		
		
    //if (0) {
		//echo "create user is set to: $create_user\n<br />";
		$field_errors  = array();
		$length_errors = array();
		   
		/* validate required fields */
		$required_fields = array('user_name', 'user_password');
	    $field_errors = check_required_fields($required_fields);
		
		/* validate lenght fields */
		$fields_with_lengths = array('user_name' => 30, 'user_password' => 30);
		/* merge the errors into one array */
		
		$errors = array_merge ($field_errors, check_max_field_length($fields_with_lengths));
		 
		/* passed via form */   
	    $userName      = trim($_POST['user_name']);
		$password      = trim($_POST['user_password']);
		$hash_password = sha1($password);

		/* if we don't have any errors on the form then update the  DB */
		if (empty($errors)) {
			//echo "User Name: $userName<br />\n";
			//echo "Password:  $password<br />\n";
			if ($create_user) {
				$query = "INSERT INTO users (
				   userName, hashedPassword)
				   VALUES (
				   '{$userName}', '{$hash_password}'
				
				)";
	            $result = mysql_query($query,$connection);
	            if ($result) {
	            	$message = "MAP admin user <b>$userName</b> was successfully created.";
	            	
	            } else {
	            	$message = "$userName could not be created.";
	            	$message .= "<br />" . $mysql_error();
	            }
			} else {
				/* authenticate user */
				$query = "SELECT userID, userName FROM users 
			   		WHERE userName = '{$userName}' 
			   		AND hashedPassword = '{$hash_password}' 
			   		LIMIT 1";
				//echo "$query\n";
				
	            $result = mysql_query($query,$connection);
	            if ($result) {
	              	if ($found = mysql_fetch_array($result)) {
	              		/* load the session with the userid */
	              		$_SESSION['user_id'] = $found['userID'];
	              		$_SESSION['user_name'] = $found['userName'];
	                	redirect_to("admin.php");
					
					
					} else {
						$message = "Unknown user or password.";
					}
		
	            } else {
	            	$message = "$query <br />\n";
	            	$message .= mysql_error();
	            }
				
			}
			
    		
		} else {
			if (count($errors) == 1) {
				$message = "There was an error in the form.\n";
				display_form_errors ($errors);
			} else {
				$message = "There were " . count($errors) . " errors in the form.\n";
				display_form_errors ($errors);
			}
		}
	echo "$message <br />";	
	} else { //Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1 ) {
			$message = "You have been sucessfully logged out of MAP.";
		}
	}
	echo "$message";
	?>