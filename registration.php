
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS: <? echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href='css/custom.css' rel='stylesheet' type='text/css'>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php
	
	// some canned functions

	function isValidEmail($Email) {
		//return (filter_var($Email, FILTER_VALIDATE_Email));
		return preg_match("/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z]{2,}$/", $Email);
	}
	
	function isValidName($str, $len = 3) {
		$pattern = "/^[a-zA-Z]{".$len.",}/";
		return preg_match($pattern, $str);
	}
	
	function strFilter($str, $param) {
		$filter = "";
		
		if (strstr($param, ".")) { $filter .= "\."; }
		if (strstr($param, "@")) { $filter .= "@"; }
		if (strstr($param, "L")) { $filter .= "a-zA-Z"; }
		if (strstr($param, "#")) { $filter .= "0-9"; }
		if (strstr($param, "_")) { $filter .= "_"; }
		if (strstr($param, "-")) { $filter .= "\-"; }
		if (strstr($param, "S")) { $filter .= " "; }
		if (strstr($param, "$")) { $filter .= "$"; }
		
		$pattern = "/[^".$filter."]+/";
		return preg_replace($pattern, "", $str);
	}

	// -----------------------------------
	
	// form variables
	
	$FName = $LName = $Email = $DOB = $Gender = $Current_YR = $WiD = $eID = $errList = "";
	$Gender = "none";

	if ( isset($_POST['FName']) ) 		{ $FName = strFilter($_POST['FName'], 'L'); }
	if ( isset($_POST['LName']) ) 		{ $LName = strFilter($_POST['LName'], 'L-'); }	
	if ( isset($_POST['Email']) ) 			{ $Email = strFilter($_POST['Email'], 'L@.-#'); }
	if ( isset($_POST['DOB']) ) 		{ $DOB = $_POST['DOB']; }
	if ( isset($_POST['gender']) ) 		{ $Gender = $_POST['gender']; }
	if ( isset($_POST['Current_YR']) ) 			{ $Current_YR = $_POST['current_year']; }
	if ( isset($_POST['WID']) )		{ strFilter($WID = $_POST['WID'], "#"); }
	if ( isset($_POST['eID']) ) 		{ $eID = strFilter($_POST['eID'], 'L#-S$'); }

	
	// -----------------------------------
	
	// ...................................
	// validation, if form is submitted

	if ( isset($_POST['submit']) ) {
		
		if (!isValidName($FName, 3)) {
			$errList .= "<li>First Name</li>";			
		}
		
		if (!isValidName($LName, 4)) {
			$errList .= "<li>Last Name</li>";			
		}

		if ( (empty($Email)) || (!isValidEmail($Email)) ) {
			$errList .= "<li>Valid Email</li>";
		}
		
		if ($errList != "") {
			$errList = "<ul>". $errList ."</ul>";
		} else{
			Session_Start();
			$Registration_Array = Array($FName, $LName, $Email, $DOB, $Gender, $Current_YR, $WiD, $eID);
			$_SESSION['Register1_Array'] = $Registration_Array;
				header("Location:registration_password.php");
			
			
			
			
			
			
		}
	}
		
		?>
	

	  <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		
			<div id="banner">
				<div class="container">
					<div class="watermark">
				<div class="wordmark">
				</div>
				</div>
				</div>
				</div>
		</nav>
		<div id="page-wrapper">
			 <div class="container-fluid">
				<div class="row">
					<div class="col-md-8 col-sm-offset-2">
					<div id="formpage_1"  style="visibility: visible; display: block; .."> 
					<div class="alert alert-info">
						<p>All future or current residents must have a KSU resident account to access resident resources such as mail, room assignments, and payments. This will NOT register you for your eID. 
					</div>
					<div id="errNote" class="<?php if ($errList == ""){ echo "hide";}?>"><i class='fa fa-warning' style='font-size: 50px;'></i><p><strong> Please provide the following:</strong></p><?php echo $errList; ?></div>
					<form action="?" method="post">
					
						<fieldset class="overide">

							<legend>Personal Information</legend>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>First Name</label>
											<input type="text" id="first_name" name="FName" placeholder="Firstname..." class="form-password form-control" id="form-password" value="<? if (isset($_POST['FName'])){ echo $FName;} ?>" required> 
										</div>
									</div>
									<div class="help col-xs-12 col-md-6">
										<p>Given Name</p>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Lastname</label>
											<input type="text" id="last_name" name="LName" placeholder="Lastname..." class="form-password form-control" id="form-password" value="<?if (isset($_POST['FName'])){ echo $LName;}?>" required> 
										</div>
									</div>
									<div class="help col-xs-12 col-md-6">
										<p>Given Name</p>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Date of Birth</label>
											<input type="date" id="birthday" name="DOB" placeholder="Firstname..." class="form-password form-control" id="form-password"> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label for="id_gender">Gender</label>
											<ul class="unstyled">
												<li>
													<input type="radio" name="gender" value="M" id="id_male">
													<label class="gender" for="id_male">Male</label>
												</li>
												<li>
													<input type="radio" name="gender" value="F" id="id_male">
													<label class="gender" for="id_male">Female</label>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label for="Year">Accademic Standing</label>
											<select name="current_year" class="form-select form-control">
												<option value>Current Standing</option>
												<option value="Freshman">Freshman</option>
												<option value="Sophmore">Sophmore</option>
												<option value="Junior">Junior</option>
												<option value="Senior">Senior</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Email</label>
											<input type="text" id="email" name="Email" placeholder="Firstname..." class="form-password form-control" id="form-password"> 
										</div>
									</div>
									<div class="help col-md-12 col-md-6">
										<h2 class="help__title">Email</h2>
										<p class="help__info">To recieve a confirmation Email so we know you're the person requesting the account.</p>
									</div>
									
								</div>
								
						</fieldset>
						 <input type="button" class="btn btn-primary1" value="Next" onclick="checkForm(); ">
						<!-- <input type="submit" name="submit" class="btn btn-primary1"> -->
						</div>
						<div id="formpage_2"  style="visibility: hidden; display: none; ..">
						<div class="alert alert-warning">
						<div class="row">
						<div class="col-md-12">
						<div class="col-md-12 col-md-offset-2">
						<div class="row">
						<p>Are you currently registered at K-State? (Recently Accepted Counts Too)
						</div>	
							
						<div class="row">	
							<div class="col-md-12">
								<div class="container-fluid">
								
								<div class="row">
								<input type="button" class="btn btn-primary col-md-7 col-sm-12" value="YES" onclick="pagechange(1,3);">
								</div>

								<div class="row">
									<input type="button" class="btn btn-danger col-md-7 col-sm-12" value="NO" onclick="pagechange(1,3);">
								</div>
								</div>
								</div>
						</div>
						</div>
						</div>
						</div>
						<div id="formpage_3"  style="visibility: hidden; display: none; ..">
					<fieldset class="overide">
							<legend>K-State Account Information</legend>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Wildcat ID</label>
											<input type="text" name="WiD" placeholder="Firstname..." class="form-password form-control" id="form-password"> 
										</div>
									</div>
									<div class="help col-xs-12 col-md-6">
										<h2 class="help__title">Wildcat ID</h2>
										<p class="help__info">The Wildcat ID is an 8 digit number that is unique to every student. THis can normally be found at the top-left of your ID card.</p>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>eID</label>
											<input type="text" name="eID" placeholder="eID" class="form-password form-control" id="form-password"> 
										</div>
									</div>
									<div class="help col-xs-12 col-md-6">
										<h2 class="help__title">eID</h2>
										<p class="help__info">The eID is what is used to access many of campus resources on campus. Normally, you just sync the information but if your a new student, you must do this form process </p>
									</div>
								</div>
						</fieldset>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary1">
						</div>
					
					</form>
				 </div>
		
		
		</div>
       
        <!-- /#page-wrapper -->
		</div>
    </div>
    <!-- /#wrapper -->

<script>
object.onclick=function(){formValidationTransiston};


function formValidationTransiston(){

if ( !checkForm() ){
	return false;
} else{		
var page=document.getElementById('formpage_1');
  if (!page) return false;
  page.style.visibility='hidden';
  page.style.display='none';

  page=document.getElementById('formpage_2');
  if (!page) return false;
  page.style.display='block';
  page.style.visibility='visible';

  return true;
}
  
	
	  
	  
}


function pagechange(frompage, topage) {
  var page=document.getElementById('formpage_'+frompage);
  if (!page) return false;
  page.style.visibility='hidden';
  page.style.display='none';

  page=document.getElementById('formpage_'+topage);
  if (!page) return false;
  page.style.display='block';
  page.style.visibility='visible';

  return true;
}  
  
function checkForm(){
	errList = "";
	focusField = "";
	
	if( $('#first_name').val().length < 3 ){
		//alert('first name required!!!!');
		errList += "<li>First Name</li>";
		if (focusField == ""){
			focusField = "#last_name";
			}
	}
	
	if( $('#last_name').val().length < 5  ){
		//alert('first name required!!!!');
		errList += "<li>Last Name</li>";
		if (focusField == ""){
			focusField = "#last_name";
			}
	}
	
	if($('#email').val().length < 9  || !validateEmail($('#email').val())){
		errList += "<li> Valid Email Address</li>";
		if (focusField == ""){
			focusField = "#email";
			}

		}
	
	if (errList != "") {
		errList = "<i class='fa fa-warning' style='font-size: 50px;'></i><p><strong> Please provide the following:</strong></p></div><ul>" +errList + "</ul>"
		$('#errNote').html(errList);
		$('#errNote').removeClass('hide');
		$(focusField).focus();
		return false;
	
	
	}
	
	
}  
  
  
function validateEmail(em){
	var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,5}$/;
	return pattern.test(em);



}  
  
  
  
  
  
  
  
  
  
  
  
  

</script>		
		
		
		
		
		

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	
	
	
	
	<!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
	<script type="text/javascript">
		var count;
		var recieved;
		var total;
		count =<?=$count;?>;
		recieved = <?=$arrived;?>;
		total = <?=$total;?>;
	</script>
    <script type="text/javascript" src="js/plugins/morris/morris-data.js"></script>
	
</body>

</html>
