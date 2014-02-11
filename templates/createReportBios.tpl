{include file="header.tpl" titel="Bericht Eintragen"}
{include file="navigation.tpl"}

<style>
.ui-widget {
    font-family: Verdana;
    font-size: 12px;
}
.ui-button {
	color: #f6f0f0;
	border-radius: 0px;
}

.ui-button:hover {
	-moz-box-shadow: 0 0 1px 1px #4e78e0;
	-webkit-box-shadow: 0 0 1px 1px #4e78e0;
	box-shadow: 0 0 1px 1px #4e78e0;

}

.ui-widget-content {
    background:#f6f0f0;
    border: 1px solid #4e78e0;
    border-radius: 0px;
    color: #222222;
}


.ui-widget-header {
    background: #4e78e0;
    border: 0;
    color: #fff;
    font-weight: normal;
}

.ui-dialog .ui-dialog-titlebar {
    padding: 0.1em .5em;
    position: relative;
    font-size: 1em;
    border-radius: 0px;
}​
</style>
<div id="main">
   <div class="ym-wrapper"> 
  
      {if $saved|default:false}
         <div class="ym-wbox">
            <img src="templates/icons/accept.png" />
            Bericht wurde erfolgreich gespeichert!
         </div>
      {/if}

     <!-- <form class="ym-form" method="post"> -->
     <div class="ym-form" > 

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
               <div class="ym-fbox-text">
                  <label for="betreuer">Betreuer:<sup class="ym-required">*</sup></label>
                  <input type="text" name="betreuer" id="betreuer" size="25" required="required" aria-required="true"/>
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
                  <div id="mondiv" class="ym-fbox-text">
                     <label for="monWork1"><img onclick="add_c('mon')" src="img/plus.png" style="width: 5%;margin-right: 10px; cursor: pointer;">Montag:</label>
                     <input type="text" name="monWork0" id="monWork0" size="120" />
		            </div>
			      </div>
               <div class="ym-g25 ym-gr">
                  <div id="montime" class="ym-fbox-text">
                     <label for="monHours">Std:</label>
                     <input type="text" name="monHours0" id="monHours0" value="" size="5" />
                  </div>
				   </div>
		      </div>



            <div class="ym-full">
               <div class="ym-g75 ym-gl">
                  <div id="diediv" class="ym-fbox-text">
                     <label for="dieWork"><img onclick="add_c('die')" src="img/plus.png" style="width: 5%;margin-right: 10px; cursor: pointer;">Dienstag:</label>
                     <input type="text" name="dieWork0" id="dieWork0" size="120" />
		            </div>
			      </div>
               <div class="ym-g25 ym-gr">
                  <div id="dietime" class="ym-fbox-text">
                     <label for="dieHours">Std:</label>
                     <input type="text" name="dieHours0" id="dieHours0" value="" size="5" />
                  </div>
				   </div>
		      </div>



            <div class="ym-full">
               <div class="ym-g75 ym-gl">
                  <div id="mitdiv" class="ym-fbox-text">
                     <label for="mitWork"><img onclick="add_c('mit')" src="img/plus.png" style="width: 5%;margin-right: 10px; cursor: pointer;">Mittwoch:</label>
                     <input type="text" name="mitWork0" id="mitWork0" size="120" />
		            </div>
			      </div>
               <div class="ym-g25 ym-gr">
                  <div id="mittime" class="ym-fbox-text">
                     <label for="mitHours">Std:</label>
                     <input type="text" name="mitHours0" id="mitHours0" value="" size="5" />
                  </div>
				   </div>
		      </div>



            <div class="ym-full">
               <div class="ym-g75 ym-gl">
                  <div id="dondiv" class="ym-fbox-text">
                     <label for="donWork"><img onclick="add_c('don')" src="img/plus.png" style="width: 5%;margin-right: 10px; cursor: pointer;">Donnerstag:</label>
                     <input type="text" name="donWork0" id="donWork0" size="120" />
		            </div>
			      </div>
               <div class="ym-g25 ym-gr">
                  <div id="dontime" class="ym-fbox-text">
                     <label for="donHours">Std:</label>
                     <input type="text" name="donHours0" id="donHours0" value="" size="5" />
                  </div>
				   </div>
		      </div>



            <div class="ym-full">
               <div class="ym-g75 ym-gl">
                  <div id="freidiv"class="ym-fbox-text">
                     <label for="freiWork"><img onclick="add_c('frei')" src="img/plus.png" style="width: 5%;margin-right: 10px; cursor: pointer;">Freitag:</label>
                     <input type="text" name="freiWork0" id="freiWork0" size="120" />
		            </div>
			      </div>
               <div class="ym-g25 ym-gr">
                  <div id="freitime" class="ym-fbox-text">
                     <label for="freiHours">Std:</label>
                     <input type="text" name="freiHours0" id="freiHours0" value="" size="5" />
                  </div>
				   </div>
		      </div>

	<div title="Please Confirm" style="display: none" id="d">
		<p> You want really add more fields? </p>
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
            <button onclick="save_data();" type="submit" id="submit" name="submit" value="submit" class="ym-button ym-save">Bericht speichern</button>
         </div>
 
</div>
</div>

{include file="footer.tpl"}
