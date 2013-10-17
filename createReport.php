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


$smarty->display('templates/createReportBios.tpl');
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
$(window).load(function () { 
   $("#signDate").attr('readonly', true);
   $("#signDate").css('background-color', '#D5D5D5');
});

$(function() {
        var scntDiv = $('#mondayWork1');
        var i = $('#monayWork1 p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="mondayWork1"><input type="text" id="p_scnt" size="20" name="mondayWork1' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
});

</script>
