<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();
echo "Kontrollausgaben:<br>";
echo "sessionusername: " .$_SESSION['username'];
echo "<br>";
echo "sessionid: ".$_SESSION['id'];
echo "<br>";
echo "sessionrole: " .$_SESSION['role'];
echo "<br>";
echo "POST ID:" .$_POST['id'];
echo "<br>";

$smarty = new Smarty;

CreateMenu($smarty);

if(isset($_GET['id']) && isset($_GET['reportNumber']) && isset($_POST['id'])) {
   $reportNumber = $_GET['reportNumber'];
   $activeReport = $reportNumber - 1;
}
else
{
$user_id=1;

$activeReport = 0;
//   $reports = R::load('reports', $user_id);


$smarty->assign('activeReport', "1");
}

/*
if($_SESSION['role'] = 2 || $_SESSION['role'] = 3 && (isset($_POST['noteCompany']) || isset($_POST['noteTraining']) || isset($_POST['noteSchool'])))  {


   $reports = R::dispense('reports');
   $reports->noteCompany = $_POST['noteCompany'];
   $reports->noteTraining = $_POST['noteTraining'];
   $reports->noteSchool = $_POST['noteSchool'];
}
 */
//Datenbankabfragen:

$azubi = R::getALL( 'select * from user' );
$smarty->assign('azubi', $azubi);

$azubi2 = R::getall( 'select user.id, user.username, user.name, user.surname,userid_role.role from user user, userid_role userid_role where user.id = userid_role.user_id && userid_role.role = '. 1 .'' );
$smarty->assign('azubi2', $azubi2);

$smarty->assign('activeReport', $activeReport);
$reports = R::getAll( 'select * from reports where user_id = 1' );
$smarty->assign('reports', $reports);




//Functions:

function getEndDate($activeReport) {
$reports = R::getAll( 'select * from reports where user_id = 1' );

   $date  = $reports[$activeReport]['startDate'];
   $teile = explode(".", $date);
   $y = $teile[2];
   $m = $teile[1];
   $d = $teile[0];
   $date     = new Datetime();
   $date->setDate($y, $m, $d);
   $day2 = $date->format('d.m.Y');
   $nextDay = strtotime("+4 day", strtotime($day2));
   echo date("d.m.Y", $nextDay); 
}

function getEndDateByStart($startDate) {
$reports = R::getAll( 'select * from reports where user_id = 1' );

   $teile = explode(".", $startDate);
   $y = $teile[2];
   $m = $teile[1];
   $d = $teile[0];
   $date     = new Datetime();
   $date->setDate($y, $m, $d);
   $day2 = $date->format('d.m.Y');
   $nextDay = strtotime("+4 day", strtotime($day2));
   echo date("d.m.Y", $nextDay); 
}



$smarty->display('templates/showReport.tpl');
R::close();


?>


<script>
$(window).load(function () {
	$("#reportNumber").attr('readonly', true);
	$("#reportNumber").css('background-color', '#D5D5D5');
	  
	$("#division").attr('readonly', true);
	$("#division").css('background-color', '#D5D5D5');
	  
	$("#startDate").attr('readonly', true);
	$("#startDate").css('background-color', '#D5D5D5')
 
	$("#signDate").attr('readonly', true);
	$("#signDate").css('background-color', '#D5D5D5')
		  
	$("#company").prop("disabled", true);
	$("#company").css('background-color', '#D5D5D5')
	
	$("#training").prop("disabled", true);
	$("#training").css('background-color', '#D5D5D5')
	
	$("#school").prop("disabled", true);
    $("#school").css('background-color', '#D5D5D5')

      $("#noteCompany").prop("disabled", true);
      $("#noteCompany").css('background-color', '#D5D5D5')
     
      $("#noteTraining").prop("disabled", true);
      $("#noteTraining").css('background-color', '#D5D5D5')
      
	  $("#noteSchool").prop("disabled", true);
      $("#noteSchool").css('background-color', '#D5D5D5')

  
});


function enable_change(elem,typ) {
	
	if (typ === "2" || typ === "3") {
		if($(elem).is(':checked')){ 
			$("#noteCompany").prop("disabled", false);
			$("#noteCompany").css('background-color', '#FFFFFF');
			
			$("#noteTraining").prop("disabled", false);
			$("#noteTraining").css('background-color', '#FFFFFF');
			
			$("#noteSchool").prop("disabled", false);
			$("#noteSchool").css('background-color', '#FFFFFF');
			
			return false;
		}
		else {
			$("#noteCompany").prop("disabled", true);
			$("#noteCompany").css('background-color', '#D5D5D5');
			
			$("#noteTraining").prop("disabled", true);
			$("#noteTraining").css('background-color', '#D5D5D5');
			
			$("#noteSchool").prop("disabled", true);
			$("#noteSchool").css('background-color', '#D5D5D5');
			
			return false;
		}
	}
	
	if($(elem).is(':checked')){ 
	
		$("#reportNumber").attr('readonly', false);
		$("#reportNumber").css('background-color', '#FFFFFF');
		  
		$("#division").attr('readonly', false);
		$("#division").css('background-color', '#FFFFFF');
		  
		$("#signDate").attr('readonly', false);
		$("#signDate").css('background-color', '#FFFFFF')
			  
		$("#company").prop("disabled", false);
		$("#company").css('background-color', '#FFFFFF')
		
		$("#training").prop("disabled", false);
		$("#training").css('background-color', '#FFFFFF')
		
		$("#school").prop("disabled", false);
		$("#school").css('background-color', '#FFFFFF')
	
	}
	else {
		$("#reportNumber").attr('readonly', true);
		$("#reportNumber").css('background-color', '#D5D5D5');
		  
		$("#division").attr('readonly', true);
		$("#division").css('background-color', '#D5D5D5');
		  
		$("#signDate").attr('readonly', true);
		$("#signDate").css('background-color', '#D5D5D5')
			  
		$("#company").prop("disabled", true);
		$("#company").css('background-color', '#D5D5D5')
		
		$("#training").prop("disabled", true);
		$("#training").css('background-color', '#D5D5D5')
		
		$("#school").prop("disabled", true);
      $("#school").css('background-color', '#D5D5D5')

      if ($_SESSION['role'] == "1") {
         $("#noteCompany").prop("disabled", true);
         $("#noteCompany").css('background-color', '#D5D5D5')
         $("#noteTraining").prop("disabled", true);
         $("#noteTraining").css('background-color', '#D5D5D5')
         $("#noteSchool").prop("disabled", true);
         $("#noteSchool").css('background-color', '#D5D5D5')
      }
	
	}

}

function getval(sel) {

$.azubi({ 
   url: "showReports.php",
   type: "post",
   data: 'id='+id,
   success: function(data){ 
      load_c('anzeigen');
      }, 
   error: function(){ 
      alert("failure"); 
      $("#results").html('There is error while submit'); 
      } 
});
}
function load_c(param) {

   if (param == "eintragen") { 
      xmlHttpObject.open('get','eintragen_get.php');
      xmlHttpObject.onreadystatechange = handleContent; 
      xmlHttpObject.send(null); 
      return false; 
   }
}

function handleContent() { 
   if (xmlHttpObject.readyState == 4) { 
      document.getElementById('content').innerHTML = xmlHttpObject.responseText; 
   } 
}

var xmlHttpObject = false;

if (typeof XMLHttpRequest != 'undefined') { 
   xmlHttpObject = new XMLHttpRequest(); 
} 
if (!xmlHttpObject) { 
   try {
      xmlHttpObject = new ActiveXObject("Msxml2.XMLHTTP"); 
   } 
   catch(e) { 
      try { 
         xmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      catch(e) { 
         xmlHttpObject = null; 
      } 
   } 
}
</script>
