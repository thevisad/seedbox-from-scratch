<?php
	ob_start("ob_gzhandler");
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
	session_start();
	$seedbox_site_functions->displayUserDetails();
?>
<html>
<head>
<script type="text/javascript" src="jquery-3.2.1.min"></script>
<script type="text/javascript">
var repeater;
function doWork() {
	$(document).ready(function() { 
		setTimeout(function() {
			$(".details").load('services.php');
		},5000);
	});
	repeater = setTimeout(doWork, 10000);
}
doWork();
</script>
</head>
<body>
<div>
<a href = "userdetails.php" target = _blank>User Details</a>
</div>

<div id="menu1" class="menu_content">
	<div class="right-pane">
		<div class="details">
			<?php include('services.php'); ?>
		</div>
	</div>
</div>
	
<div id="menu2" class="menu_content">
<table>
	<tr>
		<th>Service</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<tr>
		<td>RapidLeech</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RapidLeech" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RapidLeech" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RapidLeech" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RapidLeech" value="Start" />
			</form>
		</td>
		<td>
				<form action="handleactions.php" method="post">
			<input type="submit" name="RapidLeech" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Deluge</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Deluge" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Deluge" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Deluge" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Deluge" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Deluge" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>RTorrent</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RTorrent" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RTorrent" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RTorrent" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="RTorrent" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="RTorrent" value="Restart" />
			</form>
		</td>
	</tr>
	<tr>
		<td>FileManager</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="FileManager" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="FileManager" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="FileManager" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="FileManager" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="FileManager" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Couchpotato</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Couchpotato" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Couchpotato" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Couchpotato" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Couchpotato" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Couchpotato" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>LetsEncrypt</td>
		<td>
			<form action="letsencrypt.php" method="post">
			<input type="submit" name="LetsEncryptInstall" value="Configure" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="LetsEncrypt" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="LetsEncrypt" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="LetsEncrypt" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="LetsEncrypt" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>MySQL</td>
		<td>
			<form action="mysql.php" method="post">
			<input type="submit" name="MySQLInstall" value="Configure" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="MySQL" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="MySQL" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="MySQL" value="Start" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="MySQL" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<tr>
		<td>Plex</td>
		<td>
			<form action="plex.php" method="post">
			<input type="submit" name="PlexInstall" value="Configure" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Plex" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Plex" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Plex" value="Start" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Plex" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Sabnzbd</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sabnzbd" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sabnzbd" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sabnzbd" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sabnzbd" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Sabnzbd" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Sickbeard</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickbeard" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickbeard" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickbeard" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickbeard" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Sickbeard" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Sickrage</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickrage" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickrage" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickrage" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sickrage" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Sickrage" value="Restart" />
			</form>
		</td>
	</tr>
		<tr>
		<td>Ubooquity</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Ubooquity" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Ubooquity" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Ubooquity" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Ubooquity" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Ubooquity" value="Restart" />
			</form>
		</td>
	</tr>
	
	<tr>
		<td>Radarr</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Radarr" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Radarr" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Radarr" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Radarr" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Radarr" value="Restart" />
			</form>
		</td>
	</tr>
	<tr>
		<td>Sonarr</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sonarr" value="Install" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sonarr" value="Delete" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sonarr" value="Stop" />
			</form>
		</td>
		<td>
			<form action="handleactions.php" method="post">
			<input type="submit" name="Sonarr" value="Start" />
			</form>
		</td>
		<td>
		<form action="handleactions.php" method="post">
			<input type="submit" name="Sonarr" value="Restart" />
			</form>
		</td>
	</tr>
</table>
</div>
</body>
</html>