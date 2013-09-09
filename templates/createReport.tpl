{include file="header.tpl" titel="Bericht Eintragen"}
{include file="navigation.tpl"}

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
    }
		
	});
	
  });

</script>

<div id="main">
   <div class="ym-wrapper">

      {if $saved|default:false}
         <div class="ym-wbox">
            <img src="templates/icons/accept.png" />
            Bericht wurde erfolgreich gespeichert!
         </div>
      {/if}

      <form class="ym-form" method="post">

         <h6>Bericht eintragen</h6>
         
         <div class="ym-grid ym-columnar">
            <div class="ym-g50 ym-gl">
               <div class="ym-fbox-text">
                  <label for="reportNumber">Ausbildungsnachweis:<sup class="ym-required">*</sup></label>
                  <input type="text" name="reportNumber" id="reportNumber" size="3" required="required" aria-required="true"/>
               </div>
               <div class="ym-fbox-text">
                  <label for="division">Abteilung:<sup class="ym-required">*</sup></label>
                  <input type="text" name="division" id="division" size="25" required="required" aria-required="true"/>
               </div>
            </div>

            <div class="ym-g50 ym-gr">
               <div class="ym-fbox-text">
                  <label for="startDate">für die Zeit vom:<sup class="ym-required">*</sup></label>
                  <input type="text" name="startDate" id="startDate" size="3" required="required" aria-required="true"'/>
                  <div style="float:right;" class="ym-clearfix">
                     bis: <span id="bis"></span>
                  </div>
               </div>
               <div class="ym-fbox-text">
                  <label for="signDate">Datum:</label>
                  <input type="text" name="signDate" id="signDate" size="25" required="required" aria-required="true"/>
               </div>
            </div>
         </div>

         <div class="ym-full">
            <div class="ym-fbox-text">
               <label for="company">Betriebliche Tätigkeit:</label>
               <textarea name="company" id="company" cols="100" rows="10"></textarea>
            </div>
            <div class="ym-fbox-text">
               <label for="training">Themen von Unterweisungen, Lehrgesprächen, betrieblichem Unterricht und außerbetrieblichen Schulungsveranstaltungen:</label>
               <textarea name="training" id="training" cols="100" rows="10"></textarea>
            </div>
            <div class="ym-fbox-text">
               <label for="school">Berufsschule (Themen des Unterrichts in den einzelnen Fächern):</label>
               <textarea name="school" id="school" cols="100" rows="10"></textarea>
            </div>
         </div>
         
         {if $error|default:false}
            <div class="ym-fbox-text ym-error">
               <p class="ym-message">
                  <img src="templates/icons/error.png" alt="Fehler Icon"/>
                  {$error}
               </p>
            </div>
         {/if}

         <div class="ym-fbox-button">
            <button type="submit" id="submit" name="submit" value="submit" class="ym-button ym-save">Bericht speichern</button>
         </div>
      </form>

      

   </div>
</div>

{include file="footer.tpl"}
