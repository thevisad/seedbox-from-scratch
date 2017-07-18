<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['LetsEncrypt']))
    {
		$letsencryptuseremail=htmlspecialchars($_POST["letsencryptuseremail"]);
		$letsencryptsubdomainlist=htmlspecialchars($_POST["letsencryptsubdomainlist"]);		
		$letsencryptdhlevel=htmlspecialchars($_POST["letsencryptdhlevel"]);	
		$seedbox_site_functions->installLetsEncryptService($letsencryptuseremail, $letsencryptsubdomainlist, $letsencryptdhlevel);
		header( 'Location: index.php' ) ;
	} else {
		?>
		<html>
		<form action="plex.php" method="post">
		  <fieldset>
			<legend>LetsEncrypt Login Information:</legend>
			LetsEncrypt Email:<br>
			<input type="text" name="letsencryptuseremail"><br>
			Comma Seperated Subdomain List:<br>
			<input type="text" name="letsencryptsubdomainlist"><br>
			DH Level:<br>
			<select name="letsencryptdhlevel">
			  <option value="5.5">1024</option>
			  <option value="5.6">2048</option>
			  <option value="5.6">4096</option>
			</select>
			<input type="submit" name="LetsEncrypt" value="Install">
		  </fieldset>
		</form>
		</html>
<?php
	}
?>