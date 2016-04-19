<?php
function validatePackageDate(){
	include('../../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("SELECT * FROM users_main WHERE Status='Arrived'");
	$current_time = $_SERVER["REQUEST_TIME"]; 
	$set_time = 432000;
	while($row = mysql_fetch_assoc($query)){
		$time =  $row['Unix_In'];
		$delta_time =$current_time-$time;
		
		if($delta_time>$set_time = 432000){
			$query = mysql_query("UPDATE Package_List SET Status='Arrived'");
			
		}
		
		
		
		
		
		
		
	}
	mysql_close();
	
	
	
	
	
	
	
	
	
	
	
}	
	
function getEmailResident($WiD_To_Lookup){
		
		$Array_of_WiD = $WiD_To_Lookup;
		
		
		
		include('../../../../access/a/b/unauthorized/establish_link.php');
		$query = mysql_query("SELECT * FROM users_main WHERE WiD='$Array_of_WiD'");
		
		
		if($Array_of_WiD){
				
			while($row = mysql_fetch_assoc($query)){
				$FName_Array = $row['FName'];
				$LName_Array = $row['LName'];
				$Email_Array = $row['Email'];
				
			}
			
				
			
			getListofAllPackages($Array_of_WiD, $FName_Array, $Email_Array);
			$_SESSION['dontsent'] = 'DoNOT';
			header('Location:../../../Package_Registry.php?emailSuccess=Yep');
			
		}
			
			
	}	
	
	
	
	
	
	
function getListofAllPackages($Array_of_WiD, $FName_Array, $Email_Array){
	$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];

$current_time = "$hour:$min";



if ($current_time>'0:00'&&$current_time<'10:59'){
	$time_period = "Morning";
	
}else if($current_time>'11:00'&&$current_time<'14:59' ){
	$time_period = "Afternoon";
	
} else if($current_time>'15:00'&&$current_time<'23:59'){
	$time_period = "Evening";
	
}
	$WiDRef	= $Array_of_WiD;
	$dbEmail = $Email_Array;
	$dbFName = $FName_Array;
	include('../../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("SELECT * FROM Package_List WHERE WiD='$WiDRef'");
	$numrows = mysql_num_rows($query);
	if($WiDRef){
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
	 }
	 
	 $to      = "$dbEmail";
	 $subject = 'Package Available for Pick-Up';
	 $body = "Good $time_period $dbFName, <br></br>";
	 $body .= "According to our records, it appears you have package(s) available for pick up at the front desk:<br></br>";
	 $body .= '<table><tr><th>Packages Number</th><th>Package ID</th></tr>';
	 $status_index_array = array();
	 $body .= '<tr>';
	 $j = 0; 
	for($i = 0; $i < sizeof($package_array); $i++){
		if($status_array[$i] == "Queued" ) {
			$status_index_array[$j] = $i;
				            
						
				$j++;	
			}
		}
		
	foreach($status_index_array as $value) {
		$body .= '<tr>';
		$body .= '<td>'.$package_array[$value].'</td>';
		$body .= '<td>'.$location_array[$value].'</td>';
		$body .= '</tr>';
	}
	
	$_SESSION['$setValue'] = $status_index_array;
		
		
		
	 $body .='</table>';
	 
	 
	 
	 
	 $headers = 'From:krishane@ksu.edu' . "\r\n" .
	 $headers .="Reply-to: Do not Reply\r\n";
	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-type: text/html; charset=ISO-8859\r\n";

		
	
	 if(mail($to, $subject, $body, $headers)){
        echo "The email($dbEmail) was successfully sent.";
		updateStatusOfPackagesToArrived($WiDRef);
		mysqli_close($connect);
		
    } else {
        echo "The email($dbEmail) was NOT sent.";
		
    }
	 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
	



function clearTableContents() {
	include('../../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("TRUNCATE List_Package_Resident") or die (mysql_error()); 
	
	$numrows = mysql_num_rows($query) or die (mysql_error());
	
	
	echo('All rows deleted');
	
	
	
	
	
}


function updateStatusOfPackagesToArrived($WiDRef){
	$info = getdate();
	$date = $info['mday'];
	$month_i = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	
	$fill = 2;
	#the number
	$number = "";
	#with str_pad function the zeros will be added
	//str_pad($number, $fill, '0', STR_PAD_LEFT);
	// The result: 0[n]
	
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
	
	$current_time = "$hour:$min";
	$current_date = "$year-$day-$month";
	
	
	
	include('../../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("SELECT * FROM Package_List WHERE Status='Queued'") or die (mysql_error());
	$numrows = mysql_num_rows($query) or die (mysql_error());
	
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
		echo  $row['Index'];
		$query = mysql_query("UPDATE Package_List SET Status='Arrived', Last_Email='$current_date' WHERE Index='".intval($row['Index'])."'") or die (mysql_error()); 
	} // end while
	
	
	foreach ($status_array as $value){
	
	
		//$query = mysql_query("UPDATE Package_List SET Status='Arrived' WHERE WiD='$WiDRef'") or die (mysql_error()); 
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
}






















?>