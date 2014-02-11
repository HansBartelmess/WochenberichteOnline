{include file="header.tpl" titel="Einstellungen"}
{include file="navigation.tpl"}

<script>
$(window).load(function () {
	$("#username").attr('readonly', true);
	$("#username").css('background-color', '#D5D5D5');
	  
	$("#surname").attr('readonly', true);
	$("#surname").css('background-color', '#D5D5D5');
	  
	$("#name").attr('readonly', true);
	$("#name").css('background-color', '#D5D5D5')
 
	$("#email").attr('readonly', true);
	$("#email").css('background-color', '#D5D5D5')
		  
	$("#division").attr('readonly', true);
	$("#division").css('background-color', '#D5D5D5')

});

function enable_change(elem) {
	
	if($(elem).is(':checked')){ 
	
	$("#username").attr('readonly', false);
	$("#username").css('background-color', '#FFFFFF');
	  
	$("#surname").attr('readonly', false);
	$("#surname").css('background-color', '#FFFFFF');
	  
	$("#name").attr('readonly', false);
	$("#name").css('background-color', '#FFFFFF')
 
	$("#email").attr('readonly', false);
	$("#email").css('background-color', '#FFFFFF')
		  
	$("#division").attr('readonly', false);
	$("#division").css('background-color', '#FFFFFF')
	
	}
	else {
		$("#username").attr('readonly', true);
		$("#username").css('background-color', '#D5D5D5');
		  
		$("#surname").attr('readonly', true);
		$("#surname").css('background-color', '#D5D5D5');
		  
		$("#name").attr('readonly', true);
		$("#name").css('background-color', '#D5D5D5')
	 
		$("#email").attr('readonly', true);
		$("#email").css('background-color', '#D5D5D5')
			  
		$("#division").attr('readonly', true);
		$("#division").css('background-color', '#D5D5D5')
	
	}

}

</script>

<div id="main">
	<div class="ym-wrapper">
		<form class="ym-form" method="post">
			<div class="ym-grid ym-columnar">
				<div class="ym-g50 ym-gl">
					<div class="ym-fbox-text">
						<label for="Username">Username:</label>
						<input type="text" name="username" id="username" size="3" value="{$userstats['0']['username']}"/>
					</div>
					<div class="ym-fbox-text">
						<label for="surname">Vorname:</label>
						<input type="text" name="surname" id="surname" size="3" value="{$userstats['0']['surname']}"/>
					</div>
					<div class="ym-fbox-text">
						<label for="name">Nachname:</label>
						<input type="text" name="name" id="name" size="3" value="{$userstats['0']['name']}"/>
					</div>
					<div class="ym-fbox-text">
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value="{$userstats['0']['email']}" size="25"/>
					</div>
					<div class="ym-fbox-text">
						<label for="division">Abteilung:</label>
						<input type="text" name="division" id="division" value="{$reports[$activeReport]['division']}" size="25"/>
					</div>
					<div class="ym-fbox-text">
						<label for="change">Bearbeiten:</label>
						<input type="checkbox" name="change" id="change" onclick="enable_change(this);"/>
					</div>
					<div class="ym-fbox-button">
						<button type="submit" id="submit" name="submit" value="submit" class="ym-button ym-save">Änderungen speichern</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

{include file="footer.tpl"}
