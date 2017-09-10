<?php 
// This script performs an INSERT query to add a record to the users table - register user.
//Set title page
$page_title = 'Register';
//Include HTML header
include ('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('../../connection/mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...it's a client
		
		// Make the insert query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date, role) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), 'USER')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered.</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
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
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<div class="content">
<p>&nbsp;</p>
<div class="bluebox"><h2 align="center">Register</h2></div>
    
   
  
    <br/>
<!--Begin form-->    
    <form action="register.php" method="post">

	<fieldset><legend style="font-size:small">Enter your information in the form below:</legend>
	
	        </br>
            <p>
				<label for=firstname class=label>First Name:</label>
				<input class="textinput" id="first_name" type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" >
			</p>
			<p>
				<label for=lastname class=label>Last Name:</label>
				<input id="last_name" type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
			</p>
			
	          <p>Select Your ID:</p>
	          <p><label for=user_name class=label>Email: <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></label></p>
	
	<p><label for=password class=label>Password: <input type="text" name="pass1" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"/></label></p>
	
	<p><label class=label>Confirm Password: <input type="text" name="pass2" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"/></label></p>
	
	</fieldset>
	
	<p align="center"><input type="submit" name="submit" value="Register" /></p>

</form>
<!--End form-->   
    
<!-- end .content -->
<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>