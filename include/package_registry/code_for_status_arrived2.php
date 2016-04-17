


<?php
		//Search Database for available packages
		$package_array = array();
		include('../access/a/b/unauthorized/establish_link.php');
		$query = mysql_query("SELECT * FROM Package_List WHERE WiD='$WiD'");
		$numrows = mysql_num_rows($query);
		$package_array = array();
		$location_array = array();
		$status_array = array();
		$index_array = array();
		$datt_array = array();
		$index_counter_array = array();
		$i = 0;
		//$package_array[] = $row['Package_Number'];
	
	
	
	
		echo ('<table class="resident_s" style="width: 125px;">');
				echo ('<tr>');
							echo ('<th>Package Number</th>');
							echo ('<th>Location</th>');
							echo('</tr>');
							echo('<tr>');
		/* while($row = mysql_fetch_array($query)){
			echo('<tr><td>'.$row['Package_Number'].'</td></tr>');
		
		}
				echo ('</tr>');
			echo ('</table>') */
		/* for ($i = 0; $i < $numrows; $i++){
			echo $query[$i];*/
		while($row = mysql_fetch_assoc($query)){
				$package_array[$i] = $row['Package_Number'];
				$location_array[$i] = $row['Location'];
				$status_array[$i] = $row['Status'];
				$_index_array[$i] = $row['Index'];
				$datt_array[$i] = $row['Date_Recieved'];
	
				$i++;
				/*  foreach ($row['Index'] as $value){
					$counter_array = $value;
					
				} */
				}	
		if($numrows!=0){	
			
			
		
	
		$j = 0;	
		
		
	
		for ($i = 0; $i < sizeof($package_array); $i++){
			if(($status_array[$i] == "Arrived")||($status_array[$i] == "Queued")){
			
				$status_index_array[$j] = $i;
				echo('<tr>');
				echo('<td>'.$package_array[$i].'</td>');
				echo('<td>'.$location_array[$i].'</td>');
				echo ('<td><select name="update[]"><option value>Arrived</option><option value="'.$_index_array[$i].'">Recieved</option></select></td>');
				echo('</tr>');
		
			}
			
			
			$j ++;
		} 
				
		
		
		echo'</tr>';
		echo'</table>';
	
			echo'<input class="btn btn-primary" type="submit" name="update_package" value="Update Package">';
		
		} else {
			
			echo ('No packages at this time');
			
			echo'</tr>';
		echo'</table>';
		}
			
		
		?>
		
		
		
		