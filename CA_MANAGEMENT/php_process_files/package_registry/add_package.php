<?php
SESSION_START();

$location = $_POST['location'];
$WiD = $_POST['WiD'];
$packageNum = $_POST['package_number']; 
$CA = $_SESSION['FName']. ''. $_SESSION['LName']; 

$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	
	
	$current_time = "$hour:$min";
	$current_date = "$year-$date-$month";
	

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
	$sql = "INSERT INTO Package_List (WiD, Package_Number, Location, Date_Checked_IN, CA_In) VALUES ('$WiD', '$packageNum', '$location', '$current_date', '$CA')";

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