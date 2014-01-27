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
         <h6>Nachweis anzeigen</h6>
      {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
         <div class="ym-grid ym-columnar">
            <div class="ym-gbox ym-fbox-select">
            <label for="azubi">Azubi</label>
            <select name = "azubi" id = "azubi">
            {foreach $azubi as $row} 
               {if ($randomazubi[0]['username'] != $row.username)}
                  <option value="{$row.username}">{$row.name} {$row.surname}</option>
               {else} 
                  <option value="{$row.username}" selected='selected'>{$row.name} {$row.surname}</option>
               {/if}  
            {/foreach}
            </select>
            </div>
         </div>
      {/if}
         <div class="ym-grid ym-columnar">
            <div class="ym-gbox ym-fbox-select">
            <label for="reports">Nachweise</label>
           
			<select id="bioselect">
				<option></option>
				{foreach from=$NACHWEIS item=items}
					<option>{$items}</option>
				{/foreach}
			</select>



		   <!-- <select name = "reports" id = "reports">
            {foreach $reports as $row}      
               {if ($smarty.session.role == "1")} 
                  <option value="{$row.id}">Nachweis {$row.reportNumber} vom {$row.startDate} - {getEndDateByStart($row.startDate)}</option>
               {/if}
               {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                  <option value=""></option>
               {/if}
            {/foreach}
            </select> -->
            </div>
         </div>

      </form> 
	  
	  
	 
      <form class="ym-form" method="post">
	  <div style="postition: relative; ">	  
	  <div id="LOADING" style="display: none; background-size: 10%; background-position:50% 50%; position: absolute; background-color: black; background-image: url('img/ajax_loader_blue.gif'); background-repeat: no-repeat; opacity: 0.4; width: 100%; height: 100%;z-index: 100000; "></div>
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
			<div class="ym-g66 ym-gl">
				<div id="mondiv" class="ym-fbox-text">
					<div class="ym-fbox-text">
						<label for="monWork0">Montag:</label>
							<input type="text" name="monWork0" id="monWork0" cols="80" />
					</div>  
				</div>	  
		    </div>
            <div id="montimediv" class="ym-fbox-text ym-g10 ym-gl ">
            	<label for="monHours0">Std:</label>
					<div class="ym-fbox-text">
						<input type="text" name="monHours0" id="monHours0" value="" size="2"/>
					</div>
			</div>
			   <!-- <div class="ym-g1 ym-gl">   
			      <div id="komdiv" class="ym-fbox-text">
                  <label for="noteMonday1">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteMonday1" id="noteMonday1" cols="8" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteMonday1" id="noteMonday1" cols="8" />
                  {/if}
               </div>
            </div> -->
		</div>
   

         <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  <label for="tuesdayWork1">Dienstag:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="tuesdayWork1" id="tuesdayWork1" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="tuesdayWork1" id="tuesdayWork1" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         <label for="tuHours1">Std:</label>
         {if ($smarty.session.role == "1")} 
            <input type="text" name="tuHours1" id="tuHours1" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="tuHours1" id="tuHours1" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteTuesday1">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteTuesday1" id="noteTuesday1" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteTuesday1" id="noteTuesday1" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="tuesdayWork2" id="tuesdayWork2" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="tuesdayWork2" id="tuesdayWork2" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="tuHours2" id="tuHours2" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="tuHours2" id="tuHours2" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteTuesday2" id="noteTuesday2" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteTuesday2" id="noteTuesday2" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
         <div class="ym-g75 ym-gl">
            <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="tuesdayWork3" id="tuesdayWork3" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="tuesdayWork3" id="tuesdayWork3" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="tuHours3" id="tuHours3" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="tuHours3" id="tuHours3" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteTuesday3" id="noteTuesday3" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteTuesday3" id="noteTuesday3" cols="10" />
                  {/if}
            </div>
         </div>
		</div>



         <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  <label for="wednesdayWork1">Mittwoch:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="wednesdayWork1" id="wednesdayWork1" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="wednesdayWork1" id="wednesdayWork1" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         <label for="weHours1">Std:</label>
         {if ($smarty.session.role == "1")} 
            <input type="text" name="weHours1" id="weHours1" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="weHours1" id="weHours1" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteWednesday1">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteWednesday1" id="noteWednesday1" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteWednesday1" id="noteWednesday1" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="wednesdayWork2" id="wednesdayWork2" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="wednesdayWork2" id="wednesdayWork2" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="weHours2" id="weHours2" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="weHours2" id="weHours2" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteWednesday2" id="noteWednesday2" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteWednesday2" id="noteWednesday2" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
         <div class="ym-g75 ym-gl">
            <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="wednesdayWork3" id="wednesdayWork3" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="wednesdayWork3" id="wednesdayWork3" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="weHours3" id="weHours3" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="weHours3" id="weHours3" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteWednesday3" id="noteWednesday3" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteWednesday3" id="noteWednesday3" cols="10" />
                  {/if}
            </div>
         </div>
		</div>



         <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  <label for="thursdayWork1">Donnerstag:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="thursdayWork1" id="thursdayWork1" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="thursdayWork1" id="thursdayWork1" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         <label for="thHours1">Std:</label>
         {if ($smarty.session.role == "1")} 
            <input type="text" name="thHours1" id="thHours1" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="thHours1" id="thHours1" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteThursday1">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteThursday1" id="noteThursday1" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteThursday1" id="noteThursday1" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="thursdayWork2" id="thursdayWork2" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="thursdayWork2" id="thursdayWork2" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="thHours2" id="thHours2" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="thHours2" id="thHours2" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteThursday2" id="noteThursday2" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteThursday2" id="noteThursday2" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
         <div class="ym-g75 ym-gl">
            <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="thursdayWork3" id="thursdayWork3" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="thursdayWork3" id="thursdayWork3" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="thHours3" id="thHours3" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="thHours3" id="thHours3" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteThursday3" id="noteThursday3" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteThursday3" id="noteThursday3" cols="10" />
                  {/if}
            </div>
         </div>
		</div>



         <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  <label for="fridayWork1">Freitag:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="fridayWork1" id="fridayWork1" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="fridayWork1" id="fridayWork1" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         <label for="frHours1">Std:</label>
         {if ($smarty.session.role == "1")} 
            <input type="text" name="frHours1" id="frHours1" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="frHours1" id="frHours1" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  <label for="noteFriday1">Kommentar:</label>
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteFriday1" id="noteFriday1" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteFriday1" id="noteFriday1" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
            <div class="ym-g75 ym-gl">
               <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="fridayWork2" id="fridayWork2" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="fridayWork2" id="fridayWork2" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="frHours2" id="frHours2" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="frHours2" id="frHours2" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteFriday2" id="noteFriday2" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteFriday2" id="noteFriday2" cols="10" />
                  {/if}
               </div>
            </div>
		</div>
      <div class="ym-full">
         <div class="ym-g75 ym-gl">
            <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="fridayWork3" id="fridayWork3" cols="100"/>
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="fridayWork3" id="fridayWork3" cols="100" />
                  {/if}
			   </div>
		   </div>
         <div class="ym-g5 ym-gl">
         {if ($smarty.session.role == "1")} 
            <input type="text" name="frHours3" id="frHours3" value="" size="3"/>
         {/if}
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <input type="text" name="frHours3" id="frHours3" value="" size="3"/>
         {/if}

         </div>
			<div class="ym-g20 ym-gl">   
			   <div class="ym-fbox-text">
                  {if ($smarty.session.role == "1")} 
                     <input type="text" name="noteFriday3" id="noteFriday3" cols="10" />
                  {/if}
                  {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
                     <input type="text" name="noteFriday3" id="noteFriday3" cols="10" />
                  {/if}
            </div>
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
         <button type="button" id="submit" name="submit" value="submit" class="ym-button ym-save" onclick="getval('{$smarty.session.role}')">Ãnderungen speichern</button>
			<button type="button" id="pdf" name="pdf" value="pdf" class="ym-button ym-save">PDF erstellen</button>
         {if ($smarty.session.role == "2" || $smarty.session.role == "3")}
            <label for="signed">Unterzeichnen:</label>
            <input type="checkbox" name="signed" id="signed" onclick="set_signed(this,'{$smarty.session.role}');"/>
         {/if}
       </div> 
    </form>
   </div>
</div>

{include file="footer.tpl"}


