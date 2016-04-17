<?php session_start(); ?>

<?php include "include/header.php"; ?>
<div id="page_content">
		

		<div class="container">
			<div id="page_left">
<?

/* $info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];

$current_date = "$date/$month/$year == $hour:$min:$sec";

$current_time = "$hour:$min:$sec";
			
			
			
			
			
			
			echo "Today is " . date("Y/m/d") . "<br>"; date_default_timezone_set("America/Chicago");
				echo "The time is " .date("g:i a", strtotime("$hour:$min:$sec"));; */ ?> 
<script type="text/javascript">
//Current Server Time script (SSI or PHP)- By JavaScriptKit.com (http://www.javascriptkit.com)
// For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
// This notice must stay intact for use.

//Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
//Default is that SSI method is uncommented, and PHP is commented:

//var currenttime = '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' //SSI method of getting server date
var currenttime = '<? print date("F d, Y H:i:s", time())?>' //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("servertime").innerHTML=datestring+" "+timestring
}

window.onload=function(){
setInterval("displaytime()", 1000)
}

</script>
			<p><b>Current Date and Time:</b><br> <span id="servertime"></span></p>
				
			</div>
			
			<div id="page_right">
			
				<h1>Resident Package</h1>
				
				<div class="alert alert-info">
				<p>Welcome! This allows you to check your current packages, <strong>you must</strong> have your Wildcat ID Card in order to view packages.</p>
				</div>
				
		
				<div id="errNote" class="<?php if ($_SESSION['invalid_Card']=="Bad"){
	
							echo ('""');
							
						} else {
							echo ('hide');
						}?>">
				 <?php if (isset($_SESSION['invalid_Card']) ){
						if ($_SESSION['invalid_Card']=="Bad"){
							
							echo ('<strong>An Error has Occured</strong>: <li>Card id not a valid K-State ID Please contact KSU IS Center for help</li>');
							
						}
				} else {
					echo '';
				}
					
				?></div>
				
				<form onSubmit="return checkform();" action="../php/data_parse_process.php" method="post">
				<fieldset>
				<legend>Check Packages</legend>
						<div class="row_center">
							<div class="col-xs-12">
								<label for="id_first_name" class="required">
								Wildcat ID 
								</label>
								<input type="password" name="iDAcc" value id="ID_Swipe" class="form-control textinput" autofocus>
							</div>
						</div>
						<div class="row_center77">
							
								
								<div class="help_center col-md-65" style="margin-top:20px;">
										<h2 class="help__title">Swipe Wildcat ID Card</h2>
										<div class="rap">
										</div>
										<span class="clear"></clear>
				
								</div> 
						</div>
						<span class="clear"></span>
						<input name="Submit" value="Continue" type="submit" onclick="goToAction('saveBaseInfo');return false;" id="submit_button" class="btn btn-primary" style="display: inline;">
					</fieldset>
					</form>
					
						
			</div>
		</div>
		<span class="clear"></span>
<script>		
  function checkform() {
	errList = "";
	
	if( $('#ID_Swipe').val().length < 3  ){
		//alert('first name required!!!!');
		errList += "<li>Card swipe was invalid please try again</li>";
	}
	
	
	if (errList != "") {
		errList = "<strong>An Error has Occured</strong>:<ul>" +errList + "</ul>"
		$('#errNote').html(errList);
		$('#errNote').removeClass('hide');
		return false;
	} else {
		return true;
	}
	
	
	
}
</script>
</div>


<?php include "include/footer.php"; ?>