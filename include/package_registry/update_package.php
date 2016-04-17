<?php
SESSION_START();
$FName = $_SESSION['FName'];
$LName = $_SESSION['LName'];
$CA = ("$FName" ." ". "$LName");
echo"working";

include('../../../access/a/b/unauthorized/establish_link.php');
$query = mysql_query("SELECT  * FROM Package_List WHERE Status='Queued' or Status='Arrived'") or die (mysql_error());
$numrows = mysql_num_rows($query) or die (mysql_error());
$option = array();	
$package_array = array();
$WiD_array = array();
$location_array = array();
$index_array = array();
while($row = mysql_fetch_assoc($query)){
	$dbWiD = $row['WiD'];
	$dbPNumber = $row['Package_Number'];
	$dbLocation = $row['Location'];
	$WiD_array[] = $row['WiD'];
						/* $WiD_array[] = $row['WiD']; */
	$location_array[] = $row['Location'];
	$package_array[] = $row['Package_Number'];
	$status_array[] = $row['Status'];
	$index_array[] = $row['Index'];
	} // end while

$info = getdate();
$date = $info['mday'];
$month_i = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];

$fill=2;
$number="";


if ($month_i<=9){
		$number = $month_i;
		
		$month = str_pad($number, $fill, '0', STR_PAD_LEFT);
	} else if($month_i>9){
		$month = $month_i;
		
		
		
	}
	
	
	if ($date<=9){
		$number = $date;
		
		$day = str_pad($number, $fill, '0', STR_PAD_LEFT);
	} else if($date>9){
		$day = $date;
		
		
		
	}
	
$current_date = "$year-$day-$month";
	
	
	
	
	
	
	
	
	if(isset($_POST['update_package'])){
	
		foreach ($_POST['update'] as $value){
			$v = $value;
			updateToRecieved($v, $current_date);			
			updateToOut($value, $current_date);
			updateCAOut($value, $CA);	
		}	
					 
		header('Location:../../Package_Registry.php?change=OK');			
					
					
					
					
					
					
					
	}
			
			
			
			
			
			
			
			
			
			
function updateToRecieved($value, $cd) {
	include('../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("UPDATE `Package_List` SET `Status`='Recieved' WHERE `Index`='$value'") or die (mysql_error());
	
	
	
	
	
	
}			
function updateToOut($value, $cd){
	include('../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("UPDATE `Package_List` SET `Date_Out`='$cd' WHERE `Index`='$value'") or die (mysql_error());
	
	
	
}

function updateCAOut($value, $CA){
	include('../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("UPDATE `Package_List` SET `CA_Out`='$CA' WHERE `Index`='$value'") or die (mysql_error());
	
	
}		
			
		
		
		?>