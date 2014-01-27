<?php // Einstiegsseite
require_once('include.php');
EnsureLogin();


$smarty = new Smarty;

CreateMenu($smarty);
$smarty->force_compile = true;
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

if($_SESSION['jobid'] == 3) {
        $smarty->display('templates/createReportBios.tpl');
}
else {
	$smarty->display('templates/createReport.tpl');
}


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


var monC = 1;
var dieC = 1;
var mitC = 1;
var donC = 1;
var freiC = 1;

function add_c(day) {

	var max = 4;

	if(day == "mon") {
		if(monC > max){
			$("#d").dialog({
				resizable: 		false,
				height: 		140,
				modal: 			true,
				closeOnEscape: 	false,
				open: 			function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				buttons: {
					Ok: function() {
						$(this).dialog( "close" );
						$("#"+day+"div").append('<input type="text" name="'+day+'Work'+monC+'" id="'+day+'Work'+monC+'" size="120" />');
						$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+monC+'" id="'+day+'Hours'+monC+'" value="" size="5" />');
						monC++;
					},
					Cancel: function() {
						$(this).dialog( "close" );
						return false;
					}
				}
			});
		}
		else {
			$("#"+day+"div").append('<input type="text" name="'+day+'Work'+monC+'" id="'+day+'Work'+monC+'" size="120" />');
			$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+monC+'" id="'+day+'Hours'+monC+'" value="" size="5" />');
			monC++;
		}
	}
	else if(day == "die") {
		if(dieC > max){
			$("#d").dialog({
				resizable: 		false,
				height: 		140,
				modal: 			true,
				closeOnEscape: 	false,
				open: 			function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				buttons: {
					Ok: function() {
						$(this).dialog( "close" );
						$("#"+day+"div").append('<input type="text" name="'+day+'Work'+dieC+'" id="'+day+'Work'+dieC+'" size="120" />');
						$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+dieC+'" id="'+day+'Hours'+dieC+'" value="" size="5" />');
						dieC++;
					},
					Cancel: function() {
						$(this).dialog( "close" );
						return false;
					}
				}
			});
		}
		else {
			$("#"+day+"div").append('<input type="text" name="'+day+'Work'+dieC+'" id="'+day+'Work'+dieC+'" size="120" />');
			$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+dieC+'" id="'+day+'Hours'+dieC+'" value="" size="5" />');
			dieC++;
		}
	}
	else if(day == "mit") {
		if(mitC > max){
			$("#d").dialog({
				resizable: 		false,
				height: 		140,
				modal: 			true,
				closeOnEscape: 	false,
				open: 			function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				buttons: {
					Ok: function() {
						$(this).dialog( "close" );
						$("#"+day+"div").append('<input type="text" name="'+day+'Work'+mitC+'" id="'+day+'Work'+mitC+'" size="120" />');
						$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+mitC+'" id="'+day+'Hours'+mitC+'" value="" size="5" />');
						mitC++;
					},
					Cancel: function() {
						$(this).dialog( "close" );
						return false;
					}
				}
			});
		}
		else {
			$("#"+day+"div").append('<input type="text" name="'+day+'Work'+mitC+'" id="'+day+'Work'+mitC+'" size="120" />');
			$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+mitC+'" id="'+day+'Hours'+mitC+'" value="" size="5" />');
			mitC++;
		}
	}
	else if(day == "don") {
		if(donC > max){
			$("#d").dialog({
				resizable: 		false,
				height: 		140,
				modal: 			true,
				closeOnEscape: 	false,
				open: 			function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				buttons: {
					Ok: function() {
						$(this).dialog( "close" );
						$("#"+day+"div").append('<input type="text" name="'+day+'Work'+donC+'" id="'+day+'Work'+donC+'" size="120" />');
						$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+donC+'" id="'+day+'Hours'+donC+'" value="" size="5" />');
						donC++;
					},
					Cancel: function() {
						$(this).dialog( "close" );
						return false;
					}
				}
			});
		}
		else {
			$("#"+day+"div").append('<input type="text" name="'+day+'Work'+donC+'" id="'+day+'Work'+donC+'" size="120" />');
			$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+donC+'" id="'+day+'Hours'+donC+'" value="" size="5" />');
			donC++;
		}
	}
	else if(day == "frei") {
		if(freiC > max){
			$("#d").dialog({
				resizable: 		false,
				height: 		140,
				modal: 			true,
				closeOnEscape: 	false,
				open: 			function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				buttons: {
					Ok: function() {
						$(this).dialog( "close" );
						$("#"+day+"div").append('<input type="text" name="'+day+'Work'+freiC+'" id="'+day+'Work'+freiC+'" size="120" />');
						$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+freiC+'" id="'+day+'Hours'+freiC+'" value="" size="5" />');
						freiC++;
					},
					Cancel: function() {
						$(this).dialog( "close" );
						return false;
					}
				}
			});
		}
		else {
			$("#"+day+"div").append('<input type="text" name="'+day+'Work'+freiC+'" id="'+day+'Work'+freiC+'" size="120" />');
			$("#"+day+"time").append('<input type="text" name="'+day+'Hours'+freiC+'" id="'+day+'Hours'+freiC+'" value="" size="5" />');
			freiC++;
		}
	}
}

function save_data() {
// vars

var reportNumber 	= $("#reportNumber").val()
var startDate 		= $("#startDate").val()
var division 		= $("#division").val()
var betreuer 		= $("#betreuer").val()

var monwork = [];
var montime = [];

var diework = [];
var dietime = [];

var mitwork = [];
var mittime = [];

var donwork = [];
var dontime = [];

var freiwork = [];
var freitime = [];

//Montag
$('#mondiv').find('input').each(function() {
    monwork.push($(this).val());
})
$('#montime').find('input').each(function() {
    montime.push($(this).val());
})
// Diensag
$('#diediv').find('input').each(function() {
    diework.push($(this).val());
})
$('#dietime').find('input').each(function() {
    dietime.push($(this).val());
})
// Mittwoch
$('#mitdiv').find('input').each(function() {
    mitwork.push($(this).val());
})
$('#mittime').find('input').each(function() {
    mittime.push($(this).val());
})
// Donnerstag
$('#dondiv').find('input').each(function() {
    donwork.push($(this).val());
})
$('#dontime').find('input').each(function() {
    dontime.push($(this).val());
})
//Freitag
$('#freidiv').find('input').each(function() {
    freiwork.push($(this).val());
})
$('#freitime').find('input').each(function() {
    freitime.push($(this).val());
})


	if(reportNumber == "") {
		alert('Bitte Ausbildungsnachweis eingeben');
		$("#reportNumber").fadeOut('slow').fadeIn('slow');
		return false;
	}
	if(startDate == "") {
		alert('Bitte Datum eingeben');
		$("#startDate").fadeOut('slow').fadeIn('slow');
		return false;
	}
	if(division == "") {
		alert('Bitte Abteilung eingeben');
		$("#division").fadeOut('slow').fadeIn('slow');
		return false;
	}
	if(betreuer == "") {
		alert('Bitte Betreuer eingeben');
		$("#betreuer").fadeOut('slow').fadeIn('slow');
		return false;
	}

	$.ajax({
		url: 'insert_bios.php',
		type: 'post',
		dataType: 'json',
		data: 	'reportNumber='+reportNumber+'&startDate='+startDate+'&division='+division+'&betreuer='+betreuer+
				'&monwork='+monwork+'&montime='+montime+
				'&diework='+diework+'&dietime='+dietime+
				'&mitwork='+mitwork+'&mittime='+mittime+
				'&donwork='+donwork+'&dontime='+dontime+
				'&freiwork='+freiwork+'&freitime='+freitime,
		success: function(data){
			if(data.action == "fail") {
				alert(data.msg);
			}
			else if(data.action == "success") {
				alert(data.msg);
				window.location.reload();
			}
			else {
				window.location.reload();
			}
		}
	})
	
}

</script>
