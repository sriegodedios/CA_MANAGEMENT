<?php
session_start();
$String = $_POST['LastName'];
;




if ($_POST['Submit']){
	 list($first, $last)= explode(" ", $String);
	// preg_split('/=/', $data, -1){
		
		
		
	}
	/* /* {
		$FName = $matches[1];
		$LName = $matches[3];
	
	
	
/* 	echo ($AccountNum);
	echo ('<br></br>');
	echo ($Verify); */

	
		include ('../../../access/a/b/unauthorized/establish_link.php');
		$query = mysql_query("SELECT * FROM Resident_Rooster WHERE FirstName='$first'");
		$numrows = mysql_num_rows($query);
				
				if ($numrows!=0){
					while ($row = mysql_fetch_assoc($query)){
						$dbFN = $row['FirstName'];
						$dbLN = $row['LastName'];
						$dbWiD = $row['WiD'];
						$dbRM = $row['RoomNumber'];
					}
					if ($first==$dbFN&&$last==$dbLN){
						
						header('Location:../../Package_Registry.php?WiD='.$dbWiD.'&LN='.$dbLN.'&FN='.$dbFN.'&dbRM='.$dbRM.'&manual=1');
						
						
						
						
						
					}
					
				}	
				
				
				?>	
?>				