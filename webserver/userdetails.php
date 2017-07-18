<?php
	require('./functions.php');
	$seedbox_site_functions = new seedbox_site_functions();
	$seedbox_site_functions->makefile("SBinfo.txt");
	echo "<hr>";
	echo "<hr>";
	echo "List of User Services";
	echo "<hr>";
	if ($handle = opendir('.')) {
	echo "<hr>";
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'serviceinfo')
			{
				$seedbox_site_functions->makefile($file);
				echo "<hr>";
			}
		}

		closedir($handle);
	}
?>
