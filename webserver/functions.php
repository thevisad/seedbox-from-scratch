<?php 
	class seedbox_site_functions{

	function __construct(){
	}
	
	function startService($servicename){
		$current="FOO";
		$filepath="../services/" . $servicename . '.start';
		file_put_contents($filepath, $current);
	}
	
	function stopService($servicename){
		$current="FOO";
		$filepath="../services/" . $servicename . '.stop';
		file_put_contents($filepath, $current);
	}
	
	function installService($servicename){
		$current="FOO";
		$filepath="../services/" . $servicename . '.install';
		file_put_contents($filepath, $current);
	}
	
	function installPlexService($plexusername){
		$current="FOO";
		$encpassword = shell_exec('sudo /etc/seedbox-from-scratch/sfsGenerateRandomPasswordString');
		//$encpassword="SkKNNotT9QEDElD4wDAQlkQgWEDZlJAI";
		$encplexusername = shell_exec('sudo /etc/seedbox-from-scratch/sfsEncryptTemporaryEncryptedText -t ' . escapeshellarg($plexusername) . ' -p ' . $encpassword);
		$filepath="../services/Plex.install";
		$userfilepath="../services/Plex.encrypteduser";
		$passfilepath="../services/Plex.encryptedpass";
		$encryptfilepath="../services/Plex.encrypt";
		file_put_contents($filepath, $current);
		file_put_contents($userfilepath, $encplexusername);
		file_put_contents($encryptfilepath, $encpassword);
	}
	
	function installMySQLService($mysqlversion, $rootpassword){
		$current=$mysqlversion;
		//$encpassword="PkrhPDwoxmy2tbshRmtg5wTt70luKZyY";
		$encpassword = shell_exec('sudo /etc/seedbox-from-scratch/sfsGenerateRandomPasswordString');
		$encrootpassword = shell_exec('sudo /etc/seedbox-from-scratch/sfsEncryptTemporaryEncryptedText -t ' . escapeshellarg($rootpassword) . ' -p ' . $encpassword);
		$filepath="../services/MySQL.install";
		$passfilepath="../services/MySQL.encyptedrootpass";
		$encryptfilepath="../services/MySQL.encrypt";
		file_put_contents($filepath, $current);
		file_put_contents($passfilepath, $encrootpassword);
		file_put_contents($encryptfilepath, $encpassword);
	}
	
	function installLetsEncryptService($letsencryptuseremail, $letsencryptsubdomainlist, $letsencryptdhlevel){
		$current=$letsencryptsubdomainlist;
		//$encpassword="V3xFSlpzUlP1uqCXr29xAhmv5t7svBk9";
		$encpassword = shell_exec('sudo /etc/seedbox-from-scratch/sfsGenerateRandomPasswordString');
		$encletsencryptemail = shell_exec('sudo /etc/seedbox-from-scratch/sfsEncryptTemporaryEncryptedText -t ' . escapeshellarg($letsencryptuseremail) . ' -p ' . $encpassword);
		$filepath="../services/LetsEncrypt.install";
		$passfilepath="../services/LetsEncrypt.encpass";
		$encryptfilepath="../services/LetsEncrypt.encrypt";
		$dhlevelfilepath="../services/LetsEncrypt.dhlevel";
		file_put_contents($filepath, $current);
		file_put_contents($passfilepath, $encletsencryptemail);	
		file_put_contents($encryptfilepath, $encpassword);		
		file_put_contents($dhlevelfilepath, $letsencryptdhlevel);
	}
	
	function deleteService($servicename){
		$current="FOO";
		$filepath="../services/" . $servicename . '.delete';
		$file  = realpath("../services/" . $servicename . '.delete') . PHP_EOL;
		file_put_contents($filepath, $current);
	}

	function checkIfServiceIsRunning($servicename){
		$file  = realpath("../services/" . $servicename . '.running') . PHP_EOL;
		if (file_exists($file )) {
			echo "The file $file exists";
		} else {
			echo "The file $file does not exist";
		}
	}
	
	function displayUserDetails(){
		$user = $_SERVER['PHP_AUTH_USER'];
		echo "Hello " .$user. "<br>"; 
	}
	
	function displayServiceDetails($service){
		$user = $_SERVER['PHP_AUTH_USER'];
		$output = shell_exec('sudo /etc/seedbox-from-scratch/sfsRunningUserDockerInfo -u ' . escapeshellarg($user) . ' -d ' . escapeshellarg($service) . ' 2>&1');
		$output = preg_replace("/[^A-Za-z0-9 ]/", '', $output);
		if ($output == "NOTINSTALLED"){
			echo "<img src='red-32px.png' height='16' /><br>";
		} 
		elseif ($output == "RUNNING"){
			echo "<img src='green-32px.png' height='16' /><br>"; 
		} 
		elseif ($output == "STOPPED"){
			echo "<img src='yellow-32px.png' height='16'/><br>"; 
		} 
	}
	
	function makelink($input) {
		$parse = explode(' ', $input);
		$input = "";
		foreach ($parse as $token) {
			$br = "<br>";
			if (strpos($token, "://") > 0) {
				$input .= '<a href="' . $token . '">' . $token . '</a> ';
			} else if(substr($token, 1, 3) == '---') {
				$input .= "<hr>";
				$br = "";
			} else {
				$input .= $token." ";
			}
		}
		return trim($input.$br);
	}

	function makefile($file){
		$data = file($file);
		foreach($data as $index=>$line) {
			$line = $this->makelink($line);
			echo $line;
		}

	}
}
?>