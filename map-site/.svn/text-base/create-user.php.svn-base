<?php require_once("ssi/session.php"); ?>
<?php require_once("ssi/connection.php"); ?>
<?php include("ssi/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("ssi/header.php"); ?>

<div id="leftSideBar"><?php createProductLinks();?></div>

<div id='mainContent'>
	<?php  $create_user = true; include("process-user.php") ?>
    <h1> Mainframe Automation Project (MAP) </h1>
    <h2> Create a MAP User </h2>
    
    
	    
    <form action="create-user.php" method="post">
		<h3>Enter User Information</h3>
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
        <input type="submit" name="create" value="Create MAP Admin User" />
	</form>
  		
</div> <!--End main_content --> 



<?php require("ssi/footer.php"); ?>
