<?php
		//Search Database for available packages
		$package_array = array();
		include('../access/a/b/unauthorized/establish_link.php');
		$query = mysql_query("SELECT * FROM Package_List WHERE WiD='$WiD'");
		$numrows = mysql_num_rows($query);
		
		//$package_array[] = $row['Package_Number'];
		
		echo ('<table class="resident_s" style="width: 125px;">');
				echo ('<tr>');
							echo ('<th>Package Number</th>');
							echo('</tr>');
							echo('<tr>');
		while($row = mysql_fetch_array($query)){
			echo('<tr><td>'.$row['Package_Number'].'</td></tr>');
		
		}
				echo ('</tr>');
			echo ('</table>')
		/* for ($i = 0; $i < $numrows; $i++){
			echo $query[$i];
			
			
			
			
		} */
		
		
		
		//###############################################
		//Start Query Database
		/* if ($numrows!=0){
		echo ('
				
					<table class="staffTable" cellspacing="0">
						<tr>
							<th>Index</th>
							<th>Package Number</th>
							<th>Location</th>
							<th>Status</th>
						</tr>');
		//Initial Table Setup#############################
		echo('<form method = "post">');
				$status_index_array = array();
				$j = 0;
				for ($i = 0; $i < sizeof($package_array); $i++){
					if($status_array[$i] == "Arrived") {
						$status_index_array[$j] = $i;
						echo ('<tr>');
								echo('<td>'.$index_array[$i].'</td>');
								echo('<td>'.$package_array[$i].'</td>');
								echo('<td>'.$location_array[$i].'</td>');
								echo('<td>
										<select name= "status[]">
										<option value= "Arrived" selected>Arrived</option>
										<option value= "Recieved">Recieved</option>
										</select>
								
										</td>');
								
					echo ('</tr>');	
					$j ++;
					}					
				} 
		
		echo ('<input type="submit" " name="formSubmit" value = "Submit">');
				echo('</form>');
				echo ('</table>');
					if (isset ($_POST['status'])){
					$new_status_array = array();
					$new_status_array = $_POST['status'];
					for ($i = 0; $i < $j; $i++){
					if($new_status_array[$i] == "Recieved") {
						$status_array[$status_index_array[$i]] = "Recieved";
						echo ($status_array[$status_index_array[$i]]);
					}
				}
					}
		
		
		echo ('<input type="submit" " name="formSubmit" value = "Submit">');
				echo('</form>');
				echo ('</table>');
		} */
		
		
		?>