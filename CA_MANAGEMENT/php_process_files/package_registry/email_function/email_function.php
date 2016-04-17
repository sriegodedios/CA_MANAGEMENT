<html>
<header>
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

<link href='../../../common/style.css' rel='stylesheet' type='text/css'>
</header>	
	
	
	<body>
	<div class="container_main">
		<div class="dialogue">
			<div class="container_main">
			<h1>Loading Please Wait</h1>
			<img src="../../../pictures/loading.gif" style="weight:100px; height:100px"></img>
			</div>
		</div>
	</div>	
	</body>
	

	
	
	
	

</html>
<?php 

if(isset($_POST['initialize_email'])){
#########REQUEST TIME FROM SERVER##########	
	//initialize the time function 
	$info = getdate();
	$day = $info['mday'];
	if ($day < 10){
		$day = '0'.$day.'';
		
	}
	$month = $info['mon'];
	if ($month < 10){
		$month = '0'.$month.'';
		
	}
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	
	
	$current_time = "$hour:$min";
	$current_date = "$year-$day-$month";
	echo $current_date;
	$WiD_Array_PL= array();
	$WiD_Array = array();
	
	//start database connection
	include('../../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("SELECT * FROM List_Package_Resident ");
	/* $i = 0; */
	while ($row = mysql_fetch_assoc($query)){
	
		$WiD_Array[] = $row['WiD'];
		$index_array[] = $row['Index'];
	
		/* $i++; */
	}
	mysql_close();

	/* array $sort_WID_array(array $WiD_Array_PL[, int $sort_flags = SORT_STRING]);
	 */
/* 	$WiD_Array_PL = array_unique($WiD_Array_PL); */
	

	
	/* for ($i = 0; $i < sizeof($WiD_Array); $i++){
		 
		echo ''.$WiD_Array[$i].'<br>';

	
		
		
		$i++;
		
	} */
	
	foreach ($WiD_Array as $value){
		$v = $value;
		echo'here';
		echo '<br>'.$value.'';
		$WiD_To_Lookup = $value;
		getEmailResident($WiD_To_Lookup);
		sleep(5); 
	}
	
	
	
	

	clearTableContents($Array_of_WiD);
	
	
	
			
			
			
			
			
			
			
			
			
			
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
			session_start();
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
$current_date = "$year-$day-$month";


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
		if($status_array[$i] == "Queued") {
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
		$query = mysql_query("UPDATE Package_List SET Last_Email='$current_date' WHERE WiD='$WiDRef'") or die (mysql_error());    
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
	} // end while
	
	foreach ($status_array as $value){
		$query = mysql_query("UPDATE Package_List SET Status='Arrived' WHERE WiD='$WiDRef'") or die (mysql_error()); 
		
		
		
		
		
		
		
	}
	
	
	
	
	
}






















?>