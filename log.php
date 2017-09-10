<?php
// This page will insert records into symptoms table.
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
//Set page title
$page_title = 'MS Symptoms Log';
//Include HTML header
include ('includes/header.html');
//Connect to database
require ('../../connection/mysqli_connect.php');

//Default to today's date
$now = date('Y-m-d');
//Regular expression - does not work in all browsers
$pattern = "(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))";
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	//set error messages
	$user_id = $_SESSION['user_id'];
	if (empty($_POST['type'])) {
		$errors[] = 'Please select symptom type.';
	} else {
		$type = $_POST['type'];
	}
	if (empty($_POST['severity'])) {
		$errors[] = 'Please select symptom severity on a scale from 1 to 5.';
	} else {
		$severity = $_POST['severity'];
	}
	if (empty($_POST['new_old'])) {
		$errors[] = 'Please select if symptom is new or old.';
	} else {
		$new_old = $_POST['new_old'];
	}
	
	// Check for a date:
	if (empty($_POST['date'])) {
		$errors[] = 'You forgot to enter date.';
	} else {
		$date = $_POST['date'];
		
	}
	$desc = "";
	//Apply mysgli real escape string to description text to prevent sql injections
	if (!empty($_POST['description'])) {
		$desc = mysqli_real_escape_string($dbc, trim($_POST['description']));
		}
	if (empty($errors)) { // If everything's OK.
	
		// Make the insert query:
		$q = "INSERT INTO symptoms (user_id, type_id, start_date, new_old, severity, description) VALUES ('$user_id', '$type', '$date', '$new_old', '$severity', '$desc')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '
		</br><center><h2>Your symptom was recorded!</h2></center>
		<p>To View or Edit your symptoms, click <a href="view.php">View</a>. To add another symptom, click <a href="log.php">Log</a>.<br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">Your symptom was not recorded due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
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
		echo '</p><p>Please <a href="log.php">try</a> again.</p><p><br /></p>';
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<div class="content">
<p>&nbsp;</p>
<div class="bluebox"><h2 align="center">Symptoms Log</h2></div>
    
   
    <br/>
<!--begin form-->    
    <form action="log.php" method="post">

	<fieldset><legend style="font-size:small">Enter your symptoms in the form below:</legend>
	
	        </br>
            <p>Onset Date (YYYY-MM-DD): <input type="text" id="date" name="date" maxlength="25" size="25" pattern="<?php echo $pattern; ?>" value="<?php echo $now; ?>"/>
            <img src="images/cal.gif" onclick="javascript:NewCssCal('date', 'yyyyMMdd')" style="cursor:pointer"/></p> 
            <p> Symptoms Type:
            

           <select name="type">
           <?php //get symptom categories from the database and display them as drop-down list
                 $q = "SELECT * FROM symtype";
				 $r = mysqli_query ($dbc, $q);
                while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
                echo "<option value=" . $row['type_id']. ">" . $row['category'] . "</option>";
                           }
            ?>
             </select></p>
            </p>
            <p>Severity: <select name="severity" id="severity">
              <option value="1">1-Mild</option>
              <option value="2">2</option>
              <option value="3">3-Medium</option>
              <option value="4">4</option>
              <option value="5">5-Severe</option>
             </select> </p>
             <p>Status:
            <input type="radio" name="new_old"
                    
                       value="New">New
            <input type="radio" name="new_old"
                     
                       value="Old">Old
            </p> 
             
      <p>
			<p>Description:</p>
          <textarea  label="Description" draggable="false"  name="description" cols="100" rows="10" maxlength="1000" class="textinput" id="description" title="Description" spellcheck="true"></textarea>
		  
          
	</fieldset>
	
	<p align="center"><input type="submit" name="submit" value="Submit" /></p>

</form>
<!--end form-->   
    
<!-- end .content -->
<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>