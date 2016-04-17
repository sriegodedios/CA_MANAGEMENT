<?php Session_Start(); ?>
<?php include ('include/header_plain.php');?>
<?php 
//define variables

if (isset($_GET['WiD'])){
	$WiD = $_GET['WiD'];
	$LN = $_GET['lastname'];
	$FN = $_GET['firstname'];
	$RN = $_GET['RN'];
	
	$_SESSION['sendWiD'] = $WiD;
	$_SESSION['sendLN'] = $LN;
	$_SESSION['sendFN'] = $FN;
	$_SESSION['sendRN'] = $RN;
}

if (isset($_GET['So'])){
	$WiD = $_SESSION['sendWiD'];
	$LN = $_SESSION['sendLN'];
	$FN = $_SESSION['sendFN'];
	$RN = $_SESSION['sendRN']; 
	
}





                      ?>
	<div class="nav_by">

	<div class="pname">
		
	
					<li><?php echo ('<a  onclick="return display();">'.$_GET['firstname'].' '.$_GET['lastname'].'</a>');?></li>
	
	</div>

	<div class="headertitle">
		<div class="container_main">
			<h1><?php echo $FN;?> <?php echo $LN;?></h1>
		
		</div>
	
	
	</div>
				
	<div class="container">
		
		<div class="nav_byx">
			
		
			</div>
		</div>
		
</div>
<div class="profile">
<ul id="show" class="hide" >
					<li><a href=""><img src="pictures/Settings.png" style="height:15px;width:20px"></img> Profile Settings</a></li>
					<li><a href="../php/Session_kill.php"><img src="pictures/logout.png" style="height:15px;width:20px"></img> Logout</a></li> 
				</ul>
	<ul id="ksunav">
		
	    <li><a href="Package_Registry.php"><img src="pictures/box.png" style="height:15px;width:20px">Go Back to Package Registry</a></li>
		
	</ul>
</div>

	<div class="container_home">
		
			
			
	
		
			

		
			
	<div id="page_content" class="defaultpad">
		<div class="container" style="margin-left:85px;">
			<div id="page_left" style="width:350px; margin-right:25px; float:left" >
				<img src="pictures/memories.jpg" style="height: 240px; width: 350px;"></img>
					
					<?php echo('<table class="resident" cellspacing="0">
						<tr class="header">
							<th>First Name</th>
							<th>Last Name </th>
							<th>Wild Cat ID</th>
						</tr>
						<tr> 
							<td>'.$FN.'</td>
							<td>'.$LN.'</td>
							<td>'.$WiD.'</td>
						</tr>		
					</table>'); ?>
		
				<form method="post" action="php_process_files/package_registry/add_package.php">	
					<fieldset>
						<legend>Add A Package</legend>
							<div class="container_main" style="margin:10px;">
								<div class="row_center" style="margin-bottom:10px;">
									<label class="required" style="margin-right:5px"> Select the Location:</label>
									<select name="location" style="">
										<option value="S1-11">Shelf 1-11</option>
										<option value="TS">Top Shelf</option> 
										<option value="MS">Middle Shelf</option>
										<option value="BS">Bottom Shelf</option>
										<option value="MR">Mail Room</option>
									</select>
								</div>
								<div class="row_center" style="">
								<div class="alert alert-info">
									<?
										if (isset($_GET['addPackage'])){
										$status = $_GET['addPackage'];
										
										if($status=='failed'){
											echo ('<p style="color:red">Error! Package was not added!</p>');
											
										}else if($status=='success'){
											echo ('<p style="color:green">Package Successfully Added</p>');
											
										}
										
										
									}
									
									
									
									
									?>
									<p>Package Number: <strong><?php
									
									
				

									include('../access/a/b/unauthorized/establish_link.php');
									$rowSQL = mysql_query( "SELECT MAX( Package_Number ) AS max FROM `Package_List`;" );
									$row = mysql_fetch_array( $rowSQL );
									$largestNumber = $row['max'];
									
									$nextPackage = $largestNumber+1;
										
									echo $nextPackage;
									
									
									
									?></strong></p>
								</div>
								</div>
							<input type="hidden" name="package_number" value="<?php echo $nextPackage ?>">
							<input type="hidden" name="WiD" value="<?php echo $WiD; ?>">
							<input class="btn btn-primary" type="submit" name="add_package" value="Add Package">
							
							</div>
						</fieldset>
				</form>
		
		</div>				
		<div id="page_right" style="width:240px; margin-left:25px; float:left">
			<div id="test">
			<legend>Available Packages</legend>
				<?include('include/package_registry/code_for_status_arrived2.php'); ?>
			<span class="clear"></span>
			</div>
		
		
		
		</div>
		<span class="clear"></span>
	</div>
	
	
	</div>
	</div>


<?php include ('include/footer_plain.php');?>