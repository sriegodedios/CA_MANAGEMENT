<?php Session_Start(); ?>
<?php 
//check if logged in and valid
$AuthenLevel = $_SESSION['Access'];

if (!isset($_SESSION['username'])){
	echo('you are not logged in! You will be redirected to login page in 3 seconds...');
	header('refresh: 3; http://people.cis.ksu.edu/~krishane/login.php');
	exit();
}



 if ($AuthenLevel!=='1'){
	 if($AuthenLevel!=='2'){
	
			echo('<img src="pictures/no.JPG"></img><br></br>');
			echo('You horrible person how dare you try to tresspass without permission!!!');
			echo('<br></br><strong>ERROR CODE: </strong> E503-'.$AuthenLevel.'');
			exit();
	 }
	
} 
		





if (isset($_SESSION['sendWiD'])){
	unset($_SESSION['sendWiD']);
	unset($_SESSION['sendLN']);
	unset($_SESSION['sendFN']);
	unset($_SESSION['sendRN']);
}











?>

<?php include('include/header_plain.php');?>



 
<div class="nav_by">

	<div class="pname">
		
	
					<li><?php echo ('<a  onclick="return display();">'.$_SESSION['FName'].' '.$_SESSION['LName'].'</a>');?></li>
	
	</div>

	<div class="headertitle">
		<div class="container_main">
			<h1>Package</h1>
		
		</div>
	
	
	</div>
				
	<div class="container">
		
		<div class="nav_byx">
			
		
			</div>
		</div>
		
</div>
<script>
function display() {
	$('#show').toggleClass('hide');
}






</script>

<div class="profile">
<ul id="show" class="hide" >
					<li><a href=""><img src="pictures/Settings.png" style="height:15px;width:20px"></img> Profile Settings</a></li>
					<li><a href="../php/Session_kill.php"><img src="pictures/logout.png" style="height:15px;width:20px"></img> Logout</a></li> 
				</ul>
	<ul id="ksunav">
		<li><a href="home.php"><img src="pictures/dashboard.png" style="height:15px;width:20px"></img> Dashboard</a></li>
	    <li><a href="Package_Registry.php"><img src="pictures/box.png" style="height:15px;width:20px"> Package Registry</a></li>
		<li><a><img src="pictures/guestbook.png" style="height:15px;width:20px"> Guest Book<a></li>
	</ul>
</div>

	<div class="container_home">
		
			
			
	
		
			

		
			
	<div id="page_content" class="defaultpad">
			<div class="container">
			<div id="page_right" style="width:840px; float:left">
				<div class="container_main">
				
						<fieldset class="overide">
							<legend>Package Check</legend>
							<div class="row_center">
								<div class="col-xs-12">
									<div class="container_main">
									<form action="../php/quick_entry_process.php" method="post">
										<label for="id_first_name" class="required">
										Search by Room Number
										</label>
										<input type="text" style="margin-bottom:20px; width:130px;" name="Room_Number" value="" id="ID_Swipe" class="form-control textinput"  autofocus="" >
									
									<input name="Submit1" value="Search Room" type="submit" id="submit_button" class="btn btn-primary" style="display: inline;">
									</form>
								</div>
							</div>
							<div class="row_center">
								<div class="col-xs-12">
									<div class="container_main">
									<form onSubmit="" action="php_process_files/package_registry/manual_search.php" method="post">
										<label for="id_first_name" class="required">
										Manual Search
										</label>
										<input type="text" size="30" style="margin-bottom:20px;" name="LastName" value="" id="ID_Swipe" class="form-control textinput"  onkeyup="showResult(this.value)" placeholder="First and Last Name">
									
									<input <? if(ISSET($_SESSION['dontsend'])){ echo('disabled');} ?> name="Submit" value="Look up Resident" type="submit" id="submit_button" class="btn btn-primary" style="display: inline;<? if(ISSET($_SESSION['dontsend'])){ echo('background-color:#CABEDB;');} ?>">
									</form>
								</div>
							</div>
							
						</fieldset>
				
				</div>
			
				</div>
				<!--Search results-->
				<div id="test" style="width:798px;">
					<div class="container">
<?php
if (isset($_GET['addPackage'])){
										$status = $_GET['addPackage'];
										
										if($status=='failed'){
											echo ('<p style="color:red">Error! Package was not added!</p>');
											
										}else if($status=='success'){
											echo ('<p style="color:green">Package Successfully Added</p>');
											
										}
										
										
									}















if (isset($_GET['manual'])){
	$WiD = $_GET['WiD'];
	$LName = $_GET['LN'];
	$FName = $_GET['FN'];
	$RN = $_GET['dbRM'];
	
echo ('<form action ="http://people.cis.ksu.edu/~krishane/CA_MANAGEMENT/Resident_Package_Profile.php?WiD='.$WiD.'&lastname='.$LName.'&firstname='.$FName.'&RN='.$RN.'" method = "post">');
						
				echo('match found'.$FName.''.$LName.'');	
						echo ('<input type="submit" class="btn btn-primary" name="formSubmit" value ="Submit">');
						echo('</form>');
	
	
	
	
	
	
	
	
}

	
	


if (isset($_SESSION['resultln'])){
	if (isset($_GET['process'])){
		$Process = $_GET['process'];
		if ($Process != "Ok"){
				echo('<h3 style="color:red; font-family:Oswald; text-transform:uppercase;"> No Match Found! Please Try Again</h3>');
			} else if($Process = "Ok") {
				
					$last_name_array = array();
					$first_name_array = array();
					$WiD_array = array(); 
				
					$last_name_array = $_SESSION['resultln'];
					$first_name_array = $_SESSION['resultfn'];
					$WiD_array = $_SESSION['resultWiD'];
					$roomNumber = $_SESSION['resultrn']; 
					//$numberOfResidents = $_SESSION['counter'];
					//echo(sizeof($last_name_array));
				
					$connect = mysql_connect("mysql.cis.ksu.edu", "krishane","insecurepassword") or die('Could not connect: '  . mysql_error());

					mysql_select_db("krishane") or die ('Couldn\'t find db' .mysql_error());
		
					
					if (isset($_SESSION['resultln'])) {
				 
						echo ('<div class="container_results">');
				 
						echo('<label class="look">Here\'s what we found for who lives in room '.$roomNumber.'</label>
				
						');
						echo ('<form action ="php_process_files/package_registry/send_correct_resident_info.php" method = "post">');
						for ($i = 0; $i < sizeof($last_name_array); $i++){
						echo('<input type = "checkbox" name = "index[]" value = "'. $i .'" /> '. $first_name_array[$i] .' '. $last_name_array[$i] . ' <br> </br>');
						}
				
				
						echo ('<input type="submit" class="btn btn-primary" name="formSubmit" value ="Submit">');
						echo('</form>');
						echo ('You can select the resident that matched the information');
						echo ('</div>');
					
				
					}
			}
		}
} else{
	echo ('Standby for search');
	
}
	
		
	
		
					
						
						
						
						
						
?>						
					</div>
						
				</div>
			<div class="containb">
				<form onSubmit="return confirmPost();" action="php_process_files/package_registry/email_function/email_function.php" method="post">
					<fieldset class="overide" style="width:350px;">
						<legend>Send Package Slips</legend>
						<div class="col-xs-12">
							<div class="container_main">
							<div class="alert alert-info">
							<p>Submit notification email to all residents that have packages to pick up.
							<?php
							
							if (isset($_GET['emailSuccess'])){
								$Info = $_GET['emailSuccess'];
								if ($Info='Yep'){
									
								echo('<p style="color:green;"><Strong>STATUS:</Strong>Emails Successfully Sent to residents!</p> </p>');
									
									
									
									
								}
								
								
								
								
								
								
							}
				
							?>
							
							</p>
							</div>
								<input name="initialize_email" onclick="changeButtonColor()" value="Send Email" type="submit" id="submit_Button" class="btn btn-primary">
								<!-- style="display: inline; background-color:#CABEDB;" -->
							</div>
						
						
						
						</div>
					
					
					
					
					</fieldset>
				</form>
				
				<div class="test">
				</div>
				<span class="clear"></span>
			</div>	
				
<script>	

function confirmPost() {
	$('#submit_Button').css('background-color', '#CABEDB');
    var txt;
    var r = confirm("Are you sure you want to send Email?\nThis will send an email to all residents that have a package (if any).\nAlthough you can do this at any time, it is recommended that all packages get logged in the system before submitting\nClick OK to confirm action or Cancel to abort");
    if (r == true) {
		
		document.getElementById("submit_Button").value="Please Wait...";
        return true;
    } else {
		$('#submit_Button').css('background-color', '#512888');
        return false;
    }
	
}
</script>
				
				
				
				
				
				
			</div>

				
			
			<span class="clear"></span>
	
		</div>
	
		 <span class="clear"></span>
	
		</div>
		
	</div>
	
</div>
		

<?php		
if (isset($_POST['search_room'])){
	 if(!$_POST['search_room']) {
    $error['search_room'] = "<p>Please Enter Room Number</p>\n";
	

	
	
	
	
	
	
	
}
	
	
	
}	
	
		
	
	
	
	




?>






<?php include('include/footer_plain.php'); ?>






