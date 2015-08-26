#!/bin/bash

# Automatic RDP session configurator

# set LANG so that dpkg etc. return the expected responses so the script is guaranteed to work under different locales
export LANG="C"

###########################################################
# Before doing anything else, check if we're running with #
# priveleges, because we need to be.                      #
###########################################################
id=`id -u`
if [ $id -ne 0 ]
	then
		clear
		echo "You tried running the ScaryGliders RDPsesconfig utility as a non-priveleged user. Please run as root."
		exit 1
fi

#################################################################
# Initialise variables and parse any command line switches here #
#################################################################

INTERACTIVE=1

Dist=`lsb_release -d -s` # What are we running on

backtitle="Scarygliders RDPsesconfig"
questiontitle="RDPsesconfig Question..."
title="RDPsesconfig"
DIALOG="dialog"

# Check for running on supported/tested Distros...
supported=0
while read i
do
	if [ "$Dist" = "$i" ]
	then
		supported=1
		break
	fi
done < SupportedDistros.txt


###############################################
# Text/dialog front-end function declarations #
###############################################

let "HEIGHT = $LINES - 3"
let "WIDTH = $COLUMNS - 8"

# Display a message box
info_window()
{
	dialog --backtitle "$backtitle" --title "$title" --msgbox "$dialogtext" 0 0
}

ask_question()
{
	dialog --backtitle "$backtitle" --title "$questiontitle" --yesno "$dialogtext" 0 0
	Answer=$?
}

apt_update_interactive()
{
  apt-get update | dialog --progressbox "Updating package databases..." 30 100
}




#############################################
# Common function declarations begin here...#
#############################################

install_package_interactive()
{
	debconf-apt-progress --dlwaypoint 50 -- apt-get -y install $PkgName
	sleep 1 # Prevent possible dpkg race condition (had that with Xubuntu 12.04 for some reason)
}

# Interrogates dpkg to find out the status of a given package name, and installs if needed...
check_package()
{
	DpkgStatus=`dpkg-query -s $PkgName 2>&1`

	case "$DpkgStatus" in
		*"is not installed and no info"*)
			PkgStatus=0
			# "Not installed."
			;;
		*"deinstall ok config-files"*)
			PkgStatus=1
			# "Deinstalled, config files are still on system."
			;;
		*"install ok installed"*)
			PkgStatus=2
			# "Installed."
			;;
	esac

  if [ "$PkgStatus" = "0" ] || [ $PkgStatus = "1" ] # Install or re-install package and give a relatively nice-ish message whilst doing so - Zenity is kind of limited...
	then
		install_package_interactive
	fi
}

# Check for necessary packages and install if necessary...
install_required_packages()
{
  for PkgName in ${RequiredPackages[@]}
  do
  	check_package
  done
}

# Reads all normal (non-system) accounts in from /etc/passwd, and presents them as a list
# If your system also has "machine accounts" (i.e. accounts for PC's to be added under a
# SAMBA domain controller - marked with a "$" at the end) these will be ignored.
# smbguest is also ignored.
select_local_user_accounts_to_config()
{
	if [ -e ./usernames.tmp ]
	then
	  rm ./usernames.tmp
	fi
	getent passwd>/tmp/passwd
	userlist=""
	usercount=0
	linecount=`cat /tmp/passwd | wc -l`
	processed=0
	percent=0
	title="Processing local users in /etc/passwd..."
	hit=""
	uidmin=`grep '^UID_MIN' /etc/login.defs`
	uidmin=${uidmin/#UID_MIN/}
(	while read line
	do 
    userno=`echo $line | cut -d":" -f3`
		if [ $userno -ge $uidmin ] && [ $userno -lt 65534 ]
		then
			username=`echo $line | cut -d":" -f1`
			if [[ $username != *$ && $username != *smbguest* ]]
			then
				realname=`echo $line | cut -d":" -f5 | cut -d"," -f1`
        		hit="\nAdded username $username to list."
				let "usercount += 1"
			  echo "$username:$realname">> ./usernames.tmp
			fi
		fi
			let "processed += 1"
			percent=$((${processed}*100/${linecount}))
			echo "Processed $processed of $linecount entries in /etc/passwd ...$hit"
			echo XXX
			echo $percent
	done </tmp/passwd ) | dialog --backtitle "$backtitle" --title "$title" "$@" --gauge "Processing..." 15 75 0
  
  allusers=""
  usercount=0
  while read line
  do
    username=$(echo $line | cut -d":" -f1)
    allusers="$allusers $username"
    realname=$(echo $line | cut -d":" -f2)
		if [ $usercount == 0 ]
		then
			userlist=("ALL USERS" "Select all users on this list" off "${username[@]}" "${realname[@]}" off )
		else
			userlist=("${userlist[@]}" "${username[@]}" "${realname[@]}" off )
		fi
		let "usercount += 1"
	done < ./usernames.tmp
   
	windowsize=(0 0 0)
	dialog_param=("--separate-output" "--backtitle" "$backtitle" "--checklist" "Select the user accounts you wish to configure..." "${windowsize[@]}" "${userlist[@]}")
	selectedusers=$(dialog "${dialog_param[@]}" 2>&1 >/dev/tty)
  echo allusers = $allusers

  if [ "$selectedusers" == "" ]
  then
    dialog --backtitle "$backtitle" --title "No Users Were Selected" --msgbox "\nYou did not select any users!\n\nQuitting the utility now.\n\nClick OK to exit.\n\n" 0 0
    exit
  fi
  
  if [ "$selectedusers" == "ALL USERS" ]
  then
    selectedusers=$allusers
  fi
  rm ./usernames.tmp
}


# creates a .xsession file for each selected local user account
# based on the selected desktop environment
create_xsession()
{
(		for username in $selectedusers
		do
			homedir=`grep "^$username:" /tmp/passwd | cut -d":" -f6`
			echo "Creating .xsession file for $username in $homedir with entry \"$session\".." 2>&1
			echo $session > $homedir/.xsession
			usergroup=`id -gn $username`
			chown $username:$usergroup $homedir/.xsession
			chmod u+x $homedir/.xsession
		done) | dialog --backtitle "$backtitle" --title "creating .xsession files..." --progressbox "Processing..." 12 80
		sleep 3
}

select_desktop()
{
	title="RDPsesconfig"
	backtitle="Scarygliders RDPsesconfig"
	windowsize=(0 0 0)
	dialog_param=("--backtitle" "$backtitle" "--radiolist" "$title" "${windowsize[@]}" "${desktoplist[@]}")
	desktop=$($DIALOG "${dialog_param[@]}" 2>&1 >/dev/tty)
}



# Configure a gnome environment


# configure a unity environment (2d)
config_for_mate_on_ubuntu()
{
    session="mate-session"
    selecttext="Select which user(s) to configure a MATE session for..."
    RequiredPackages=(mate-core mate-desktop-environment)
    
}


##########################################################
######## End of internal function declarations ###########
##########################################################

##############################################
######## Main routine starts here ############
##############################################

# Source the common functions...
DIALOG="dialog"

case "$supported" in
	"1")
		dialogtext="\nWelcome to the ScaryGliders RDPsesconfig script.\n\nThe detected distribution is : $Dist \non which this utility has been tested and supports.\n\nClick OK to continue...\n"
		info_window
		;;
	"0")
		dialogtext="\nWelcome to the ScaryGliders RDPsesconfig script.\n\nThe detected distribution is : $Dist .\n\nUnfortunately, no testing has been done for running this utility on this distribution.\n\nIf this is a Debian-based distro, you can try running it, but it might not work.\n\nIf the utility does work on this distribution, please let the author know!\n\nIf you wish to proceed, then click OK. Otherwise click Cancel to stop right here."
		info_window
		;;
esac

#create_desktop_dialog_list
select_desktop

case "$desktop" in
	"MATE")
        config_for_mate_on_ubuntu
	    ;;
esac

#install_required_packages # Check if packages for selected desktop are installed and install if not.	
select_local_user_accounts_to_config
create_xsession
rm /tmp/passwd

dialogtext="\nAll selected operations are complete!\n\nThe users you configured will be able to log in via RDP now and be presented with the desktop you configured for them.\n\nIf you wish for RDP users to be able to perform certain tasks like \"local\" users, please see the configuration files located at /usr/share/polkit-1/actions/ .\n\nSee http://scarygliders.net for details on PolicyKit.\n\nClick OK to exit the utility.\n\n\nThank you for using the Scarygliders RDPsesconfig!\n"
info_window
