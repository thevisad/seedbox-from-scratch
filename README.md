## The Seedbox From Scratch Script
Donate by buying me a Beer : paypal address: visad@yahoo.com
## [Wiki](https://github.com/thevisad/seedbox-from-scratch/wiki)
## Current version = 14.06

This script has the following features

* A multi-user enviroment, you'll have scripts to add and delete users.
* Linux Quota, to control how much space every user can use in your box.
* Individual User Login Info https://Server-IP/private/SBinfo.txt
* Individual User Https Downloads directory (https://Server-IP/private/Downloads)

## Installed software
* ruTorrent 3.7 + official plugins
* rTorrent 0.8.9, 0.9.2, 0.9.3 or 0.9.6
* Deluge 1.3.14
* libTorrrent 0.13.3, 0.13.4 or 0.13.6
* mktorrent
* Fail2ban - to avoid apache and ssh exploits. Fail2ban bans IPs that show malicious signs -- too many password failures, seeking for exploits, etc.
* Apache (SSL)
* OpenVPN - Fixed
* OS Specific PHP and PHP-FPM (FastCGI to increase performance)
* Linux Quota
* SSH Server (for SSH terminal and sFTP connections)
* vsftpd (Very Secure FTP Deamon) <-- Working 
* IRSSI
* Webmin (use it to manage your users quota)
* sabnzbd (http://sabnzbd.org)
* Rapidleech (http://www.rapidleech.com)
* SiCKRAGE
* Subsonic
* ZNC
* Docker Plex (https://github.com/timhaak/docker-plex)
* Loadavg - Access via http://SERVER-IP/loadavg

## Main ruTorrent plugins
autotools, cpuload, diskspace, erasedata, extratio, extsearch, feeds, filedrop, filemanager, geoip, history, logoff, mediainfo, mediastream, rss, scheduler, screenshots, theme, trafic and unpack

## Additional ruTorrent plugins
* Autodl-IRSSI (with an updated list of trackers)
* A modified version of Diskpace to support quota (by Notos)
* Filemanager (modified to handle rar, zip, unzip, tar and bzip)
* Fileupload
* Fileshare Plugin (http://forums.rutorrent.org/index.php?topic=705.0)
* MediaStream (to watch your videos right from your seedbox)
* Logoff
* Theme: Oblivion & Agent 46

## Before installation
You need to have a Fresh "blank" server installation.
After that access your box using a SSH client, like PuTTY.

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

## Supported and tested servers
* Ubuntu Server 12.10.0 - 64 bit (on VM environment)
* Ubuntu Server 12.04.x - 64 bit (on VM environment)
* Ubuntu Server 14.04.x - 32 bit (OVH's Kimsufi 2G and 16G - Precise)
* Ubuntu Server 14.04.x - 64 bit (OVH's Kimsufi 2G and 16G - Precise)
* Ubuntu Server 14.10 - 32 and 64 bit
* Ubuntu Server 15.04 - 32 and 64 bit
* Ubuntu Server 15.10 - 32 and 64 bit
* Ubuntu Server 16.04 - 32 and 64 bit
* Ubuntu Server 16.10 - 32 and 64 bit
* Debian 6.0.6 - 32 and 64 bit 
* Debian 6.0.6 - 32 and 64 bit
* Debian 7.0 - 32 and 64 bit
* Debian 8.X - 32 and 64 bit

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
