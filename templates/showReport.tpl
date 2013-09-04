{include file="header.tpl" titel="Berichte Anzeigen"}
{include file="navigation.tpl"}

<br>
{print_r ($azubi)}
<br>

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
      </form>
	  
      <form class="ym-form" method="post">
        
        
        
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
		 
         <div class="ym-grid ym-columnar">
            <div class="ym-g50 ym-gl">
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
                     bis: <span id="bis">xx.xx.xxxx</span>
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
         </div>
      </form>

      

   </div>
</div>

{include file="footer.tpl"}
