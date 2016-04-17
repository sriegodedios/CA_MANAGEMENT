<?php Session_Start(); 
$package_array = $_SESSION['Package_Arrayses']; 
$location_array = $_SESSION['Location_Arrayses']; 
$status_array= $_SESSION['Status_Arrayses'];
$_index_array = $_SESSION['Index_Arrayses'];
$datt_array = $_SESSION['Date_Array'];
/* $correct_array = $_SESSION['Index_Count'];  */




?>
<?php include ('../CA_MANAGEMENT/include/header.php'); ?>
<div id="page_content">
	<div class="container">
		<div id="page_right">
			<h1>Available Package(s)</h1>
			<?php 
				$j = 0;
				$s = 1;
				for ($i = 0; $i < sizeof($package_array); $i++){
						
					
					if($status_array[$i] == "Arrived") {
						$status_index_array[$j] = $i;
						echo ('<div class="selection">
							<div class="row_selection">
								<div class="number">
								<h1>'.$s.'</h1>
								</div>
								<div class="packagenum">
								<h1>'.$location_array[$i].'</h1>
								</div>
								<div class="date">
								<h1>'.$datt_array[$i].'</h1>
								</div>
								
								
								<span class="clear"></span>
								<input type="checkbox" value = "'. $_index_array[$i].'"><br></br> 
							</div>
						</div>
						');
						
						/* echo ('<tr>');
								echo('<td>'.$_index_array[$i].'</td>');
								echo('<td>'.$package_array[$i].'</td>');
								echo('<td>'.$location_array[$i].'</td>');
								echo('<td>
										<select name= "status[]">
										<option value= "Arrived" selected>Arrived</option>
										<option value= "Recieved">Recieved</option>
										</select>
								
										</td>');
								
					echo ('</tr>');	 */
					$j ++;
					$s ++;
					}
				}
			?>
			
			
		<input type="checkbox">
	
			<span class="clear"></span>
		
		</div>
		<div id="page_left">
		<form action="../php/update_status_recieved.php" method="post"> 
			<input name="Submit" value="Check Out Everything" type="submit" onclick="goToAction('saveBaseInfo');return false;" id="submit_button" class="btn btn-primary" style="display: inline;">
		</form>	
		
		
		
		
		</div>
		<span class="clear"></span>
	</div>
</div>







</div>
<script>
$('.selection').on('click', function(e){
  e.preventDefault();
  $(this).css('border','2px solid red');
});

$(".selection").live("click",function() {
    var checkbox = $(this).find("input[type='checkbox']");

    if( checkbox.attr("checked") == "" ){
        checkbox.attr("checked","true");
    } else {
        checkbox.attr("checked","");
    }
});

$('div.selection input[type=checkbox]').click(function(e){
        e.stopPropagation();
});


</script>

<?php include ('../CA_MANAGEMENT/include/footer.php'); ?>