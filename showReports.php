<?php // Einstiegsseite
require_once('include.php');


EnsureLogin();
/*
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
 */


$smarty = new Smarty;

CreateMenu($smarty);

$smarty->force_compile = true;

if($_SESSION['role'] == "1") {
   $reports = R::getAll( 'select reports.id, reports.reportNumber, reports.division, reports.startDate, reports.company, reports.training, reports.school, reports.user_id, reports.noteCompany, reports.noteTraining, reports.noteSchool from reports reports, user user where user.username = "'.$_SESSION['username'].'" && user.id = reports.user_id' );
   $azubi = R::getall('SELECT * from user where username = "'. $_SESSION['username'] .'";' );
   
   $smarty->assign('azubi', $azubi);
   $smarty->assign('reports', $reports);
   $smarty->assign('activeReport', 0); 
}
elseif($_SESSION['role'] == 2) {
      $azubi = R::getall('SELECT DISTINCT user.id, user.username, user.name, user.surname FROM user INNER JOIN userid_role ON user.id = userid_role.user_id AND userid_role.role = 1 INNER JOIN reports ON reports.user_id = user.id AND reports.division = "'.$_SESSION['dept'].'" WHERE user.jobid = "'.$_SESSION['jobid'].'";' );
      $smarty->assign('azubi', $azubi);
      $randomazubi = R::getall('SELECT DISTINCT user.username FROM user INNER JOIN userid_role ON user.id = userid_role.user_id AND userid_role.role = 1 INNER JOIN reports ON reports.user_id = user.id AND reports.division = "'.$_SESSION['dept'].'" WHERE user.jobid = "'.$_SESSION['jobid'].'";' );
      shuffle($randomazubi);
      $smarty->assign('randomazubi', $randomazubi);
}
elseif($_SESSION['role'] == 3) {
   
      $azubi = R::getall( 'select user.id, user.username, user.name, user.surname, userid_role.role from user user, userid_role userid_role where user.id = userid_role.user_id && userid_role.role = 1 && user.jobid = '. $_SESSION['jobid'] .'' );
      $smarty->assign('azubi', $azubi);
      $randomazubi = R::getall( 'select user.username from user user, userid_role userid_role where user.id = userid_role.user_id && userid_role.role = 1 && user.jobid = '. $_SESSION['jobid'] .'' );
      shuffle($randomazubi);
      $smarty->assign('randomazubi', $randomazubi);
}

if($_SESSION['jobid'] == 3) {
	
	$sql = "SELECT * FROM bio_report WHERE username='".$_SESSION['username']."' ORDER BY nachweis ";
	$res = sql($sql);
	while($rw=mysql_fetch_array($res)) {
		$date = strtotime($rw['date']);
		$date = strtotime("+4 day", $date);
		$NARR[] = $rw['nachweis']." - ".$rw['date']." bis ".date('d.m.Y', $date);
	}
	$smarty->assign("NACHWEIS" , $NARR);
	$smarty->display('templates/showReportBios.tpl');
}
else {
	$smarty->display('templates/showReport.tpl');
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




R::close();


?>


<script>


$("#bioselect").change(function(){
	var v = $(this).val();
	var s = v.split('-');
	var nachweis = s[0];
    
	$("#mondiv").find("[id^=monOut]").remove();
	$("#montimediv").find("[id^=monOuttime]").remove();
	$("#kommon").find("[id^=kommonout]").remove();
	$("#montimediv").find("[id^=outdivmon]").remove();
   $("#mondiv").find("[id^=outdivmonX]").remove();

   $("#diediv").find("[id^=dieOut]").remove();
	$("#dietimediv").find("[id^=dieOuttime]").remove();
	$("#komdiv").find("[id^=komout]").remove();
	$("#dietimediv").find("[id^=outdivdie]").remove();
   $("#diediv").find("[id^=outdivdieX]").remove();

   $("#mitdiv").find("[id^=mitOut]").remove();
	$("#mittimediv").find("[id^=mitOuttime]").remove();
	$("#komdiv").find("[id^=komout]").remove();
	$("#mittimediv").find("[id^=outdivmit]").remove();
   $("#mitdiv").find("[id^=outdivmitX]").remove();

   $("#dondiv").find("[id^=donOut]").remove();
	$("#dontimediv").find("[id^=donOuttime]").remove();
	$("#komdiv").find("[id^=komout]").remove();
	$("#dontimediv").find("[id^=outdivdon]").remove();
   $("#dondiv").find("[id^=outdivdonX]").remove();

   $("#freidiv").find("[id^=freiOut]").remove();
	$("#freitimediv").find("[id^=freiOuttime]").remove();
	$("#komdiv").find("[id^=komout]").remove();
	$("#freitimediv").find("[id^=outdivfrei]").remove();
   $("#freidiv").find("[id^=outdivfreiX]").remove();

	$("#LOADING").fadeIn('fast');
	
	$.getJSON( "getReports_bio.php?iid=2&nachweis="+nachweis, function( data ) {
		$("#reportNumber").val(data.nachweis);
		$("#division").val(data.dept);
		$("#startDate").val(data.date);
		$("#bis").html(data.bis);
		$("#signDate").val(data.updated);
	});
	
    $.getJSON( "getReports_bio.php?iid=1&nachweis="+nachweis, function( data ) {

      var gestime = 0;   
		var monL = data.mon['work'].length;
		for ( var i = 0; i < monL; i++ ) {
         gestime = gestime + parseInt(data.mon['time'][i]);

			if(i >= 1) {
				$("#LOADING").fadeOut('fast');
				$("#mondiv").append('<div id="outdivmonX'+i+'" class="ym-fbox-text"><input id="monOut'+i+'" type="text"></div>');
				$("#monOut"+i).val(data.mon['work'][i]);
				
				$("#montimediv").append('<div id="outdivmon'+i+'" class="ym-fbox-text"><input type="text" id="monOuttime'+i+'" value="" size="2"/></div>');
            $("#monOuttime"+i).val(data.mon['time'][i]);
				
				$("#komdivmon").append('<div id="kommon'+i+'" class="ym-fbox-text"><input type="text" id="kommonout'+i+' " /></div>');
				
				
			}
         else {

				$("#LOADING").fadeOut('fast');
				$("#monWork0").val(data.mon['work'][0]);
				$("#monHours0").val(data.mon['time'][0]);
				
			}

      }

      var dieL = data.die['work'].length;
      for ( var i = 0; i < dieL; i++ ) {
         if(data.die['time'][0] != ""){
            gestime = gestime + parseInt(data.die['time'][i]);
         }

			if(i >= 1) {
				$("#LOADING").fadeOut('fast');
				$("#diediv").append('<div id="outdivdieX'+i+'" class="ym-fbox-text"><input id="dieOut'+i+'" type="text"></div>');
				$("#dieOut"+i).val(data.die['work'][i]);
				
				$("#dietimediv").append('<div id="outdivdie'+i+'" class="ym-fbox-text"><input type="text" id="dieOuttime'+i+'" value="" size="2"/></div>');
				$("#dieOuttime"+i).val(data.die['time'][i]);
				
				$("#komdivdie").append('<div id="komdie'+i+'" class="ym-fbox-text"><input type="text" id="komdieout'+i+' " cols="2" /></div>');
				
				
			}
			else {
				$("#LOADING").fadeOut('fast');
				$("#dieWork0").val(data.die['work'][0]);
				$("#dieHours0").val(data.die['time'][0]);
				
			}

		}
      var mitL = data.mit['work'].length;
      for ( var i = 0; i < mitL; i++ ) {
         if(data.mit['time'][0] != ""){
            gestime = gestime + parseInt(data.mit['time'][i]);
         }

			if(i >= 1) {
				$("#LOADING").fadeOut('fast');
				$("#mitdiv").append('<div id="outdivmitX'+i+'" class="ym-fbox-text"><input id="mitOut'+i+'" type="text"></div>');
				$("#mitOut"+i).val(data.mit['work'][i]);
				
				$("#mittimediv").append('<div id="outdivmit'+i+'" class="ym-fbox-text"><input type="text" id="mitOuttime'+i+'" value="" size="2"/></div>');
				$("#mitOuttime"+i).val(data.mit['time'][i]);
				
				$("#komdivmit").append('<div id="kommit'+i+'" class="ym-fbox-text"><input type="text" id="kommitout'+i+' " cols="2" /></div>');
				
				
			}
			else {
				$("#LOADING").fadeOut('fast');
				$("#mitWork0").val(data.mit['work'][0]);
				$("#mitHours0").val(data.mit['time'][0]);
				
			}

      }

      var donL = data.don['work'].length;
      for ( var i = 0; i < donL; i++ ) {
         if(data.don['time'][0] != ""){
            gestime = gestime + parseInt(data.don['time'][i]);
         }

			if(i >= 1) {
				$("#LOADING").fadeOut('fast');
				$("#dondiv").append('<div id="outdivdonX'+i+'" class="ym-fbox-text"><input id="donOut'+i+'" type="text"></div>');
				$("#donOut"+i).val(data.don['work'][i]);
				
				$("#dontimediv").append('<div id="outdivdon'+i+'" class="ym-fbox-text"><input type="text" id="donOuttime'+i+'" value="" size="2"/></div>');
				$("#donOuttime"+i).val(data.don['time'][i]);
				
				$("#komdivdon").append('<div id="komdon'+i+'" class="ym-fbox-text"><input type="text" id="komdonout'+i+' " cols="2" /></div>');
				
				
			}
			else {
				$("#LOADING").fadeOut('fast');
				$("#donWork0").val(data.don['work'][0]);
				$("#donHours0").val(data.don['time'][0]);
				
			}

      }
      var freiL = data.frei['work'].length;
      for ( var i = 0; i < freiL; i++ ) {
         if(data.mit['time'][0] != ""){
            gestime = gestime + parseInt(data.frei['time'][i]);
         }

			if(i >= 1) {
				$("#LOADING").fadeOut('fast');
				$("#freidiv").append('<div id="outdivfreiX'+i+'" class="ym-fbox-text"><input id="freiOut'+i+'" type="text"></div>');
				$("#freiOut"+i).val(data.frei['work'][i]);
				
				$("#freitimediv").append('<div id="outdivfrei'+i+'" class="ym-fbox-text"><input type="text" id="freiOuttime'+i+'" value="" size="2"/></div>');
				$("#freiOuttime"+i).val(data.frei['time'][i]);
				
				$("#komdivfrei").append('<div id="komfrei'+i+'" class="ym-fbox-text"><input type="text" id="komfreiout'+i+' " cols="2" /></div>');
				
				
			}
			else {
				$("#LOADING").fadeOut('fast');
				$("#freiWork0").val(data.frei['work'][0]);
				$("#freiHours0").val(data.frei['time'][0]);
				
			}

      }
      $("#gesamttime").val(gestime);
    })
})




$(window).load(function () {
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
               $('#reports').append("<option value="+data[i][0]+">Nachweis: "+data[i][1]+" vom "+data[i][3]+" - "+data[i][4]+"</option>");
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
               $('#reports').append("<option value="+data[i][0]+">Nachweis: "+data[i][1]+" vom "+data[i][3]+" - "+data[i][4]+"</option>");
               i++;
            })
            
         }

      })
   }
   $("#reportNumber").attr('readonly', true);
	$("#reportNumber").css('background-color', '#D5D5D5');
	  
	$("#division").attr('readonly', true);
	$("#division").css('background-color', '#D5D5D5');
	  
	$("#startDate").attr('readonly', true);
	$("#startDate").css('background-color', '#D5D5D5');
 
	$("#signDate").attr('readonly', true);
	$("#signDate").css('background-color', '#D5D5D5');
		  
	$("#company").prop("disabled", true); 
	$("#company").css('background-color', '#D5D5D5');
	
	$("#training").prop("disabled", true);
	$("#training").css('background-color', '#D5D5D5');
	
	$("#school").prop("disabled", true);
   $("#school").css('background-color', '#D5D5D5');

   $("#noteCompany").prop("disabled", true);
   $("#noteCompany").css('background-color', '#D5D5D5');
     
   $("#noteTraining").prop("disabled", true);
   $("#noteTraining").css('background-color', '#D5D5D5');

   $("#noteSchool").prop("disabled", true);
   $("#noteSchool").css('background-color', '#D5D5D5');   
   
});


function set_signed(elem,typ){
		if($(elem).is(':checked')){ 
         var report = $("#reports").val();
         if (typ === "2"){
            $.ajax({ 
	            url: "setSigned.php",
	            type: "post",
	            data: 'report='+report,
            })
         }
         if (typ === "3") {
            $.ajax({ 
	            url: "setSigned2.php",
	            type: "post",
	            data: 'report='+report,
            })
         }
      }
   	$("#signed").prop("checked", false);
}
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
		  
		$("#signDate").attr('readonly', true);
		$("#signDate").css('background-color', '#D5D5D5');
			  
		$("#company").prop("disabled", false);
		$("#company").css('background-color', '#FFFFFF');
		
		$("#training").prop("disabled", false);
		$("#training").css('background-color', '#FFFFFF');
		
		$("#school").prop("disabled", false);
		$("#school").css('background-color', '#FFFFFF');
	
	}
	else {
		$("#reportNumber").attr('readonly', true);
		$("#reportNumber").css('background-color', '#D5D5D5');
		  
		$("#division").attr('readonly', true);
		$("#division").css('background-color', '#D5D5D5');
		  
		$("#signDate").attr('readonly', true);
		$("#signDate").css('background-color', '#D5D5D5');
			  
		$("#company").prop("disabled", true);
		$("#company").css('background-color', '#D5D5D5');
		
		$("#training").prop("disabled", true);
		$("#training").css('background-color', '#D5D5D5');
		
		$("#school").prop("disabled", true);
		$("#school").css('background-color', '#D5D5D5');

         if ("<?php echo $_SESSION['role'];?>" == "1") {
         $("#noteCompany").prop("disabled", true);
         $("#noteCompany").css('background-color', '#D5D5D5');
         $("#noteTraining").prop("disabled", true);
         $("#noteTraining").css('background-color', '#D5D5D5');
         $("#noteSchool").prop("disabled", true);
         $("#noteSchool").css('background-color', '#D5D5D5');
      }
	
	}

}




$('#azubi').on('change', function () {
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
   var id = $("#reports").val();
   var username = $("#azubi").val();
      $.ajax({ 
	      url: "getActiveReport.php",
	      type: "post",
	      data: 'id='+id+'&username='+username,
         dataType : 'json',
         success: 
         function(data){
            console.log(data); 
            $('#reportNumber').attr("value", data[id][1]);
            $('#division').attr("value", data[id][2]);
            $('#startDate').attr("value", data[id][3]);
            document.getElementById("bis").innerHTML=data[id][4];
            $('textarea[name=company]').val(data[id][5]);
            $('textarea[name=training]').val(data[id][6]);
            $('textarea[name=school]').val(data[id][7]);
            $('textarea[name=noteCompany]').val(data[id][8]);
            $('textarea[name=noteTraining]').val(data[id][9]);
            $('textarea[name=noteSchool]').val(data[id][10]);
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
			$("#signDate").css('background-color', '#D5D5D5');
				  
			$("#company").prop("disabled", true);
			$("#company").css('background-color', '#D5D5D5');
			
			$("#training").prop("disabled", true);
			$("#training").css('background-color', '#D5D5D5');
			
			$("#school").prop("disabled", true);
			$("#school").css('background-color', '#D5D5D5');
	   
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
		$("#noteCompany").css('background-color', '#D5D5D5');
		
		$("#noteTraining").prop("disabled", true);
		$("#noteTraining").css('background-color', '#D5D5D5');
		
		$("#noteSchool").prop("disabled", true);
		$("#noteSchool").css('background-color', '#D5D5D5');
   
      $('input[name=change]').attr('checked', false);
      }, 
   error: function(){ 
      alert("failure"); 
      $("#results").html('There is error while submit'); 
      } 
})

		
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
