<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Plex']))
    {
		$plexusername=htmlspecialchars($_POST["plexusername"]);	
		if(isset($_POST['plexpass']) && $_POST['plexpass'] == 'yes') 
		{
			$seedbox_site_functions->installPlexService($plexusername,"yes");
		} else {
			$seedbox_site_functions->installPlexService($plexusername,"no");
		}
		
		header( 'Location: index.php' ) ;
	} else {
		?>
		<html>
		<a href="https://www.plex.tv/claim/" target=_blank> Get your Plex claim token</a>
		<form action="plex.php" method="post">
		  <fieldset>
			<legend>Plex Login Information:</legend>
			Claim Token:<br>
			<input type="text" name="plexusername"><br>
			<input type="checkbox" name="plexpass" value="yes" />
			<input type="submit" name="Plex" value="Install">
		  </fieldset>
		</form>
		</html>
<?php
	}
?>