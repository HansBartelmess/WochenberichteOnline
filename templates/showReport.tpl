{include file="header.tpl" titel="Berichte Anzeigen"}
{include file="navigation.tpl"}
{print_r($azubi)}
<br> 
{print_r($reports)}
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
         <!--
         <div class="ym-fbox">
            <ul>
               {foreach $reports as $link}
                  <li><a href="showReports.php?reportNumber={$link.reportNumber}&id={$reports[$activeReport]['user_id']}">{$azubi[0]['name']} {$azubi[0]['surname']} Bericht vom {$link.startDate} - {getEndDateByStart($link.startDate)}</a></li>
               {/foreach}
            </ul>
         </div> 
         -->
         <div class="ym-grid ym-columnar">
            <div class="ym-gbox ym-fbox-select">
            <label for="reports">Berichte</label>
            <select name = "reports" id = "reports">
            {foreach $reports as $row}
               
                  {if ($smarty.session.role == "1")} 
                     <option value="{$row.reportid}">{$azubi[0]['name']} {$azubi[0]['surname']} Bericht vom {$row.startDate} - {getEndDateByStart($row.startDate)}</option>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <option value=""></option>
                  {/if}
            {/foreach}
            </select>
            </div>
         </div>


      </form> 
	  

      <form class="ym-form" method="post">
      {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
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
                  <input type="checkbox" name="change" id="change" onclick="enable_change(this,'{$smarty.session.role}');"/>
               </div>
               <div class="ym-fbox-text">
                  <label for="reportNumber">Ausbildungsnachweis:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="reportNumber" id="reportNumber" value="{$reports[$activeReport]['reportNumber']}" size="3"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="reportNumber" id="reportNumber" value="" size="3"/>
                  {/if}
               </div>
               <div class="ym-fbox-text">
                  <label for="division">Abteilung:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="division" id="division" value="{$reports[$activeReport]['division']}" size="25"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="division" id="division" value="" size="25"/>
                  {/if}
               </div>
            </div>

            <div class="ym-g50 ym-gr">
               <div class="ym-fbox-text">
                  <label for="startDate">für die Zeit vom:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="startDate" id="startDate" value="{$reports[$activeReport]['startDate']}" size="3"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="startDate" id="startDate" value="" size="3"/>
                  {/if}
                  <div style="float:right;" class="ym-clearfix">
                     {if ($smarty.session.role == "1")} 
                     bis: <span id="bis">{getEndDate($activeReport)}</span>
                     {/if}
                     {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     bis: <span id="bis"></span>
                     {/if}
                  </div>
               </div>
               <div class="ym-fbox-text">
                  <label for="signDate">Datum:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="signDate" id="signDate" value="" size="25"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="signDate" id="signDate" value="" size="25"/>
                  {/if}
               </div>
            </div>
         

         <div class="ym-full">
            <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="company">Betriebliche Tätigkeit:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="company" id="company" cols="100" rows="10">{$reports[$activeReport]['company']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="company" id="company" cols="100" rows="10"></textarea>
                  {/if}
			   </div>
		   </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteCompany">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="noteCompany" id="noteCompany" cols="10" rows="10" >{$reports[$activeReport]['noteCompany']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="noteCompany" id="noteCompany" cols="10" rows="10" ></textarea>
                  {/if}
               </div>
            </div>
		</div>
              
		<div class="ym-full">
            <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="training">Themen von Unterweisungen:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="training" id="training" cols="100" rows="10">{$reports[$activeReport]['training']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="training" id="training" cols="100" rows="10"></textarea>
                  {/if}
               </div>
            </div>
			
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteTraining">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="noteTraining" id="noteTraining" cols="10" rows="10" >{$reports[$activeReport]['noteTraining']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="noteTraining" id="noteTraining" cols="10" rows="10" ></textarea>
                  {/if}
               </div>
            </div>
        

		
           <div class="ym-g80 ym-gl">
               <div class="ym-fbox-text">
                  <label for="school">Berufsschule:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="school" id="school" cols="100" rows="10">{$reports[$activeReport]['school']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="school" id="school" cols="100" rows="10"></textarea>
                  {/if}
               </div>
            </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteSchool">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <textarea name="noteSchool" id="noteSchool" cols="10" rows="10" >{$reports[$activeReport]['noteSchool']}</textarea>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <textarea name="noteSchool" id="noteSchool" cols="10" rows="10" ></textarea>
                  {/if}
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
         <button type="button" id="submit" name="submit" value="submit" class="ym-button ym-save" onclick="getval('{$smarty.session.id}')">Änderungen speichern</button>
			<button type="button" id="pdf" name="pdf" value="pdf" class="ym-button ym-save">PDF erstellen</button>
       </div> 
    </form>
   </div>
</div></div>

{include file="footer.tpl"}
