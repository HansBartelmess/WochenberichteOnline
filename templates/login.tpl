{include file="header.tpl" titel="Anmeldung"}

<div id="main">
   <div class="ym-wrapper">

      {if $login|default:false}
         <div class="ym-wbox">
            <meta http-equiv="refresh" content="2; url=start.php">
            <p class="ym-message">
               <img src="templates/icons/accept.png" alt="Erfolgreich Icon" />
               Sie wurden eingeloggt. <br />
               Sollte die automatische weiterleitung nicht funktionieren klicken Sie bitte <a href="start.php"> hier </a>
            </p>
         </div>

      {else}
         <form class="ym-form" method="post">
            <h6>Anmeldung</h6>

            <div class="ym-fbox-text">
               <label for="username">Benutzername:<sup class="ym-required">*</sup></label>
               <input type="text" name="username" id="username" size="25" required="required" aria-required="true"/>
            </div>

            <div class="ym-fbox-text">
               <label for="password">Passwort:<sup class="ym-required">*</sup></label>
               <input type="password" name="password" id="password" size="25" required="required" aria-required="true"/>
            </div>

            {if $error|default:false}
               <div class="ym-fbox-text ym-error">
                  <p class="ym-message">
                     <img src="templates/icons/error.png" alt="Fehler Icon" />
                     {$error}
                  </p>
               </div>
            {/if}

            <div class="ym-fbox-button">
               <button type="submit" id="submit" name="submit" value="submit" class="ym-button ym-next">Anmelden</button>
            </div>
         </form>

      {/if}

   </div>
</div>

{include file="footer.tpl"}
