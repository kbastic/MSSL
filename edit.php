<?php
// This page will edit records in the symptoms table.
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
//Set page title
$page_title = 'Edit Symptoms Log';
//Include HTML header and connect to the database
include ('includes/header.html');
require ('../../connection/mysqli_connect.php');
//Regular expression - does not work in all browsers
$pattern ="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))";
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	//set error message
	$user_id = $_SESSION['user_id'];
	if (empty($_POST['sym_id'])) {
		$errors[] = 'An error has occured';
	} else {
		$sym_id = $_POST['sym_id'];
	}
	
	
	if (empty($errors)) { // If everything's OK.
	
		// Make the select query:
		$sq = "SELECT * FROM symptoms WHERE sym_id='$sym_id' AND user_id='$user_id'";
		$sr = @mysqli_query ($dbc, $sq); // Run the query.
		if ($sr) { // If it ran OK.
		
        //Put all the fields for editing here:
			
			
			  if (!mysqli_num_rows($sr) == 0) {
			  while ($srow = mysqli_fetch_array ($sr, MYSQLI_ASSOC)) 
			  {?>
			  <div class="content">
			  <p>&nbsp;</p>
			  <div class="bluebox"><h2 align="center">Edit Symptoms Log</h2></div>
				  
				 
				  <br/>

		   
<!--Begin form-->		   
<form action="update.php" method="post">

	<fieldset><legend style="font-size:small">Edit your symptoms in the form below:</legend>
	        <!--make sure original date is shown-->
	        </br>
            <p>Onset Date (YYYY-MM-DD): <input type="text" id="date" name="date" maxlength="25" size="25" pattern="<?php echo $pattern; ?>" value="<?php echo $srow['start_date'];?>"/>
            <img src="images/cal.gif" onclick="javascript:NewCssCal('date', 'yyyyMMdd')" style="cursor:pointer"/></p> 
            <p> Symptoms Type:
            <select name="type">
            <?php //get symptom categories from the database and display them as drop-down list
			 //make sure previous database entry type is selected
                 $tq = "SELECT * FROM symtype";
				 $tr = mysqli_query ($dbc, $tq);
				 $selected = 'selected';
                while ($trow = mysqli_fetch_array ($tr, MYSQLI_ASSOC))
				{
				
                echo "<option value=\"{$trow['type_id']}\"";  
				if ($srow['type_id']==$trow['type_id']) { echo $selected;};	
				
				echo   ">" . $trow['category'];
				
				echo "</option>";
                           }//end of while loop
                    ?>
           </select></p>
            <!--select severity from previous database entry-->
            <p>Severity: <select name="severity" id="severity">
              <option value="1" <?php if ($srow['severity']==1) { echo "selected";}?>>1-Mild</option>
              <option value="2" <?php if ($srow['severity']==2) { echo "selected";}?>>2</option>
              <option value="3" <?php if ($srow['severity']==3) { echo "selected";}?>>3-Medium</option>
              <option value="4" <?php if ($srow['severity']==4) { echo "selected";}?>>4</option>
              <option value="5" <?php if ($srow['severity']==5) { echo "selected";}?>>5-Severe</option>
             </select> </p>
             <!--select new or old from previous database entry-->
             <p>Status:
            <input type="radio" name="new_old"
                    
                       value="New"  <?php if ($srow['new_old']=="New") { echo "checked";}?>>New
            <input type="radio" name="new_old"
                     
                       value="Old"  <?php if ($srow['new_old']=="Old") { echo "checked";}?>>Old
            </p> 
             
            <!--show description from previous database entry-->
			<p>Description:</p>
          <textarea  label="Description" draggable="false"  name="description" cols="100" rows="10" maxlength="1000" class="textinput" id="description" title="Description" spellcheck="true"><?php echo $srow['description']?></textarea>
<!--Send hidden symptom ID to precessing php page-->		  
          <input type="hidden" name="sym_id" value="<?php echo $srow['sym_id']?>">
	</fieldset>
	
	<p align="center"><input type="submit" name="submit" value="Update" /></p>

</form>
<!--End form-->		   
</div>		   
		 
<br/>



<?php } // End of while loop.
####################################################
} 
			
		
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">Your symptom was not updated due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $sq . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please <a href="view.php">try</a> again.</p><p><br /></p>';
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

<!-- end .content -->
<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>