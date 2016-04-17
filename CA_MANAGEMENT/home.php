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
		



















?>
<?php include('include/header_plain.php');?>
 
<div class="nav_by">

	<div class="pname">
	
					<li><?php echo ('<a  onclick="return display();">'.$_SESSION['FName'].' '.$_SESSION['LName'].'</a>');?></li>
		
</div>
	<div class="headertitle">
		<div class="container_main">
			<h1>Dashboard</h1>
		
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
		<li><a><img src="pictures/dashboard.png" style="height:15px;width:20px"></img> Dashboard</a></li>
		<li><a href="Package_Registry.php"><img src="pictures/box.png" style="height:15px;width:20px"> Package Registry</a></li>
		<li><a><img src="pictures/guestbook.png" style="height:15px;width:20px"> Guest Book<a></li>
	</ul>
</div>

	<div class="container_home">
		
			
			
	
		
			

		
			
		<div id="page_content">
			<div id="page_right" style="width:840px; float:left">
				<h1>Dashboard</h1>
			
			</div>
		
		
			
	
		</div>
	
		 <span class="clear"></span>
	
</div>
		

		

	
	
	
	
	
		
	
	
	
	





<?php include('include/footer_plain.php'); ?>