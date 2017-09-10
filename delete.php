<?php
// This page will delete records from symptoms table.
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Needed functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
//Set page title
$page_title = 'Delete Symptom';
//Include HTML header and connect to database
include ('includes/header.html');
require ('../../connection/mysqli_connect.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	//set error messages
	$user_id = $_SESSION['user_id'];
	if (empty($_POST['sym_id'])) {
		$errors[] = 'An error has occured';
	} else {
		$sym_id = $_POST['sym_id'];
	}
	
	
	if (empty($errors)) { // If everything's OK.
	
		// Make the delete query:
		$q = "DELETE FROM symptoms WHERE sym_id='$sym_id' AND user_id='$user_id'";
			
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '
		</br><center><h2>Your record was deleted!</h2></center>
		<p>To View or Edit your symptoms, click <a href="view.php">View</a>. To add another symptom, click <a href="log.php">Log</a>.<br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">Your symptom was not deleted due to a system error. We apologize for any inconvenience.</p>'; 
			
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