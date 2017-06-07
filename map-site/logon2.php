<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php include("ssi/form-functions.php"); ?>
<?php 
	 
    ini_set('display_errors', 'On');
    $userName = " ";
    $password = " ";
	/* check if the post came from the logon or create page */
	
    if (isset($_POST['logon'])) {
	
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

			/* authenticate user */
			$query = "SELECT * FROM users 
		   		WHERE userName = '{$userName}' AND hashedPassword = '{$hash_password}' LIMIT 1";
			//echo "$query\n";
			
            $result = mysql_query($query,$connection);
            if ($result) {
              	if ($found = mysql_fetch_array($result)) {
              		redirect_to("new-menu.php");
				$message = "The user has been validated.<br />\n";	
				
				} else {
					$message = "Unknown user or password.";
				}
	
            } else {
            	$message = "$query <br />\n";
            	$message .= mysql_error();
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



<?php require_once("ssi/header.php"); ?>
<div id='leftSideBar'>

	 <!-- Call the navigation links for the left side of the page -->
     <!--     <a href="new-menu.php">+New Menu</a> -->
<ul>
	<li><a href="edit-menu.php">Admin Page</a></li>
    <li><a href="index.php">Public Area</a></li>
     <li><a href="create-user.php">Create User</a></li>
 </ul>
   
     
<!--     <a href="new-menu.php">+New Menu</a> -->

</div> <!--leftSideBar -->

<div id='mainContent'>
    <h1> Mainframe Automation Project (MAP) </h1>
    <h2> MAP Logon </h2>
    
    
	    
    <form action="logon.php" method="post">
    
		<h3>Enter User Information</h3>
    <table>
    <tr>
	    <td>
	    	User ID:
	    </td>
	    <td>
    		<!--<input type="text" name="user_name"  maxlength="30" value="<?php echo htmlentities($userName);?>" /> -->
            <input type="text" name="user_name"  maxlength="30" value=""/>
   		 </td>
    </tr>
    <tr>
    	<td>
    		Password:
   		</td>
   		<td>
    		<!--<input type="password" name="user_password"  maxlength="30" value="<?php echo htmlentities($password);?>" /> -->
            <input type="password" name="user_password"  maxlength="30" value="" />
   		 </td>
    </tr>
    
    </table>
		
    <input type="submit" name="logon" value="logon" />
	</form>
  		
</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
