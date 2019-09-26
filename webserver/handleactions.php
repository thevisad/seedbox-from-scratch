<?php
	require_once('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
	
	
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['RapidLeech']))
    {
		$postvar=htmlspecialchars($_POST["RapidLeech"]);
		$servicename="RapidLeech";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Deluge']))
    {
		$postvar=htmlspecialchars($_POST["Deluge"]);
		$servicename="Deluge";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['RTorrent']))
    {
		$postvar=htmlspecialchars($_POST["RTorrent"]);
		$servicename="RTorrent";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['FileManager']))
    {
		$postvar=htmlspecialchars($_POST["FileManager"]);
		$servicename="FileManager";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Couchpotato']))
    {
		$postvar=htmlspecialchars($_POST["Couchpotato"]);
		$servicename="Couchpotato";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['LetsEncrypt']))
    {
		$postvar=htmlspecialchars($_POST["LetsEncrypt"]);
		$servicename="LetsEncrypt";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['MySQL']))
    {
		$postvar=htmlspecialchars($_POST["MySQL"]);
		$servicename="MySQL";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Plex']))
    {
		$postvar=htmlspecialchars($_POST["Plex"]);
		$servicename="Plex";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Update":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->updateService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Sabnzbd']))
    {
		$postvar=htmlspecialchars($_POST["Sabnzbd"]);
		$servicename="Sabnzbd";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Sickbeard']))
    {
		$postvar=htmlspecialchars($_POST["Sickbeard"]);
		$servicename="Sickbeard";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Sickrage']))
    {
		$postvar=htmlspecialchars($_POST["Sickrage"]);
		$servicename="Sickrage";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Ubooquity']))
    {
		$postvar=htmlspecialchars($_POST["Ubooquity"]);
		$servicename="Ubooquity";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Configure":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->configureService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Radarr']))
    {
		$postvar=htmlspecialchars($_POST["Radarr"]);
		$servicename="Radarr";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Sonarr']))
    {
		$postvar=htmlspecialchars($_POST["Sonarr"]);
		$servicename="Sonarr";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	
	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['SyncThing']))
    {
		$postvar=htmlspecialchars($_POST["SyncThing"]);
		$servicename="SyncThing";
		switch($postvar)
		{
			case "Install":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->installService($servicename);
			break;
			case "Delete":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->deleteService($servicename);
			break;
			case "Start":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->startService($servicename);
			break;
			case "Restart":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->restartService($servicename);
			break;
			case "Stop":
			  echo 'Hello ' . $servicename . " service current task is to " . $postvar . '!';
			  $seedbox_site_functions->stopService($servicename);
			break;
		}
		header( 'Location: index.php' ) ;
    }
	header( 'Location: index.php' ) ;
?>