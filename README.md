## The Seedbox From Scratch Mod 2 Script

Donate by buying me a Beer : paypal address: visad@yahoo.com

Donate by buying me a Beer : ETH address: 0x3eA5719D684F8F0cb6b08a65dBd315AC53720D60

When I originally started playing with this script it was one of the few that actually setup an environment properly for multiple users. I learned what was needed to get it operational and I am now in the process of eliminating all aspects that are usercentric. The script should be designed to install into a machine and then have docker services that are geared specifically towards the needs of each user. This script has been heavily modified from the original, but you can upgrade from the original to this version with a little effort. A script may be created later to handle the upgrade process.

* A true multi-user enviroment built around core technologies on the server.
* Docker container services for all user service requirements.
* Linux Quota, to control how much space every user can use in your box.
* Central Web Management system to handle user install/removal/update functionality.


## Core Server Software

* Web interface for user service interaction
* Fail2ban - to avoid apache and ssh exploits. Fail2ban bans IPs that show malicious signs (disabled by default)
* Apache (SSL)
* OpenVPN 
* OS Specific PHP and PHP-FPM (FastCGI to increase performance)
* Linux Quota
* SSH Server (for SSH terminal and sFTP connections)
* vsftpd (Very Secure FTP Deamon)
* Webmin (use it to manage your users quota)

## Supported Docker Containers
* Docker Plex (https://github.com/timhaak/docker-plex)
* Docker MySQL https://github.com/linuxserver/docker-mysql (buggy atm)
* Docker Deluge https://github.com/linuxserver/docker-deluge
* Docker RuTorrent https://github.com/linuxserver/docker-rutorrent (buggy atm)
* Docker Ubooquity https://github.com/linuxserver/docker-ubooquity
* https://github.com/linuxserver/docker-letsencrypt
* Docker Rapidleech (HN Docker)
* Docker sabnzbd https://github.com/timhaak/docker-sabnzbd
* https://github.com/timhaak/docker-sickbeard
* https://github.com/timhaak/docker-couchpotato
* https://github.com/timhaak/docker-sickrage


Pending Removal
* ruTorrent 3.7 + official plugins
* rTorrent 0.8.9, 0.9.2, 0.9.3 or 0.9.6
* libTorrrent 0.13.3, 0.13.4 or 0.13.6
* IRSSI


## Tested servers (should work on any system support debian commands)
* Ubuntu Server 16.04 - 32 and 64 bit
* Ubuntu Server 16.10 - 32 and 64 bit


## Support
**** Note this is for the older version of the script, which this still leverages to some aspect. Be careful attempting any fixes from these forums ****
There is no real support for this script, but nerds are talking a lot about it [HERE](http://www.torrent-invites.com/showthread.php?t=272859) and you may find solutions for your problems in that thread.



## Changelog

Version 16.00.3 (Internal Revision)
  May 15 2017 12:34 GMT-5
   - Major clean up on primary OS install, central server should only contain the applications needed to actually run all docker containers.

   
Version 16.00.1 (Internal Revision)
  April 22 2017 12:34 GMT-5
   - Switched to cromigon/ubooquity since linuxserver/ubooquity wouldn't execute properly
   - Switched to downloading the git and compiling the docker containers rather then using the default image. This allows us to inject the proper user permission functionality into the docker to prevent issues with the user not being properly registered inside of the docker. This is outlined here https://denibertovic.com/posts/handling-permissions-with-docker-volumes/
   - Removed Rapisleech, Deluge and SABnxbd from the default installs. 
   

Version 16.00
  April 18 2017 1:57 GMT-5
   - Version bump to correspond to the supported version of Ubuntu
   - Corrected major issues with script downloading from multiple repositories that simply do not exist, are different from the download repository and other issues.
   - RTorrent 0.9.6 support
   - Upgrade SABnxbd to 2.0.0
   - Upgrade xmlrpc-c to 1.39.12
   - Upgrade webmin to 1.831
   - Upgrade jailkit to 2.19
   - Upgrade autodl-trackers to the latest version
   - Upgrade PLEX to a Docker container version to allow multiple plex users per server
   - Added libtorrent-0.13.6
   - Defaulted SABnzbd to off
   - Changed default SSH port to 22101
   - Defaulted FAIL2BAN to off
   - Moved to OS Specific Plowshare install
   - Updated VSFTP to version 3.0.3
   - Updated MediaInfo CLI to 0.7.94
   - Updated Rtorrent logoff to 1.3
   - Updated all rutorrent third party plugins to the latest version (filemanager, fileshare, fileupload, mediastream)
   - New installRTorrent script: move to RTorrent 0.9.2, 0.9.3 or 0.9.6
   - Deluge v1.3.5 multi-user installation script (it will install the last stable version): installDeluge

Version 2.1.9 (not stable yet)
  Dec 26 2012 17:37 GMT-3
   - RTorrent 0.9.3 support (optionally installed)
   - New installRTorrent script: move to RTorrent 0.9.3 or back to 0.9.2 at any time
   - Deluge v1.3.5 multi-user installation script (it will install the last stable version): installDeluge
   - Optionally install Deluge when you first install your seedbox-from-scratch box

Version 2.1.8 (stable)
   - Bug fix release

Version 2.1.4 (stable)
  Dec 11 2012 2:34 GMT-3
   - Debian 6 (Squeeze) Compatibile
   - Check if user root is running the script
   - vsftpd - FTP access with SSL (AUTH SSL - Explicit)
   - vsftpd downgraded on Ubuntu to 2.3.2 (oneiric)
   - iptables tweaked to make OpenVPN work as it should both on Ubuntu and Debian
   - SABnzbd is now being installed from sources and works better
   - New script: changeUserPassword <username> <password> <realm> --- example:  changeUserPassword notos 133t rutorrent
   - restartSeedbox now kill processes even if there are users attached on screens
   - Installs rar, unrar and zip separately from main installations to prevent script from breaking on bad sources from non-OVH providers

Version 2.1.2 (stable)
  Nov 16 2012 20:48 GMT-3
   - new upgradeSeedbox script (to download git files for a new version, it will not really upgrade it, at least for now :)
   - ruTorrent fileshare Plugin (http://forums.rutorrent.org/index.php?topic=705.0)
   - rapidleech (http://www.rapidleech.com/ - http://www.rapidleech.com/index.php?showtopic=2226|Go ** tutorial: http://www.seedm8.com/members/knowledgebase/24/Installing-Rapidleech-on-your-Seedbox.html

Version 2.1.1 (stable)
  Nov 12 2012 20:15
   - OpenVPN was not working as expected (fixed)
   - OpenVPN port now is configurable (at main install) and you can change it anytime before reinstalling: /etc/seedbox-from-scratch/openvpn.info

Version 2.1.0 (not stable yet)
  Nov 11 2012 20:15
   - sabnzbd: http://wiki.sabnzbd.org/install-ubuntu-repo
   - restartSeedbox script for each user
   - User info files in /etc/seedbox-from-scratch/users
   - Info about all users in https://hostname.tld/seedboxInfo.php
   - Password protected webserver Document Root (/var/www/)

Version 2.0.0 (stable)
  Oct 31 2012 23:59
   - chroot jail for users, using JailKit (http://olivier.sessink.nl/jailkit/)
   - Fail2ban for ssh and apache - it bans IPs that show the malicious signs -- too many password failures, seeking for exploits, etc.
   - OpenVPN (after install you can download your key from http://<IP address or host name of your box>/rutorrent/vpn.zip)
   - createSeedboxUser script now asks if you want your user jailed, to have SSH access and if it should be added to sudoers
   - Optionally install packages JailKit, Webmin, Fail2ban and OpenVPN
   - Choose between RTorrent 0.8.9 and 0.9.2 (and their respective libtorrent libraries)
   - Upgrade and downgrade RTorrent at any time
   - Full automated install, now you just have to download script and run it in your box:
       > wget -N https://raw.github.com/Notos/seedbox-from-scratch/v2.x.x/seedbox-from-scratch.sh
       > time bash ~/seedbox-from-scratch.sh
   - Due to a recent outage of Webmin site and SourceForge's svn repositories, some packages are now in git and will not be downloaded from those sites
   - Updated list of trackers in Autodl-irssi
   - vsftpd FTP Server (working in chroot jail)
   - New ruTorrent default theme: Oblivion

Version 1.30
  Oct 23 2012 04:54:29
   - Scripts now accept a full install without having to create variables and do anything else

Version 1.20
  Oct 19 2012 03:24 (by Notos)
   - Install OpenVPN - (BETA) Still not in the script, just an outside script
     Tested client: http://openvpn.net/index.php?option=com_content&id=357

Version 1.11
  Oct 18 2012 05:13 (by Notos)
   - Added scripts to downgrade and upgrade RTorrent

   - Added all supported plowshare sites into fileupload plugin: 115, 1fichier, 2shared, 4shared, bayfiles, bitshare, config, cramit, data_hu, dataport_cz,
     depositfiles, divshare, dl_free_fr, euroshare_eu, extabit, filebox, filemates, filepost, freakshare, go4up, hotfile, mediafire, megashares, mirrorcreator, multiupload, netload_in,
     oron, putlocker, rapidgator, rapidshare, ryushare, sendspace, shareonline_biz, turbobit, uploaded_net, uploadhero, uploading, uptobox, zalaa, zippyshare

Version 1.10
  06/10/2012 14:18 (by Notos)
   - Added Fileupload plugin

   - Added all supported plowshare sites into fileupload plugin: 115, 1fichier, 2shared, 4shared, bayfiles, bitshare, config, cramit, data_hu, dataport_cz,
     depositfiles, divshare, dl_free_fr, euroshare_eu, extabit, filebox, filemates, filepost, freakshare, go4up, hotfile, mediafire, megashares, mirrorcreator, multiupload, netload_in,
     oron, putlocker, rapidgator, rapidshare, ryushare, sendspace, shareonline_biz, turbobit, uploaded_net, uploadhero, uploading, uptobox, zalaa, zippyshare

Version 1.00
  30/09/2012 14:18 (by Notos)
   - Changing some file names and depoying version 1.00

Version 0.99b
  27/09/2012 19:39 (by Notos)
   - Quota for users
   - Download dir inside user home

Version 0.99a
  27/09/2012 19:39 (by Notos)
   - Quota for users
   - Download dir inside user home

Version 0.92a
  28/08/2012 19:39 (by Notos)
   - Also working on Debian now

Version 0.91a
  24/08/2012 19:39 (by Notos)
   - First multi-user version sent to public

Version 0.90a
  22/08/2012 19:39 (by Notos)
   - Working version for OVH Kimsufi 2G Server - Ubuntu Based

Version 0.89a
  17/08/2012 19:39 (by Notos)


## License
Copyright (c) 2013 Notos (https://github.com/Notos/seedbox-from-scratch/) 

Modified by dannyti 2015 (https://github.com/dannyti/seedbox-from-scratch) 

Modified by thevisad 2017 (https://github.com/thevisad/seedbox-from-scratch) 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: 

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

--> Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

