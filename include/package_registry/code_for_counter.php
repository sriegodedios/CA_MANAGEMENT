<?php
$package_array = array();

$package_array = array();
$location_array = array();
$status_array = array();
$index_array = array();
$datt_array = array();
$index_counter_array = array();
$i = 0;

$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	
	
	$current_time = "$hour:$min";
	$current_date = "$year-$date-$month";

include('../access/a/b/unauthorized/establish_link.php');
$query = mysql_query("SELECT * FROM Package_List WHERE Date_Checked_IN ='$current_date'");
$numrows = mysql_num_rows($query);

echo ('<table class="resident_s" style="width: 125px;">');
				echo ('<tr>');
							echo ('<th>Package Number</th>');
							echo ('<th>Location</th>');
							echo('</tr>');
							echo('<tr>');

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
			
		
		//  sizeof($package_array)
		$start = sizeof($package_array) - 5;
		if($start < 0)
		{
			$start = 0;
		}
		
		for ($i = $start; $i < sizeof($package_array); $i++){
			if(($status_array[$i] == "Arrived")||($status_array[$i] == "Queued")){
			
				$status_index_array[$j] = $i;
				echo('<tr>');
				echo('<td>'.$package_array[$i].'</td>');
				echo('<td>'.$location_array[$i].'</td>');
				echo('</tr>');
			}
			
			$j ++;
		}
		echo'</tr>';
		echo'</table>';
		
		}




?>