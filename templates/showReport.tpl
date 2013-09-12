{include file="header.tpl" titel="Berichte Anzeigen"}
{include file="navigation.tpl"}



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
{if ($smarty.session.id == "2" || $smarty.session.id == "3")}
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
{/if}
		 
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
         

         <div class="ym-full">
            <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="company">Betriebliche Tätigkeit:</label>
                  <textarea name="company" id="company" cols="100" rows="10">{$reports[$activeReport]['company']}</textarea>
			   </div>
		   </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                     <label for="noteCompany">Kommentar:</label>
                     <textarea name="noteCompany" id="noteCompany" cols="10" rows="10" >test</textarea>
               </div>
            </div>
		</div>
              
		<div class="ym-full">
            <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="training">Themen von Unterweisungen:</label>
                  <textarea name="training" id="training" cols="100" rows="10">{$reports[$activeReport]['training']}</textarea>
               </div>
            </div>
			
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                     <label for="noteTraining">Kommentar:</label>
                     <textarea name="noteTraining" id="noteTraining" cols="10" rows="10" >test</textarea>
               </div>
            </div>
        

		
           <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="school">Berufsschule:</label>
                  <textarea name="school" id="school" cols="100" rows="10">{$reports[$activeReport]['school']}</textarea>
               </div>
            </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                     <label for="noteSchool">Kommentar:</label>
                     <textarea name="noteSchool" id="noteSchool" cols="10" rows="10" >test</textarea>
               </div>
            </div>
			
			
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
</div></div>

{include file="footer.tpl"}
