#!/bin/bash
export LANG="C"

id=`id -u`


#################################################################
# Initialise variables and parse any command line switches here #
#################################################################

INTERACTIVE=1
#Identify Distro
Dist=`lsb_release -d -s` 

backtitle="LXDE Desktop RDP Config"
questiontitle="Which Users..."
title="Configurator"
DIALOG="dialog"

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
  sudo apt-get update | dialog --progressbox "Updating package databases..." 30 100
}


# Reads all normal (non-system) accounts 
select_local_user_accounts_to_config()
{
	if [ -e ./usernames.tmp ]
	then
	  rm -f ./usernames.tmp
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
	dialog_param=("--separate-output" "--backtitle" "$backtitle" "--checklist" "Select the user accounts you wish to configure RDP on" "${windowsize[@]}" "${userlist[@]}")
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
			sudo echo "Creating .xsession file for $username in $homedir" 2>&1
			sudo echo "lxsession -s LXDE -e LXDE" > $homedir/.xsession
			usergroup=`id -gn $username`
			sudo chown $username:$usergroup $homedir/.xsession
			sudo chmod u+x $homedir/.xsession
		done) | dialog --backtitle "$backtitle" --title "creating .xsession files..." --progressbox "Processing..." 12 80
		sleep 3
}


##########################################################
######## End of internal function declarations ###########
##########################################################

##############################################
######## Main routine starts here ############
##############################################	
select_local_user_accounts_to_config
create_xsession
rm /tmp/passwd

dialogtext="\nAll selected operations are complete!\n\nThe users you configured will be able to log in via RDP now and be presented with the Mate desktop.\n\n\n\nClick OK to exit the utility.\n\n"
info_window
