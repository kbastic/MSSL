<?php
//This page will display ms symptoms history
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Needed functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Set the page title and include the HTML header:
$page_title = 'View Symptoms';
include ('includes/header.html');
//Connect to database
require ('../../connection/mysqli_connect.php');


//Get the total count of rows
$sql = "SELECT COUNT(user_id) FROM symptoms WHERE user_id ='" . $_SESSION['user_id'] . "'";
$query = mysqli_query($dbc, $sql);
$row = mysqli_fetch_row($query);
//Total row count
$total_rows = $row[0];
//Specify how many results per page
$rpp = 2;
//Find out the page number of last page
$last = ceil($total_rows/$rpp);
//Last page can't be less than 1
if($last < 1){
	$last = 1;
}
// Close the database connection
mysqli_close($dbc);
?>
<!--This javascript uses Ajax to get query records and create pagination-->
<script>
var rpp = <?php echo $rpp; ?>; // results per page
var last = <?php echo $last; ?>; // last page number
function request_page(pn){
	var results_box = document.getElementById("results_box");
	var pagination_controls = document.getElementById("pagination_controls");
	results_box.innerHTML = "";
	var hr = new XMLHttpRequest();
	<!--start Ajax-->
    hr.open("POST", "pagination_parser.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
		<!--if Ajax return codes are valid-->
	    if(hr.readyState == 4 && hr.status == 200) {
			
			var html_output = hr.responseText;
		    
			results_box.innerHTML = html_output;
	    }
    }
    hr.send("rpp="+rpp+"&last="+last+"&pn="+pn);
	// Change the pagination controls
	var paginationCtrls = "";
    // Only if there is more than 1 page worth of results give the user pagination controls
    if(last != 1){
		if (pn > 1) {
			paginationCtrls += '<button onclick="request_page('+(pn-1)+')">&lt;</button>';
    	}
		paginationCtrls += ' &nbsp; &nbsp; <b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
    	if (pn != last) {
        	paginationCtrls += '<button onclick="request_page('+(pn+1)+')">&gt;</button>';
    	}
    }
	pagination_controls.innerHTML = paginationCtrls;
}
</script>

<div class="content">
<p>&nbsp;</p>
<div class="bluebox"><h2 align="center">MS Symptoms Log History</h2></div>
<!--Ajax results go here!-->
<div id="results_box"></div>
<div align="center" id="pagination_controls"></div>
        <!--get each page-->
		<script> request_page(1); </script>
</div>
<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>