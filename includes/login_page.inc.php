<?php 
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include page title and the header:
$page_title = 'Login';
include ('includes/header.html');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Display the form:
?>
<p>&nbsp;</p>
<div class="bluebox"><h2 align="center">Login</h2></div>

<fieldset><legend style="font-size:small">Enter your information in the form below:</legend>
<form action="login.php" method="post">
    </br>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>Password: <input type="password" name="pass" size="20" maxlength="20" /></p>
</fieldset>
	<p align="center"><input type="submit" name="submit" value="Login" /></p>
</form>

<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>