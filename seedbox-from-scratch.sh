#!/bin/bash
# Hellish Tech
# No commercial usage without authorization
# The Seedbox From Scratch Mos 2 Script
#   ---> https://github.com/thevisad/
#
#
#
#  git clone -b master https://github.com/thevisad/seedbox-from-scratch.git /etc/seedbox-from-scratch
#  sudo git stash; sudo git pull
#

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

SBFSCURRENTVERSION1=16.00
SBSINTERNALVERSION=0.31.0
OS1=$(lsb_release -si)

function getString
{
  local ISPASSWORD=$1
  local LABEL=$2
  local RETURN=$3
  local DEFAULT=$4
  local NEWVAR1=a
  local NEWVAR2=b
  local YESYES=YESyes
  local NONO=NOno
  local YESNO=$YESYES$NONO

  while [ ! $NEWVAR1 = $NEWVAR2 ] || [ -z "$NEWVAR1" ];
  do
    clear
    echo "#"
    echo "#"
    echo "# The Seedbox From Scratch Script"
    echo "#   ---> https://github.com/thevisad/"
    echo "# This is the Old scipt"
    echo "#"
    echo "#"
    echo

    if [ "$ISPASSWORD" == "YES" ]; then
      read -s -p "$DEFAULT" -p "$LABEL" NEWVAR1
    else
      read -e -i "$DEFAULT" -p "$LABEL" NEWVAR1
    fi
    if [ -z "$NEWVAR1" ]; then
      NEWVAR1=a
      continue
    fi

    if [ ! -z "$DEFAULT" ]; then
      if grep -q "$DEFAULT" <<< "$YESNO"; then
        if grep -q "$NEWVAR1" <<< "$YESNO"; then
          if grep -q "$NEWVAR1" <<< "$YESYES"; then
            NEWVAR1=YES
          else
            NEWVAR1=NO
          fi
        else
          NEWVAR1=a
        fi
      fi
    fi

    if [ "$NEWVAR1" == "$DEFAULT" ]; then
      NEWVAR2=$NEWVAR1
    else
      if [ "$ISPASSWORD" == "YES" ]; then
        echo
        read -s -p "Retype: " NEWVAR2
      else
        read -p "Retype: " NEWVAR2
      fi
      if [ -z "$NEWVAR2" ]; then
        NEWVAR2=b
        continue
      fi
    fi


    if [ ! -z "$DEFAULT" ]; then
      if grep -q "$DEFAULT" <<< "$YESNO"; then
        if grep -q "$NEWVAR2" <<< "$YESNO"; then
          if grep -q "$NEWVAR2" <<< "$YESYES"; then
            NEWVAR2=YES
          else
            NEWVAR2=NO
          fi
        else
          NEWVAR2=a
        fi
      fi
    fi
    echo "---> $NEWVAR2"

  done
  eval $RETURN=\$NEWVAR1
}
# 0.

export DEBIAN_FRONTEND=noninteractive

clear

# 1.

#localhost is ok this rtorrent/rutorrent installation
IPADDRESS1=`ifconfig | sed -n 's/.*inet addr:\([0-9.]\+\)\s.*/\1/p' | grep -v 127 | head -n 1`
CHROOTJAIL1=NO

#those passwords will be changed in the next steps
PASSWORD1=a
PASSWORD2=b

getString NO  "You need to create an user for your seedbox: " NEWUSER1
getString YES "Password for user $NEWUSER1: " PASSWORD1
getString NO  "IP address or hostname of your box: " IPADDRESS1 $IPADDRESS1
getString NO  "ssl pem certificate (make sure it is in the /opt/seedbox-from-scratch/ folder hit enter to use self signed): " SSLCERT NULL
getString NO  "ssl key file (make sure it is in the /opt/seedbox-from-scratch/ folder hit enter to use self signed): " SSLKEY NULL
getString NO  "SSH port: " NEWSSHPORT1 22101
getString NO  "vsftp port (usually 21): " NEWFTPPORT1 21201
getString NO  "OpenVPN port: " OPENVPNPORT1 31195
#getString NO  "Do you want to have some of your users in a chroot jail? " CHROOTJAIL1 YES
getString NO  "Install Webmin? " INSTALLWEBMIN1 YES
getString NO  "Install Fail2ban? " INSTALLFAIL2BAN1 NO
getString NO  "Install OpenVPN? " INSTALLOPENVPN1 NO

apt-get --yes update
apt-get --yes install whois sudo makepasswd git

rm -f -r /etc/seedbox-from-scratch
git clone -b v$SBFSCURRENTVERSION1 https://github.com/thevisad/seedbox-from-scratch.git /etc/seedbox-from-scratch
mkdir -p cd /etc/seedbox-from-scratch/source
mkdir -p cd /etc/seedbox-from-scratch/users

if [ ! -f /etc/seedbox-from-scratch/seedbox-from-scratch.sh ]; then
  clear
  echo Looks like somethig is wrong, this script was not able to download its whole git repository.
  set -e
  exit 1
fi

# 3.1

#show all commands
set -x verbose

# 4.
perl -pi -e "s/Port 22/Port $NEWSSHPORT1/g" /etc/ssh/sshd_config
perl -pi -e "s/PermitRootLogin yes/PermitRootLogin no/g" /etc/ssh/sshd_config
perl -pi -e "s/#Protocol 2/Protocol 2/g" /etc/ssh/sshd_config
perl -pi -e "s/X11Forwarding yes/X11Forwarding no/g" /etc/ssh/sshd_config

groupadd sshdusers
echo "" | tee -a /etc/ssh/sshd_config > /dev/null
echo "UseDNS no" | tee -a /etc/ssh/sshd_config > /dev/null
echo "AllowGroups sshdusers" >> /etc/ssh/sshd_config
mkdir -p /usr/share/terminfo/l/
cp /lib/terminfo/l/linux /usr/share/terminfo/l/

service ssh restart

# 6.
#remove cdrom from apt so it doesn't stop asking for it
perl -pi -e "s/deb cdrom/#deb cdrom/g" /etc/apt/sources.list

#add non-free sources to Debian Squeeze# those two spaces below are on purpose
perl -pi -e "s/squeeze main/squeeze  main contrib non-free/g" /etc/apt/sources.list
perl -pi -e "s/squeeze-updates main/squeeze-updates  main contrib non-free/g" /etc/apt/sources.list

# 7.
# update and upgrade packages

apt-get --yes update
apt-get --yes upgrade

# 8.
#install all needed packages

apt-get --yes install apache2 apache2-utils apt-utils autoconf build-essential ca-certificates comerr-dev curl cfv quota mktorrent dtach htop irssi libapache2-mod-php libcloog-ppl-dev libcppunit-dev libcurl3 libcurl4-openssl-dev libncurses5-dev libterm-readline-gnu-perl libsigc++-2.0-dev libperl-dev openvpn libssl-dev libtool libxml2-dev ncurses-base ncurses-term ntp openssl patch libc-ares-dev pkg-config php php-cli php-dev php-curl php-geoip php-mcrypt php-gd php-xmlrpc pkg-config python-scgi screen ssl-cert subversion texinfo unzip zlib1g-dev expect joe automake flex bison debhelper binutils-gold ffmpeg libarchive-zip-perl libnet-ssleay-perl libhtml-parser-perl libxml-libxml-perl libjson-perl libjson-xs-perl libxml-libxslt-perl libxml-libxml-perl libjson-rpc-perl libarchive-zip-perl tcpdump plowshare4 docker.io nscd handbrake-cli
if [ $? -gt 0 ]; then
  set +x verbose
  echo
  echo
  echo *** ERROR ***
  echo
  echo "Looks like something is wrong with apt-get install, aborting."
  echo
  echo
  echo
  set -e
  exit 1
fi
apt-get --yes install zip
apt-get --yes install python-software-properties

apt-get --yes install rar
if [ $? -gt 0 ]; then
  apt-get --yes install rar-free
fi

apt-get --yes install unrar
if [ $? -gt 0 ]; then
  apt-get --yes install unrar-free
fi

apt-get --yes install dnsutils

if [ "$CHROOTJAIL1" = "YES" ]; then
  cd /etc/seedbox-from-scratch/installs
  tar xvfz jailkit-2.19.tar.gz -C /etc/seedbox-from-scratch/source/
  cd source/jailkit-2.19
  ./debian/rules binary
  cd ..
  dpkg -i jailkit_2.19-1_*.deb
fi

# 8.1 additional packages for Ubuntu
# this is better to be apart from the others
apt-get --yes install php-fpm
apt-get --yes install php-xcache

#Check if its Debian an do a sysvinit by upstart replacement:

if [ "$OS1" = "Debian" ]; then
  echo 'Yes, do as I say!' | apt-get -y --force-yes install upstart
fi

# 8.3 Generate our lists of ports and RPC and create variables

#permanently adding scripts to PATH to all users and root
echo "PATH=$PATH:/etc/seedbox-from-scratch:/sbin" | tee -a /etc/profile > /dev/null
echo "export PATH" | tee -a /etc/profile > /dev/null
echo "PATH=$PATH:/etc/seedbox-from-scratch:/sbin" | tee -a /root/.bashrc > /dev/null
echo "export PATH" | tee -a /root/.bashrc > /dev/null

rm -f /etc/seedbox-from-scratch/ports.txt
for i in $(seq 51101 51999)
do
  echo "$i" | tee -a /etc/seedbox-from-scratch/ports.txt > /dev/null
done

rm -f /etc/seedbox-from-scratch/rpc.txt
for i in $(seq 2 1000)
do
  echo "RPC$i"  | tee -a /etc/seedbox-from-scratch/rpc.txt > /dev/null
done

# 8.4

if [ "$INSTALLWEBMIN1" = "YES" ]; then
  #if webmin isup, download key
  WEBMINDOWN=YES
  ping -c1 -w2 www.webmin.com > /dev/null
  if [ $? = 0 ] ; then
    wget -t 5 http://www.webmin.com/jcameron-key.asc
    apt-key add jcameron-key.asc
    if [ $? = 0 ] ; then
      WEBMINDOWN=NO
    fi
  fi

  if [ "$WEBMINDOWN"="NO" ] ; then
    #add webmin source
    echo "" | tee -a /etc/apt/sources.list > /dev/null
    echo "deb http://download.webmin.com/download/repository sarge contrib" | tee -a /etc/apt/sources.list > /dev/null
    cd /tmp
  fi

  if [ "$WEBMINDOWN" = "NO" ]; then
    apt-get --yes update
    apt-get --yes install webmin
  fi
fi

if [ "$INSTALLFAIL2BAN1" = "YES" ]; then
  apt-get --yes install fail2ban
  cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.conf.original
  cp /etc/seedbox-from-scratch/templates/etc.fail2ban.jail.conf.template /etc/fail2ban/jail.conf
  fail2ban-client reload
fi

# 9.
a2enmod ssl
a2enmod auth_digest
a2enmod reqtimeout
#a2enmod scgi ############### if we cant make python-scgi works

# 10.

#remove timeout if  there are any
perl -pi -e "s/^Timeout [0-9]*$//g" /etc/apache2/apache2.conf

echo "" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "#seedbox values" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "ServerSignature Off" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "ServerTokens Prod" | tee -a /etc/apache2/apache2.conf > /dev/null
echo "Timeout 30" | tee -a /etc/apache2/apache2.conf > /dev/null

service apache2 restart

echo "$IPADDRESS1" > /etc/seedbox-from-scratch/hostname.info

# 11.

export TEMPHOSTNAME1=tsfsSeedBox
export CERTPASS1=@@$TEMPHOSTNAME1.$NEWUSER1.ServerP7s$
export NEWUSER1
export IPADDRESS1

echo "$NEWUSER1" > /etc/seedbox-from-scratch/mainuser.info
echo "$CERTPASS1" > /etc/seedbox-from-scratch/certpass.info

bash /etc/seedbox-from-scratch/createOpenSSLCACertificate

mkdir -p /etc/ssl/private/
openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout /etc/ssl/private/vsftpd.pem -out /etc/ssl/private/vsftpd.pem -config /etc/seedbox-from-scratch/ssl/CA/caconfig.cnf
rm -rf /srv/ftp

if [ "$OS1" = "Debian" ]; then
  apt-get --yes install vsftpd
else
  apt-get --yes install libcap-dev libpam0g-dev libwrap0-dev
  if [ "uname -m" = "x86_64" ]; then
  dpkg -i /etc/seedbox-from-scratch/installs/vsftpd_3.0.3-3ubuntu2_amd64.deb
  else
  dpkg -i /etc/seedbox-from-scratch/installs/vsftpd_3.0.3-3ubuntu2_`uname -m`.deb
  fi  
fi

perl -pi -e "s/anonymous_enable\=YES/\#anonymous_enable\=YES/g" /etc/vsftpd.conf
perl -pi -e "s/connect_from_port_20\=YES/#connect_from_port_20\=YES/g" /etc/vsftpd.conf
echo "listen_port=$NEWFTPPORT1" | tee -a /etc/vsftpd.conf >> /dev/null
echo "listen=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "ssl_enable=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "allow_anon_ssl=NO" | tee -a /etc/vsftpd.conf >> /dev/null
echo "force_local_data_ssl=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "force_local_logins_ssl=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "ssl_tlsv1=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "ssl_sslv2=NO" | tee -a /etc/vsftpd.conf >> /dev/null
echo "ssl_sslv3=NO" | tee -a /etc/vsftpd.conf >> /dev/null
echo "require_ssl_reuse=NO" | tee -a /etc/vsftpd.conf >> /dev/null
echo "ssl_ciphers=HIGH" | tee -a /etc/vsftpd.conf >> /dev/null
echo "rsa_cert_file=/etc/ssl/private/vsftpd.pem" | tee -a /etc/vsftpd.conf >> /dev/null
echo "local_enable=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "write_enable=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "local_umask=022" | tee -a /etc/vsftpd.conf >> /dev/null
echo "chroot_local_user=YES" | tee -a /etc/vsftpd.conf >> /dev/null
echo "chroot_list_file=/etc/vsftpd.chroot_list" | tee -a /etc/vsftpd.conf >> /dev/null
mv /etc/init/vsftpd.conf.dpkg-new /etc/init/vsftpd.conf
systemctl restart vsftpd.service

# 13.
mv /etc/apache2/sites-available/default /etc/apache2/sites-available/default.ORI
rm -f /etc/apache2/sites-available/default

cp /etc/seedbox-from-scratch/templates/etc.apache2.default.template /etc/apache2/sites-available/default.conf
perl -pi -e "s/http\:\/\/.*\/rutorrent/http\:\/\/$IPADDRESS1\/rutorrent/g" /etc/apache2/sites-available/default.conf
perl -pi -e "s/<servername>/$IPADDRESS1/g" /etc/apache2/sites-available/default.conf
perl -pi -e "s/<username>/$NEWUSER1/g" /etc/apache2/sites-available/default.conf

echo "ServerName $IPADDRESS1" | tee -a /etc/apache2/apache2.conf > /dev/null


# 13.1 SSLCERT
if [ !"$SSLCERT" = "NULL" ]; then
	cp /opt/seedbox-from-scratch/$SSLCERT /etc/seedbox-from-scratch/ssl/$SSLCERT
	perl -pi -e "s/cacert.pem/$SSLCERT/g" /etc/apache2/sites-available/default.conf
fi  

if [ !"$SSLKEY" = "NULL" ]; then
	cp /opt/seedbox-from-scratch/$SSLKEY /etc/seedbox-from-scratch/ssl/$SSLKEY
	perl -pi -e "s/cakey.pem/$SSLKEY/g" /etc/apache2/sites-available/default.conf
else
	if [ !"$SSLCERT" = "NULL" ]; then
		perl -pi -e "s/SSLCertificateKeyFile/#SSLCertificateKeyFile/g" /etc/apache2/sites-available/default.conf
	fi
fi  
  
# 14.
a2ensite default.conf
a2dissite 000-default.conf
a2dissite default-ssl.conf
sudo a2enmod rewrite
apache service reload
apache service restart

#Removing XML-RPC from the install of the server. 
# 15.
#tar xvfz /etc/seedbox-from-scratch/installs/xmlrpc-c-1.39.12.tgz -C /etc/seedbox-from-scratch/source/
#cd /etc/seedbox-from-scratch/source/
# unzip ../xmlrpc-c-1.31.06.zip

# 16.

#ln -s /usr/include/curl/curl.h /usr/include/curl/types.h
#cd xmlrpc-c-1.39.12
#./configure --prefix=/usr --enable-libxml2-backend --disable-libwww-client --disable-wininet-client --disable-abyss-server --disable-cgi-server
#make
#make install

groupadd admin

echo "www-data ALL=(ALL) NOPASSWD: /usr/sbin/repquota" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /etc/seedbox-from-scratch/sfsDecryptTemporaryEncryptedText" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /etc/seedbox-from-scratch/sfsEncryptTemporaryEncryptedText" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /etc/seedbox-from-scratch/sfsGenerateRandomPasswordString" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /etc/seedbox-from-scratch/sfsRunningUserDockerInfo" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /usr/bin/docker" | tee -a /etc/sudoers > /dev/null
echo "www-data ALL=(ALL) NOPASSWD: /etc/seedbox-from-scratch/updatePlexUserDocker" | tee -a /etc/sudoers > /dev/null
cp /etc/seedbox-from-scratch/favicon.ico /var/www/


# 30.

cp /etc/jailkit/jk_init.ini /etc/jailkit/jk_init.ini.original
echo "" | tee -a /etc/jailkit/jk_init.ini >> /dev/null
bash /etc/seedbox-from-scratch/updatejkinit


ln -s /etc/seedbox-from-scratch/templates/seedboxInfo.php.template /var/www/seedboxInfo.php

# 32.6
# Handle the user file limits
echo "* soft nofile 4096" | tee -a /etc/security/limits.conf > /dev/null
echo "* hard nofile 65000" | tee -a /etc/security/limits.conf > /dev/null
echo "session required pam_limits.so" | tee -a /etc/pam.d/common-session > /dev/null

# 33.

bash /etc/seedbox-from-scratch/updateExecutables

#34.

echo $SBFSCURRENTVERSION1 > /etc/seedbox-from-scratch/version.info
echo $SBSINTERNALVERSION > /etc/seedbox-from-scratch/internalversion.info
echo $NEWFTPPORT1 > /etc/seedbox-from-scratch/ftp.info
echo $NEWSSHPORT1 > /etc/seedbox-from-scratch/ssh.info
echo $OPENVPNPORT1 > /etc/seedbox-from-scratch/openvpn.info

# 36.

wget -P /usr/share/ca-certificates/ --no-check-certificate https://certs.godaddy.com/repository/gd_intermediate.crt https://certs.godaddy.com/repository/gd_cross_intermediate.crt
update-ca-certificates
c_rehash

# 37

if [ "$INSTALLOPENVPN1" = "YES" ]; then
 sudo bash /etc/seedbox-from-scratch/ovpni
fi

# 38.

#first user will not be jailed
#  createSeedboxUser <username> <password> <user jailed?> <ssh access?> <?>
bash /etc/seedbox-from-scratch/createSeedboxUser $NEWUSER1 $PASSWORD1 YES YES YES NO


# 39 Insert Crontab task 
(crontab -l 2>/dev/null; echo "*/1 * * * * /etc/seedbox-from-scratch/cronTasks >/dev/null 2>&1") | crontab - 
(crontab -l 2>/dev/null; echo "* */1 * * * /etc/seedbox-from-scratch/cronUpdates >/dev/null 2>&1") | crontab - 

# 98: end of script

set +x verbose

clear

echo ""
echo "<<< The Seedbox From Scratch Script >>>"
echo ""
echo ""
echo "Looks like everything is set."
echo ""
echo "Remember that your SSH port is now ======> $NEWSSHPORT1"
echo ""
echo "System will reboot now, but don't close this window until you take note of the port number: $NEWSSHPORT1"
echo ""
echo ""

echo ""

# 99.

reboot

##################### LAST LINE ###########
