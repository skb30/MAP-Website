<?php 

require_once("ssi/connection.php"); 
include("ssi/functions.php"); 
require_once("ssi/header.php"); echo "\n"; 
$debug   = $_GET['debug'];

?>


<style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>

<input type="file" id="files" name="files[]" multiple />
<output id="list"></output>

<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>

<div id='leftSideBar'>

 
 	 <!-- Call the navigation links for the left side of the page -->
   
     <?php 
     
	 // find_selected_pages sets these 2 globals 1-$selectedMenu and 2- $selectedPage
	 //find_selected_page($connection);

	 // call the naviagtion function passing the vars set by find_selected_pages 
	 //echo public_navigation($selectedMenu, $selectedPage, $connection);
	 //echo public_navigation($selectedMenu, $selectedPage, $connection);
	 
	createProductLinks();
	 
	 
	 ?>   

 

</div>
<div id='mainContent'>
 <h1> Mainframe Automation Project (MAP) </h1>
    <p>Welcome to the Mainframe Automation Project (MAP). This site is used to provide access to MAP related resources.</p>
	<p>As more mainframe products are migrated to MAP their resources can be found here.</p>
	<p>Please send comments and suggestions to: <a href="mailto:scott.barth@asg.com">email</a></p>
</div>
<?php require("ssi/footer.php"); ?>

