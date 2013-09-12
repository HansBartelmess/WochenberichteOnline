<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();

$smarty = new Smarty;

CreateMenu($smarty);

if(isset($_POST["submit"]) && isset($_POST['reportNumber']) && isset($_POST['division']) && isset($_POST['startDate']) && (isset($_POST['company']) || isset($_POST['training']) || isset($_POST['school'])))  {


   //Finde den aktiven user
   $user = R::findOne('user', 'username = ?', array($_SESSION['username']));

   $reports = R::dispense('reports');
   $reports->reportNumber = $_POST['reportNumber'];
   $reports->division = $_POST['division'];
   $reports->startDate = $_POST['startDate'];
   $reports->company = $_POST['company'];
   $reports->training = $_POST['training'];
   $reports->school = $_POST['school'];

   //weise dem Bericht einem benutzer zu
   $user->ownReport[] = $reports;
   //speichere den Bericht mit dem Benutzer
   R::store($user);

   $smarty->assign('saved', true);
}


$smarty->display('templates/createReport.tpl');
R::close();

?>



<script type="text/javascript">
$(function() {
    $("#startDate").datepicker({ 
	dateFormat: 'dd.mm.yy',
	changeMonth: true,
    changeYear: true,
	firstDay: 1,
	maxDate: '0',
	beforeShowDay: function(date){ return [date.getDay() == 1,""]},
	
	onSelect: function(dateText, inst){
		var d = $.datepicker.parseDate(inst.settings.dateFormat, dateText);
		d.setDate(d.getDate()+4);
    	$("#bis").html($.datepicker.formatDate(inst.settings.dateFormat, d));
		$("#startDate").attr('readonly', true);
    }
		
	});
	
  });
  
  
</script>