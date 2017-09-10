<?php
//This page creates seperate pages for ms symptoms history 
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Needed functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Make the script run only if there is a page number posted to this script
if(isset($_POST['pn'])){
	$rpp = preg_replace('#[^0-9]#', '', $_POST['rpp']);
	$last = preg_replace('#[^0-9]#', '', $_POST['last']);
	$pn = preg_replace('#[^0-9]#', '', $_POST['pn']);
	//Make sure the page number isn't below 1, or more than the last page
	if ($pn < 1) { 
    	$pn = 1; 
	} else if ($pn > $last) { 
    	$pn = $last; 
	}
	// Connect to database
	require ('../../connection/mysqli_connect.php');
	//Set the range of rows to query for the chosen page number
	$limit = 'LIMIT ' .($pn - 1) * $rpp .',' .$rpp;
	//Query the database
	$q = "SELECT * FROM symptoms s JOIN symtype st ON s.type_id = st.type_id WHERE s.user_id ='" . $_SESSION['user_id'] . "' ORDER BY s.start_date DESC $limit";
	$r = mysqli_query($dbc, $q);
	$dataString = '';
if (!mysqli_num_rows($r) == 0) {
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		//Convert new line characters to html line break
		$desc = nl2br($row['description']);
		$each_row = "
		  <table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"10\">
		   
	       <tr>
           <td style=\"text-align:center;\" width=\"2%\">

		   
		  
		   </td>
		   <td>
		   
		   <p><span style=\"font-weight:900\">Onset Date: </span>{$row['start_date']}</p>
		   <p><span style=\"font-weight:900\">Category: </span>{$row['category']}</p>
		   <p><span style=\"font-weight:900\">New/Old: </span>{$row['new_old']}</p>
		   <p><span style=\"font-weight:900\">Severity: </span>{$row['severity']}</p>
	       <p><span style=\"font-weight:900\">Description: </span>{$desc}</p>
		   
		   <div align=\"center\">
		   </br>
		   <form style=\"display:inline-block\" action=\"edit.php\" method=\"post\" id=\"edit_form\">
		   <input type=\"hidden\" name=\"sym_id\" value=\"{$row['sym_id']}\"
		   <p align=\"center\">
		   <input style=\"width:70px\" type=\"submit\" name=\"edit\" value=\"Edit\"></p>
		   </form>
		   &nbsp; &nbsp; &nbsp; &nbsp;
           <form style=\"display:inline-block\" action=\"delete.php\" method=\"post\" id=\"delete_form\">
		   <input type=\"hidden\" name=\"sym_id\" value=\"{$row['sym_id']}\"
		   <p align=\"center\">
		   <input style=\"width:70px\" type=\"submit\" name=\"delete\" value=\"Delete\"></p>
		   </form>
		   
		   </div>
  </td>
		   </tr>
   </table>   
   <hr />
 

";
//Collect results of each row
$dataString = $dataString . $each_row;
	}//end while
} else { // No records!
			$dataString =   "<center><h2>No previous syptoms recorded</h2></center>";
		}
	// Close database connection
    mysqli_close($dbc);

	// Echo the results back to Ajax
	echo $dataString;
	//Bye, bye
	exit();
}