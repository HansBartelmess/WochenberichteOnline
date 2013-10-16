{include file="header.tpl" titel="Bericht Eintragen"}
{include file="navigation.tpl"}


<div id="main">
   <div class="ym-wrapper">

      {if $saved|default:false}
         <div class="ym-wbox">
            <img src="templates/icons/accept.png" />
            Bericht wurde erfolgreich gespeichert!
         </div>
      {/if}

      <form class="ym-form" method="post">

         <h6>Nachweis eintragen</h6>
         
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
                  <input type="text" name="startDate" id="startDate" size="3" required="required" aria-required="true" onchange="validate_date();"/>
                  <div style="float:right;" class="ym-clearfix">
                     bis: <span id="bis"></span>
                  </div>
               </div>
               <div class="ym-fbox-text">
                  <label for="signDate">Datum:</label>
                  <input type="text" name="signDate" id="signDate" size="25"/>
               </div>
            </div>
          

         <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  <label for="mondayWork1">Montag:</label>
                  <input type="text" name="mondayWork1" id="mondayWork1" size="75" />
			      </div>
		      </div>
            <div class="ym-g5 ym-gl">
               <label for="moHours1">Std:</label>
               <input type="text" name="moHours1" id="moHours1" value="" size="3" />
            </div>
			   <div class="ym-g20 ym-gl">   
			      <div class="ym-fbox-text">
                  <label for="noteMonday1">Kommentar:</label>
                  <input type="text" name="noteMonday1" id="noteMonday1" size="10" />
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
            <button type="submit" id="submit" name="submit" value="submit" class="ym-button ym-save">Bericht speichern</button>
         </div>
      </div>
   </form>

      

   </div>
</div>

{include file="footer.tpl"}
