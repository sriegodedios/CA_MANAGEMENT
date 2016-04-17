<?php
require_once 'database.php';

	// Display 5 most recent search items
	$query = "SELECT * FROM Resident_Rooster c INNER JOIN query_data q ON c.LNname = q.name ORDER BY querycount DESC LIMIT 5";
	
	// The search
	$result = $test_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}
	
	foreach ($result_array as $result) {
		// The output
		echo '<tr>';			
		echo '<td class="small">'.$result['name'].'</td>';
		echo '<td class="small">'.$result['company'].'</td>';
		echo '<td class="small">'.$result['zip'].'</td>';
		echo '<td class="small">'.$result['city'].'</td>';
		echo '</tr>';	
	}
?>