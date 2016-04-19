<?php
SESSION_START();

$location = $_POST['location'];
$WiD = $_POST['WiD'];
$packageNum = $_POST['package_number']; 
$FName = $_SESSION['FName']; 
$LName = $_SESSION['LName']; 
$CA = ("$FName" ." ". "$LName");
$info = getdate();
	$date = $info['mday'];
	$month_i = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
$time = $_SERVER["REQUEST_TIME"];
	
/* 	if ($date < 10){
		$day= ("0'.$date.'");
		
	} else{
		if (($date > 10)||($date = 10)){
			$day = $date;
			
			
			
			
		}
		
		
	}
	
	if ($month < 10){
		$month= ("0'.$month_i.'");
		
	} else{
		if (($month > 10)||($month = 10)){
			$month = $month_i;
			
			
			
			
		}
		
		
	} */
	
	
	#how many chars will be in the string
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
	
	echo $current_date;

if (isset($_POST['add_package'])){
	if($_POST['add_package']){
		include('../../../access/a/b/unauthorized/establish_link.php');
		$query ="SELECT * FROM List_Package_Resident WHERE WiD = '$WiD' LIMIT 1";
		$result = mysql_query($query);
		if(mysql_num_rows($result)  !== 1){
			mysql_query("INSERT INTO List_Package_Resident (WiD) VALUES ('$WiD')");
			unset($_SESSION['dontsend']);
		
			mysql_close();
		
		}		
	}
	
include('../../../access/a/b/unauthorized/establish_link.php');
	$sql = "INSERT INTO Package_List (WiD, Package_Number, Location, Date_Checked_IN, Unix_In, CA_In) VALUES ('$WiD', '$packageNum', '$location', '$current_date', '$time', '$CA')";

  if (!mysql_query($sql)) {
   header('Location: ../../Resident_Package_Profile.php?addPackage=failed&So=1');
} else{
	
	header('Location: ../../Package_Registry.php?addPackage=success&So=1');
	
	
}   


mysql_close();  
}
 



/* function addIntoTable($WiD){
define('DB_NAME', 'krishane');
define('DB_USER', 'krishane');
define('DB_PASSWORD', 'insecurepassword');
define('DB_HOST', 'mysql.cis.ksu.edu');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
    die('Could not connect: '  . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) {
    die('Can\'t use'. DB_NAME . ': ' .mysql_error());
	
	$sql ="INSERT INTO List_Package_Resident ('WiD') VALUES ('$WiD')";
	
	
if (!mysql_query($sql)) {
    die('Error: '.mysql_error());
}


mysql_close();



}

}




 */



?>