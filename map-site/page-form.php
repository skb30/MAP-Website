     <?php 
       
     	// This page is include by new-page.php and edit-page.php
     	
        // determine if this is a new page    
     	if (!isset($new_page)) {
     		$new_page = false;
     	}
     	//echo "setting new_page to: $new_page<br />\n";
     	if (!$new_page ) {
     		$col = get_page_by_id($selectedPage["pageID"]);

     	} else {
     		//$col = get_page_by_id($pageID);
     		
     	}
		// load the form data into vars
    	$menuName = $col['menuName'];
		$position = $col['position'];
		$visible  = $col['visible'];
		$menuID   = $col['menuItemID'];
		$content  = $col['content'];
		
		if (!$new_page){
			echo "<h4> Edit Page: $menuName </h4>\n";	
		}
    	
	?>
    <br />
    <p>
    	Page Name:
        <input type="text" name="page_name" value="<?php echo $menuName; ?>" id="pageName" />
    </p>
    
    <p> Position:
    	<select name="position">
    	 <?php 
 	
    	    /* query the db to get the number of pages assigned to this parent*/
    	    if (!$new_page) {
    	    	//echo "printing pageID: $pageID";
    	    	$pageSet   = get_pages_for_menuItems($selectedPage, $connection);
    	    	$pageCount = mysql_num_rows($pageSet);
    	    /* adding a new page */	
    	    } else {
    	    	//echo "printing selectedMenu: $selectedMenu";
    	    	$pageSet   = get_pages_for_menuItems($selectedMenu, $connection);
    	    	$pageCount = mysql_num_rows($pageSet) + 1;
    	    }
			
			for ($count = 1; $count <= $pageCount; $count++) {	
				echo "<option value=\"$count\">$count</option>";
			}
			
		?>
         </select>
        
    </p>
    <p> Visible:

        <input type="radio" name="visible" value="0" 
        <?php if ($visible == 0) { echo " checked"; } ?>
        /> No
		
        <input type="radio" name="visible" value="1"
        <?php if ($visible == 1) { echo " checked"; } ?>
        /> Yes 
    </p>
    
    <p>
    Content:
    <textarea  name="content" rows="10" cols="100" id="content">
	<?php echo $content; ?>
	</textarea>
        
    </p>

    

