<?php require_once("ssi/connection.php"); ?>
<?php require_once("ssi/session.php"); ?>
<?php include("ssi/functions.php"); ?>


<?php
   /*
    * if the user already has a session then redirect to the
    * admin page.
    */
	if (logged_in()) {
		redirect_to("admin.php");
		
	}
?>
<?php require_once("ssi/header.php"); ?>
<div id="leftSideBar"><?php createProductLinks();?></div>

<div id='mainContent'>
<?php  $create_user = false; include("process-user.php") ?>
    <h1> Mainframe Automation Project (MAP) </h1>
    <h2> MAP Administration Logon </h2>
    
    
	    
    <form action="logon.php" method="post">
    
	<h3>Enter Logon Information</h3>
    <table>
    <tr>
	    <td>
	    	User ID:
	    </td>
	    <td>
    		
            <input type="text" name="user_name"  maxlength="30" value=""/>
   		 </td>
    </tr>
    <tr>
    	<td>
    		Password:
   		</td>
   		<td>
    		
            <input type="password" name="user_password"  maxlength="30" value="" />
   		 </td>
    </tr>
    
    </table>
		
    <input type="submit" name="logon" value="Logon" />
	</form>
  		
</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
