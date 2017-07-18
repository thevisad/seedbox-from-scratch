<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Plex']))
    {
		$plexusername=htmlspecialchars($_POST["plexusername"]);	
		$seedbox_site_functions->installPlexService($plexusername);
		header( 'Location: index.php' ) ;
	} else {
		?>
		<html>
		<form action="plex.php" method="post">
		  <fieldset>
			<legend>Plex Login Information:</legend>
			Token:<br>
			<input type="text" name="plexusername"><br>
			<input type="submit" name="Plex" value="Install">
		  </fieldset>
		</form>
		</html>
<?php
	}
?>