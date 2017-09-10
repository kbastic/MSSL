<?php
// This page retreives search results from database.
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Set the page title and include the HTML header:
$page_title = 'Search Results';
//Connect to database
require ('../../connection/mysqli_connect.php');?>
<?php 

$user_id = $_SESSION['user_id'];

	  //If from date is blank, set it to 1920
	  if ($_POST['fdate'] === '') 
		  {   $f_date = "19200101"; }
	  else 
		  {$f_date = $_POST['fdate'];};
	  //If to date is blank, set it to 2050
	  if ($_POST['tdate'] === '') 
		  {   $t_date = "20500101"; }
	  else 
		  {$t_date = $_POST['tdate'];};

//Select only records with specified date range, for blank date range, retreive all records
$q = "SELECT * FROM symptoms s JOIN symtype st ON s.type_id = st.type_id WHERE s.user_id ='{$user_id}' AND s.start_date BETWEEN '{$f_date}' AND '{$t_date}' ORDER BY s.start_date DESC";
####################################################


$r = mysqli_query ($dbc, $q);
$dataString = '';?>
<!-- Create Search Results Header-->
<div class="content" id="content">
  <p>&nbsp;</p>
  <div class="bluebox">
    <h2 align="center">Search Results</h2>
  </div>

<?php
if (!mysqli_num_rows($r) == 0) {
	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) 
	{
	//Convert new line characters to html line break
	$desc = nl2br($row['description']);
	//Record each row
	$each_row = "
			   <table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"10\">
			   <tr>
			   <td style=\"text-align:center;\" width=\"2%\">
			   </td>
			   <td>
			   
			   <p><span style=\"font-weight:900\">Start Date: </span>{$row['start_date']}</p>
			   <p><span style=\"font-weight:900\">Type: </span>{$row['category']}</p>
			   <p><span style=\"font-weight:900\">New/Old: </span>{$row['new_old']}</p>
			   <p><span style=\"font-weight:900\">Severity: </span>{$row['severity']}</p>
			   <p><span style=\"font-weight:900\">Description: </span>{$desc}</p>
			   </br>
			   </td>
			   </tr>
	   </table>   
	   <hr />
	 
	";
	//Results
	$dataString = $dataString . $each_row;
	
	} // End of while loop.
	####################################################
?>
<?php } else { // No records!
			$dataString =  "<center><h2>There are no records that match your date range</h2></center>";
		}
?>
</div>
</br>
<?php
//Close database
mysqli_close($dbc);
//Send formated results back to the search page
echo $dataString;?>
</br>
