<?php
// Credentials
$dbhost = "phpmyadmin.cis.ksu.edu";
$dbname = "krishane";
$dbuser = "krishane";
$dbpass = "insecurepassword";

// Connection
global $test_db;

$test_db = new mysqli();
$test_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$test_db->set_charset("utf8");

// Check Connection
if ($name_db->connect_errno) {
    printf("Connect failed: %s\n", $test_db->connect_error);
    exit();
}




// Output HTML formats
$html = '<tr>';
$html .= '<td class="small">nameString</td>';
$html .= '<td class="small">compString</td>';
$html .= '<td class="small">zipString</td>';
$html .= '<td class="small">cityString</td>';
$html .= '</tr>';

// Get the search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $test_db->real_escape_string($search_string);
	
$time = "UPDATE query_data SET timestamp=now() WHERE name='" .$search_string. "'";	
	
	
//Count how many times a query occurs 
$query_count = "UPDATE query_data SET querycount = querycount +1 WHERE name='" .$search_string. "'"	
	


// Query 
$query = 'SELECT * FROM Resident_Rooster WHERE LName LIKE "%'.$search_string.'%"';	
	
	
 //Timestamp entry of search for later display
 $time_entry = $test_db->query($time);
 //Count how many times a query occurs
 $query_count = $test_db->query($query_count);
 // Do the search
 $result = $test_db->query($query);
 while($results = $result->fetch_array()) {
 $result_array[] = $results;
 }
 
 // Check for results
if (isset($result_array)) {
foreach ($result_array as $result) { 

// Output strings and highlight the matches
$d_LName = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['LastName']);
$d_FName = $result['FirstName'];
$d_WiD = $result['WiD'];
$d_RN = $result['RoomNumber'];

$o = str_replace('LNameString', $d_LName, $html);
$o = str_replace('FNameString', $d_FName, $o);
$o = str_replace('WiDString', $d_WiD, $o);
$o = str_replace('RNString', $d_RN, $o);
// Output it
echo($o);