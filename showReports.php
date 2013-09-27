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
echo "sessionjobid: " .$_SESSION['jobid'];
echo "<br>";
echo "sessiondept: " .$_SESSION['dept'];
echo "<br>";



$smarty = new Smarty;

CreateMenu($smarty);


if($_SESSION['role'] == "1") {

   $reports = R::getAll( 'select * from reports reports, user user where user.username = "'.$_SESSION['username'].'" && user.id = reports.user_id' );
   $azubi = R::getall('SELECT * from user where username = "'. $_SESSION['username'] .'";' );
   
   $smarty->assign('azubi', $azubi);
   $smarty->assign('reports', $reports);
   $smarty->assign('activeReport', 0); 
}
elseif($_SESSION['role'] == 2) {
      $azubi = R::getall('SELECT user.id, user.username, user.name, user.surname, userid_role.role, reports.user_id, reports.division FROM user user, userid_role userid_role, reports reports WHERE user.id = userid_role.user_id && userid_role.role = 1 && user.jobid = "'.$_SESSION['jobid'].'"' );
$smarty->assign('azubi', $azubi);
}
elseif($_SESSION['role'] == 3) {
   
       $azubi = R::getall( 'select user.id, user.username, user.name, user.surname, userid_role.role from user user, userid_role userid_role where user.id = userid_role.user_id && userid_role.role = 1 && user.jobid = '. $_SESSION['jobid'] .'' );
$smarty->assign('azubi', $azubi);
}

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


function enable_change(elem,typ){
	
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

         if ("<?php echo $_SESSION['role'];?>" == "1") {
         $("#noteCompany").prop("disabled", true);
         $("#noteCompany").css('background-color', '#D5D5D5')
         $("#noteTraining").prop("disabled", true);
         $("#noteTraining").css('background-color', '#D5D5D5')
         $("#noteSchool").prop("disabled", true);
         $("#noteSchool").css('background-color', '#D5D5D5')
      }
	
	}

}




$('#azubi').on('change', function() {
   var sessrole = <?php echo $_SESSION['role'];?>;
   var sessjobid = <?php echo $_SESSION['jobid'];?>; 
   var sessdept = "<?php echo $_SESSION['dept'];?>"; 
   var username = $("#azubi").val();
   if (sessrole == "2") {
      $.ajax({ 
	      url: "getReports2.php",
	      type: "post",
	      data: 'username='+username+'&sessrole='+sessrole+'&sessjobid='+sessjobid+'&sessdept='+sessdept,
         dataType : 'json',
         success: 
         function(data){
            document.getElementById('reports').options.length = 0;
            console.log(data);
            var firstProp;
            for(var key in data) {
               if(data.hasOwnProperty(key)) {
                  firstProp = data[key];
                  break;
               }
            }
            $('#reportNumber').attr("value", firstProp[1]);
            $('#division').attr("value", firstProp[2]);
            $('#startDate').attr("value", firstProp[3]);
            document.getElementById("bis").innerHTML=firstProp[4];
            $('textarea[name=company]').val(firstProp[5]);
            $('textarea[name=training]').val(firstProp[6]);
            $('textarea[name=school]').val(firstProp[7]);
            $('textarea[name=noteCompany]').val(firstProp[8]);
            $('textarea[name=noteTraining]').val(firstProp[9]);
            $('textarea[name=noteSchool]').val(firstProp[10]);
            $.each(data,function(i){
               $('#reports').append("<option value="+data[i][0]+">Bericht: "+data[i][1]+" vom "+data[i][3]+" - "+data[i][4]+"</option>");
               i++;
            })
            
         }

      })
   }
   if ( sessrole == "3") {
      $.ajax({ 
	      url: "getReports.php",
	      type: "post",
	      data: 'username='+username+'&sessrole='+sessrole+'&sessjobid='+sessjobid,
         dataType : 'json',
         success: 
         function(data){
            document.getElementById('reports').options.length = 0;
            console.log(data);
            var firstProp;
            for(var key in data) {
               if(data.hasOwnProperty(key)) {
                  firstProp = data[key];
                  break;
               }
            }
            $('#reportNumber').attr("value", firstProp[1]);
            $('#division').attr("value", firstProp[2]);
            $('#startDate').attr("value", firstProp[3]);
            document.getElementById("bis").innerHTML=firstProp[4];
            $('textarea[name=company]').val(firstProp[5]);
            $('textarea[name=training]').val(firstProp[6]);
            $('textarea[name=school]').val(firstProp[7]);
            $('textarea[name=noteCompany]').val(firstProp[8]);
            $('textarea[name=noteTraining]').val(firstProp[9]);
            $('textarea[name=noteSchool]').val(firstProp[10]);
            $.each(data,function(i){
               $('#reports').append("<option value="+data[i][0]+">Bericht: "+data[i][1]+" vom "+data[i][3]+" - "+data[i][4]+"</option>");
               i++;
            })
            
         }

      })
   }
})

$('#reports').on('change', function() {
   var reportid = $("#reports").val();
   var username = $("#azubi").val();
      console.log(reportid);
      $.ajax({ 
	      url: "getActiveReport.php",
	      type: "post",
	      data: 'reportid='+reportid+'&username='+username,
         dataType : 'json',
         success: 
         function(data){
            console.log(data);
            $('#reportNumber').attr("value", data[reportid][1]);
            $('#division').attr("value", data[reportid][2]);
            $('#startDate').attr("value", data[reportid][3]);
            document.getElementById("bis").innerHTML=data[reportid][4];
            $('textarea[name=company]').val(data[reportid][5]);
            $('textarea[name=training]').val(data[reportid][6]);
            $('textarea[name=school]').val(data[reportid][7]);
            $('textarea[name=noteCompany]').val(data[reportid][8]);
            $('textarea[name=noteTraining]').val(data[reportid][9]);
            $('textarea[name=noteSchool]').val(data[reportid][10]);
         }

      })
   })




function getval(param) {

if (param == "1") {
	
	var company = $("#company").val();
	var division = $("#division").val();
	var training = $("#training").val();
	var school = $("#school").val();
	var reportNumber = $("#reportNumber").val();
   var startDate = $("#startDate").val();
   var reportid = $("#reports").val();

	$.ajax({ 
	   url: "showReports_insert.php",
	   type: "post",
	   data: 'company='+company+'&division='+division+'&training='+training+'&school='+school+'&reportNumber='+reportNumber+'&startDate='+startDate+'&reportid='+reportid,
	   success: function(data){ 
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
	   
	      $('input[name=change]').attr('checked', false); 
	   }, 
	   error: function(){ 
	      alert("failure"); 
	      $("#results").html('There is error while submit'); 
	      } 
	});
	
	}
	
	if (param == "2" || param == "3") {
		var noteCompany = $("#noteCompany").val();
		var noteTraining = $("#noteTraining").val();
		var noteSchool = $("#noteSchool").val();
      var reportid = $("#reports").val();
		$.ajax({ 
		   url: "showReports_insert2.php",
		   type: "post",
		   data: 'noteCompany='+noteCompany+'&noteTraining='+noteTraining+'&noteSchool='+noteSchool+'&reportid='+reportid,
		   success: function(data){ 
	  
		$("#noteCompany").prop("disabled", true);
		$("#noteCompany").css('background-color', '#D5D5D5')
		
		$("#noteTraining").prop("disabled", true);
		$("#noteTraining").css('background-color', '#D5D5D5')
		
		$("#noteSchool").prop("disabled", true);
		$("#noteSchool").css('background-color', '#D5D5D5')
   
      $('input[name=change]').attr('checked', false);
      }, 
   error: function(){ 
      alert("failure"); 
      $("#results").html('There is error while submit'); 
      } 
});

		
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
