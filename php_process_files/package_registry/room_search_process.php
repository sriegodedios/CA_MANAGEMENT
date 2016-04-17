<?php
$Room = $_POST['Room'];
			#######process form########
			//start arrays// 
			
function setUp(){		
$last_name_array = array();
$first_name_array = array();
$WiD_array = array(); 
}			
			//End Arrays
			
			
		if ($Room){	
			//Connect to Database
			include('../access/a/b/unauthorized/establish_link.php');
			$query = mysql_query("SELECT * FROM Resident_Rooster WHERE RoomNumber='$Room'");
			$numrows = mysql_num_rows($query);
			//Start Query
			if ($numrows!=0){       
				$i = 0;
				//Counter
				while ($row = mysql_fetch_assoc($query)){
					$dbroomnumber = $row['RoomNumber'];
					if ($roomNumber==$dbroomnumber){
						$last_name_array[$i] = $row['LastName'];
						$first_name_array[$i] = $row['FirstName'];
						$WiD_array[$i] = $row['WiD'];
						$i++;
					}
				}
			}
			//End Counter
			if ($roomNumber==$dbroomnumber){
				
				$Processed = "Okay";
				
				header('Location:../../Package_Registry.php?resLN='.$last_name_array.'&resFN='.$first_name_array.'&resWID='.$WiD_array.'&RoomNum='.$Room.'&count='.$counter.'&Process='.$Processed.'');
			
			}	


		 }


//end process post of room number//





















?>