<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['MySQL']))
    {
		$mysqlversion=htmlspecialchars($_POST["mysqlversion"]);
		$mysqlrootpassword=htmlspecialchars($_POST["mysqlrootpassword"]);		
		$seedbox_site_functions->installMySQLService($mysqlversion, $mysqlrootpassword);
		header( 'Location: index.php' ) ;
	} else {
		?>
		<html>
		<form action="mysql.php" method="post">
		  <fieldset>
			<legend>MySQL Login Information:</legend>
			Root Password:<br>
			<input type="text" name="mysqlrootpassword"><br><br>
			MySQL Version:<br>
			<select name="mysqlversion">
			  <option value="5.5">5.5</option>
			  <option value="5.6">5.6</option>
			  <option value="5.7">5.7</option>
			  <option value="8.0">8.0</option>
			</select>
			<input type="submit" name="MySQL" value="Install">
		  </fieldset>
		</form>
		</html>
<?php
	}
?>