{include file="header.tpl" titel="Berichte Anzeigen"}
{include file="navigation.tpl"}


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

<div id="main">
   <div class="ym-wrapper">

      {if $saved|default:false}
         <div class="ym-wbox">
            <img src="templates/icons/accept.png" />
            Bericht wurde erfolgreich gespeichert!
         </div>
      {/if}
	  
	   <form class="ym-form">
         <h6>Berichte anzeigen</h6>
         <div class="ym-fbox">
            <ul>
               {foreach $reports as $link}
                  <li><a href="showReports.php?reportNumber={$link.reportNumber}&id={$reports[$activeReport]['user_id']}">{$azubi[0]['name']} {$azubi[0]['surname']} Bericht vom {$link.startDate} - {getEndDateByStart($link.startDate)}</a></li>
               {/foreach}
            </ul>
         </div>  
      </form> 
	  

      <form class="ym-form" method="post">
<!--      
         <div class="ym-grid ym-columnar">
            <div class="ym-gbox ym-fbox-select">
            <label for="azubi">Azubi</label>
            <select name = "azubi" id = "azubi">
            {foreach $azubi as $row}
               <option value="{$row.username}">{$row.name} {$row.surname}</option>
            {/foreach}
            </select>
            </div>
         </div>


		   <div class="ym-grid ym-columnar">
            <div class="ym-gbox ym-fbox-select">
            <label for="activeReport">Bericht</label>
            <select name = "activeReport" id = "activeReport">
            {foreach $reports as $row}
               <option value="{$row.id}"> Bericht Nr. {$row.id}</option>
            {/foreach}
            </select>
            </div>
         </div>
--!>		 
         <div class="ym-grid ym-columnar">
            <div class="ym-g50 ym-gl">
			
			<div class="ym-fbox-text">
                  <label for="change">Bearbeiten:</label>
                  <input type="checkbox" name="change" id="change" onclick="enable_change(this);"/>
               </div>
			
               <div class="ym-fbox-text">
                  <label for="reportNumber">Ausbildungsnachweis:</label>
                  <input type="text" name="reportNumber" id="reportNumber" value="{$reports[$activeReport]['reportNumber']}" size="3"/>
               </div>
               <div class="ym-fbox-text">
                  <label for="division">Abteilung:</label>
                  <input type="text" name="division" id="division" value="{$reports[$activeReport]['division']}" size="25"/>
               </div>
            </div>

            <div class="ym-g50 ym-gr">
               <div class="ym-fbox-text">
                  <label for="startDate">für die Zeit vom:</label>
                  <input type="text" name="startDate" id="startDate" value="{$reports[$activeReport]['startDate']}" size="3"/>
                  <div style="float:right;" class="ym-clearfix">
                     bis: <span id="bis">{getEndDate($activeReport)}</span>
                  </div>
               </div>
               <div class="ym-fbox-text">
                  <label for="signDate">Datum:</label>
                  <input type="text" name="signDate" id="signDate" value="" size="25"/>
               </div>
            </div>
         </div>

         <div class="ym-full">
            <div class="ym-fbox-text">
               <label for="company">Betriebliche Tätigkeit:</label>
               <textarea name="company" id="company" cols="100" rows="10">{$reports[$activeReport]['company']}</textarea>
            </div>
            <div class="ym-fbox-text">
               <label for="training">Themen von Unterweisungen, Lehrgesprächen, betrieblichem Unterricht und außerbetrieblichen Schulungsveranstaltungen:</label>
               <textarea name="training" id="training" cols="100" rows="10">{$reports[$activeReport]['training']}</textarea>
            </div>
            <div class="ym-fbox-text">
               <label for="school">Berufsschule (Themen des Unterrichts in den einzelnen Fächern):</label>
               <textarea name="school" id="school" cols="100" rows="10">{$reports[$activeReport]['school']}</textarea>
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
            <button type="submit" id="submit" name="submit" value="submit" class="ym-button ym-save">Änderungen speichern</button>
			<button type="button" id="pdf" name="pdf" value="pdf" class="ym-button ym-save">PDF erstellen</button>
         </div>
    </form>
   </div>
</div>

{include file="footer.tpl"}
