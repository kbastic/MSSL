<?php
// This page displays search results with AJAX script
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Set the page title and include the HTML header:
$page_title = 'Search Symptoms';
include ('includes/header.html');
//Connect to database
require ('../../connection/mysqli_connect.php');
//Regular expression - does not work in all browsers
$pattern = "(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))";


?>
<!-- this javascript file uses AJAX to send from and to dates to the server 
and print results--> 
<script language="javascript">

function request_page(){
	var results_box = document.getElementById("results_box");
	var print_box = document.getElementById("print");
	
    var fdate = document.getElementById("fdate").value;
	var tdate = document.getElementById("tdate").value;
	var vars = "fdate="+fdate+"&tdate="+tdate;
    var msg = "Print";
	results_box.innerHTML = "";
	var hr = new XMLHttpRequest();
	<!--Connect to Ajax-->
    hr.open("POST", "search_results.php", true);
	
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
		<!--Ajax codes for successful transaction, results are ready to use-->
	    if(hr.readyState == 4 && hr.status == 200) {
			
			var html_output = hr.responseText;
		    var print_content = "<button onclick=\"printContent('results_box')\">Print</button>";
			var no_records = "There are no records that match your date range";
			var pos = html_output.indexOf(no_records);
			
			results_box.innerHTML = html_output;
			<!--did not find no records msg - show print button-->
			if (pos == -1 ) 
		        print_box.innerHTML = print_content;
			else
			    print_box.innerHTML = "";
	    }
    }
   hr.send(vars);

}
<!--This javascript function will only print search results and ignore the rest of the page-->
function printContent(el){
	              var restorepage = document.body.innerHTML;
	              var printcontent = document.getElementById(el).innerHTML;
	              document.body.innerHTML = printcontent;
	              window.print();
                  document.body.innerHTML = restorepage;
				  
				  alert("Finished printing!");
				  window.location.reload(true);
				  
              }
</script>
<p>&nbsp;</p>
<div class="bluebox"><h2 align="center">Search</h2></div>
<!--Form start-->
<fieldset><legend style="font-size:small">Select date range (YYYY-MM-DD):</legend>
    </br>
    <p>From: <input type="text" id="fdate" name="fdate" maxlength="25" size="25" pattern="<?php echo $pattern; ?>" value="<?php if (isset($_POST['fdate'])) echo $_POST['fdate']; ?>"/>
     <img src="images/cal.gif" onclick="javascript:NewCssCal('fdate', 'yyyyMMdd')" style="cursor:pointer"/>
      &nbsp; &nbsp; &nbsp; &nbsp;
      To: <input type="text" id="tdate" name="tdate" maxlength="25" size="25" pattern="<?php echo $pattern; ?>"value="<?php if (isset($_POST['tdate'])) echo $_POST['tdate']; ?>"/>
     <img src="images/cal.gif" onclick="javascript:NewCssCal('tdate', 'yyyyMMdd')" style="cursor:pointer"/>
     </p> 
</fieldset>
	<p align="center"><input type="submit" name="submit" value="Search" onclick="request_page()" /></p>
<!--Form end-->

<!--Empty field for Ajax results-->
<div id="results_box"></div>
<!--Print button-->
<div align="center" id="print"></div>
</br>

<!--Include HTML footer-->
<?php include ('includes/footer.html'); ?>
