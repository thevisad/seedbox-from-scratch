<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();	
?>
<html>
	<head>
		<style>
		table, th, td {
		border: 1px solid black;
		}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th>Service</th>
				<th>Status</th>
				<th>Service</th>
				<th>Status</th>
			</tr>
			<tr>
				<td>couchpotato</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("couchpotato"); ?></td>
				<td>deluge</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("deluge"); ?></td>
			</tr>
			<tr>
				<td>letsencrypt</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("letsencrypt"); ?></td>
				<td>mysql</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("mysql"); ?></td>
			</tr>
			<tr>
				<td>plex</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("plex"); ?></td>
				<td>rapidleech</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("rapidleech"); ?></td>
			</tr>
			<tr>
				<td>rutorrent</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("rutorrent"); ?></td>
				<td>sabnzbd</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("sabnzbd"); ?></td>
			</tr>
			<tr>
				<td>sickbeard</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("sickbeard"); ?></td>
				<td>sickrage</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("sickrage"); ?></td>
			</tr>
			<tr>
				<td>ubooquity</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("ubooquity"); ?></td>
				<td>filemanager</td>
				<td><?php $seedbox_site_functions->displayServiceDetails("filemanager"); ?></td>
			</tr>
		</table>
	</body>
</html>