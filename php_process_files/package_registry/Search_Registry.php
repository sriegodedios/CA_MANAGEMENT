<?php 
$LastName = $_POST['LastName'];




if (ISSET($_POST['LastName'])){
	
	include('../../../access/a/b/unauthorized/establish_link.php');
	$query = mysql_query("SELECT * FROM Resident_Rooster WHERE LastName='$LastName'");
	$numrows = mysql_num_rows($query) or die (mysql_error());;
	
	if ($numrows!=0){
		while($row = mysql_fetch_assoc($query)){
			$dbLN = $row['LastName'];
			$dbFN = $row['FirstName'];
			$WiD = $row['WiD'];
			
			
			
			
			
		}
		echo("<legend>Here is the results for: $dbFN $dbLN </legend><br></br>");
		if ($WiD){
			$query = mysql_query("SELECT  * FROM Package_List WHERE WiD='$WiD'") or die (mysql_error());
			$numrows = mysql_num_rows($query) or die (mysql_error());
			$package_array = array();
			$location_array = array();
			$index_array = array();
			$Date_Recieved = array();
			$status_array = array();
			$Last_Email_Array = array();
			$Date_Out_Array = array();
			
			while($row = mysql_fetch_assoc($query)){
					$location_array[] = $row['Location'];
					$package_array[] = $row['Package_Number'];
					$status_array[] = $row['Status'];
					$index_array[] = $row['Index'];
					$Date_Recieved[] = $row['Date_Recieved'];
					$Last_Email_Array[] = $row['Last_Email'];
					$Date_Out_Array[] = $row['Date_Out'];
			}
			
			
		echo'<table cellspacing="10">';
			echo'<tr>';
		echo'<th>Package</th>';
		echo'<th>Location</th>';
		echo'<th>Date Recieved</th>';
		echo'<th>Status</th>';
		echo'<th>First Name</th>';
		echo'<th>Last Name</th>';
		/* echo'<th>Last Email</th>';
		echo'<th>Date Out</th>'; */
		echo'</tr>';
		echo'<tr>';
	
			$j= 0;
			for ($i = 0; $i < sizeof($package_array); $i++){
			if(($status_array[$i] == "Arrived")||($status_array[$i] == "Queued")){
			
				$status_index_array[$j] = $i;
				echo('<tr>');
				echo('<td>'.$package_array[$i].'</td>');
				echo('<td>'.$location_array[$i].'</td>');
				echo('<td>'.$Date_Recieved[$i].'</td>');
				echo('<td>'.$status_array[$i].'</td>');
				echo('<td>'.$dbFN.'</td>'); 
				echo('<td>'.$dbLN.'</td>'); 
				echo('</tr>');
			}
			
			$j ++;
		}
		echo'</tr>';
		echo'</table>';
		
		} else {
			
			echo ('No packages at this time');
			
			echo'</tr>';
		echo'</table>';
			
			

			/* $j = 0; 
			for($i = 0; $i < sizeof($package_array); $i++){
				$status_index_array[$j] = $i;
				
				
				            
						
				$j++;	
				
			} */
		
			
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}











}



















 ?>






