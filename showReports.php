<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

if(isset($_GET['id']) && isset($_GET['reportNumber'])) {
   $activeReport = $_GET['reportNumber'];
   $activeReport = $activeReport - 1;
}
else
{
$user_id=1;

$activeReport = 0;
//   $reports = R::load('reports', $user_id);


$smarty->assign('activeReport', "1");
}




$azubi = R::getALL( 'select * from user' );
$smarty->assign('azubi', $azubi);

$smarty->assign('activeReport', $activeReport);
$reports = R::getAll( 'select * from reports where user_id = 1' );
$smarty->assign('reports', $reports);

function getEndDate($activeReport) {
$reports = R::getAll( 'select * from reports where user_id = 1' );

   $date  = $reports[$activeReport]['startDate'];;
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
  
});


function enable_change(elem) {
	
	if($(elem).is(':checked')){ 
	
		$("#reportNumber").attr('readonly', false);
		$("#reportNumber").css('background-color', '#FFFFFF');
		  
		$("#division").attr('readonly', false);
		$("#division").css('background-color', '#FFFFFF');
		  
		$("#startDate").attr('readonly', false);
		$("#startDate").css('background-color', '#FFFFFF')
	 
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
	
	}

}

</script>
