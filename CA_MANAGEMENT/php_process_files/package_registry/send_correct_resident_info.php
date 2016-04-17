<?php

session_start();

$last_name_array = array();
$first_name_array = array();
$WiD_array = array(); 
$last_name_array = $_SESSION['resultln'];
$first_name_array = $_SESSION['resultfn'];
$WiD_array = $_SESSION['resultWiD'];
$roomNumber = $_SESSION['resultrn'];
$hasProcessed = $_SESSION['HasProcessed'];


if (isset ($_POST['formSubmit'])) {
					foreach ($_POST['index'] as $value){
						$correctIndex = $value;
					}
					$WiD = $WiD_array[$correctIndex];
					$LastName= $last_name_array[$correctIndex];
					$FirstName = $first_name_array[$correctIndex];
					$RoomNumber = $roomNumber;
					unset($_SESSION['resultln']);
					unset($_SESSION['resultfn']);
					unset($_SESSION['resultWiD']);
					unset($_SESSION['resultrn']);
					unset($_SESSION['HasProcessed']);
				
	header('Location:  http://people.cis.ksu.edu/~krishane/CA_MANAGEMENT/Resident_Package_Profile.php?WiD='.$WiD.'&lastname='.$LastName.'&firstname='.$FirstName.'&RN='.$RoomNumber.'');	
					
}





?>