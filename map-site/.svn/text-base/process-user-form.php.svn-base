     <?php 
    ini_set('display_errors', 'On');
    require_once("ssi/form-functions.php");   
    if (!isset($create_user)) {
     		$create_user = false;
    }
    /* if this call came from the logon page then don't show the admin stuff */
    if (isset($_POST['logon'])) {
    	$create_user = false;
    }
  //echo "create user is set to: $create_user\n<br />";
	/* check if the post came from the logon or create page */
	
    if (isset($_POST['logon']) || isset($_POST['submit'])) {
		
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
	            	$message = "The user was successfully created.";
	            	
	            } else {
	            	$message = "The user could not be created.";
	            	$message .= "<br />" . $mysql_error();
	            }
			} else {
				/* authenticate user */
				$query = "SELECT * FROM users 
			   		WHERE userName = '{$userName}' AND hashedPassword = '{$hash_password}' LIMIT 1";
				//echo "$query\n";
				
	            $result = mysql_query($query,$connection);
	            if ($result) {
	              	if ($found = mysql_fetch_array($result)) {
	              		redirect_to("new-menu.php");
						//$message = "The user has been validated.<br />\n";	
					
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
	}
		
	?>
    <br />
    <h3>Enter User Information</h3>
    <table>
    <tr>
	    <td>
	    	User ID:
	    </td>
	    <td>
    		<input type="text" name="user_name"  maxlength="30" value="<?php echo htmlentities($userName);?>" />
   		 </td>
    </tr>
    <tr>
    	<td>
    		Password:
   		</td>
   		<td>
    		<input type="password" name="user_password"  maxlength="30" value="<?php echo htmlentities($password);?>" />
   		 </td>
    </tr>
    
    </table>

    
       


    

