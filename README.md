## The Seedbox From Scratch Mod 2 Script
Donate by buying me a Beer : paypal address: visad@yahoo.com

## [Wiki](https://github.com/thevisad/seedbox-from-scratch/wiki)
## Current version = 16.00

This script has been heavily modified from the original, you can upgrade the original to this version with a little effort. A script may be created later to handle the upgrade process

* A true multi-user enviroment
* 
* Linux Quota, to control how much space every user can use in your box.
* Individual User Login Info https://Server-IP/private/SBinfo.txt
* Individual User Https Downloads directory (https://Server-IP/private/Downloads)

## Installed software
* mktorrent
* Fail2ban - to avoid apache and ssh exploits. Fail2ban bans IPs that show malicious signs -- too many password failures, seeking for exploits, etc.
* Apache (SSL)
* OpenVPN 
* OS Specific PHP and PHP-FPM (FastCGI to increase performance)
* Linux Quota
* SSH Server (for SSH terminal and sFTP connections)
* vsftpd (Very Secure FTP Deamon)
* IRSSI
* Webmin (use it to manage your users quota)
* sabnzbd (http://sabnzbd.org)
* SiCKRAGE
* Subsonic
* ZNC
* Docker Plex (https://github.com/timhaak/docker-plex)
* Docker MySQL https://github.com/linuxserver/docker-mysql
* Docker Deluge https://github.com/linuxserver/docker-deluge
* Docker RuTorrent https://github.com/linuxserver/docker-rutorrent
* Docker Ubooquity https://github.com/linuxserver/docker-ubooquity

Pending Removal
* ruTorrent 3.7 + official plugins
* rTorrent 0.8.9, 0.9.2, 0.9.3 or 0.9.6
* libTorrrent 0.13.3, 0.13.4 or 0.13.6

Pending Additions
* https://github.com/linuxserver/docker-piwigo
* Docker Rapidleech 
* Docker sabnzbd https://github.com/linuxserver/docker-sabnzbd

## Before installation
You need to have a Fresh "blank" server installation.
After that access your box using a SSH client, like PuTTY and then type the following command.

sudo apt-get install -y git

## How to install
Download the repository using the following 

cd /opt
sudo git clone https://github.com/thevisad/seedbox-from-scratch
cd seedbox-from-scratch
*All scripts should be executable by default, if there is any issue with them you can run ( sudo chmod +x /opt/seedbox-from-scratch/updateExecutables )
sudo ./seedbox-from-scratch.sh

## How to update

cd /opt/seedbox-from-scratch
sudo git reset --hard
sudo git pull 
*All scripts should be executable by default, if there is any issue with them you can run ( sudo chmod +x /opt/seedbox-from-scratch/updateInstalledScripts )
sudo ./updateInstalledScripts

## You must be logged in as root to run this installation or use sudo on it.

## Commands
After installing you will have access to the following commands to be used directly in terminal
* createSeedboxUser
* deleteSeedboxUser
* changeUserPassword  >>> [ changeUserPassword USERNAME NEWPASSWORD rutorrent ]
* installRapidleech
* installOpenVPN
* installSABnzbd
* installWebmin
* installSICKRAGE
* installPLEX
* installSUBSONIC
* installZNC
* speedTEST >>> To do commandline speedtest
* updategitRepository
* removeWebmin
* restartSeedbox

<b>While executing them, if sudo is needed, they will ask for a password.</b>

## Services
To access services installed on your new server point your browser to the following address:
```
https://<Server IP or Server Name>/private/SBinfo.txt
```

## Download Directory
To access Downloaded data directory on your new server; point your browser to the following address:
```
https://<Server IP or Server Name>/private/Downloads
```

####OpenVPN
To use your VPN you will need a VPN client compatible with [OpenVPN](http://openvpn.net/index.php?option=com_content&id=357), necessary files to configure your connection are in this link in your box:
```
https://<Server IP or Server Name>/rutorrent/CLIENT-NAME.zip and use it in any OpenVPN client.
```

## Tested servers (should work on any system support debian commands)
* Ubuntu Server 16.04 - 32 and 64 bit
* Ubuntu Server 16.10 - 32 and 64 bit

## Quota
Quota is disabled by default in your box. To enable and use it, you'll have to open Webmin, using the address you can find in one of the tables box above this. After you sucessfully logged on Webmin, enable it by clicking

System => Disk and Network Filesystems => /home => Use Quotas? => Select "Only User" => Save

Now you'll have to configure quota for each user, doing

System => Disk Quotas => /home => <username> => Configure the "Soft kilobyte limit" => Update

As soon as you save it, your seedbox will also update the available space to all your users.


## Support

There is no real support for this script, but nerds are talking a lot about it [HERE](http://www.torrent-invites.com/showthread.php?t=272859) and you may find solutions for your problems in that thread.


## License
Copyright (c) 2013 Notos (https://github.com/Notos/seedbox-from-scratch/) 

Modified by dannyti 2015 (https://github.com/dannyti/seedbox-from-scratch) 

Modified by thevisad 2017 (https://github.com/thevisad/seedbox-from-scratch) 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: 

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

--> Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
