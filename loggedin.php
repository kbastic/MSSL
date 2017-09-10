<?php 
// The user is redirected here from login.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}

// Set the page title and include the HTML header:
$page_title = 'Home Page';
include ('includes/header.html');

// Print a customized message:
echo "<p>&nbsp;</p>
<h3>Welcome, {$_SESSION['first_name']}!</h3>
";?>
<!--Static html elements for home page (the same for each user)-->
<div class="bluebox">
  <h3 align="center">Instructions</h3></div>

    <p>When living with a chronic disease like Multiple Sclerosis (MS), it is important to record your symptoms on daily basis and have those records ready for your next doctor's visit.</p>
<p>MS Symptoms Log enables you to record your MS symptoms and keep them all in one convenient place. </p>

  <div id="graybox" align="center"><h3>Please call 911 if you are experiencing life-threatening MS symptoms!</h3></div>
  
   <p>To start using MS Symptoms Log, select one of the links below, or click on the navigation bar. </p>
 <div class="support"> 
    <ol>
        <li><a href="log.php">Add new MS Symptom [LOG]</a></li>
        <li><a href="view.php">View MS Symptoms [VIEW]</a></li>
        <li><a href="search.php">Search MS Symptoms [SEARCH]</a></li>
      </ol></div>
    
    <p>&nbsp;</p>
    
<div class="bluebox"><h3 align="center">Important MS Websites and Support Groups</h3></div>


<div class="support">

<ul>
        <li><a href="http://www.mymsaa.org/" target="new">The Multiple Sclerosis Association of America(MSAA)</a></li>
        <li ><a href="http://www.nationalmssociety.org" target="new">National Multiple Sclerosis Society</a></li>
        <li><a href="http://www.msconnection.org/" target="new">MS Connection</a></li>
        <li><a href="http://www.msworld.org/" target="new">MS World</a></li>
        <li><a href="https://www.mslifelines.com/index" target="new">MS Lifelines</a></li>
</ul></div>
    
<p>&nbsp;</p>
<div class="bluebox"><h3 align="center">Privacy Policy</h3></div>

<p>We respect the privacy of our website users. The only identifiable information we collect is your email address and you name. You are not required to disclose your home address, phone and any other sensitive information. </p>
<p>&nbsp;</p>
<div class="bluebox"><h3 align="center">Contact</h3></div>
<p>If you have any questions about our website, please contact <a href="mailto:kbastic@kean.edu">Admin.</a></p>
<?php
//Include HTML footer
include ('includes/footer.html');
?>