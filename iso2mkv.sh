#!/bin/sh

# License: Beerware 2017
# Author: Xyberviri
# Purpose: to make it easier to rip .iso files into .mkv files.
# If you find this script useful you can buy me a beer here: https://www.paypal.me/xyberviri
# wget https://pastebin.com/raw/SRHihAED -O- | tr -d '\r' >iso2mkv.sh;chmod +x iso2mkv.sh

# Usage info
show_help() {
cat << EOF
Usage: ${0##*/} [-hv] [-s STARTING TITLE] [-e ENDING TITLE] [-o OUTFILE OFFSET] [-f OUTFILE] [FILE]...
    Export titles from FILE to OUTFILE, FILE should be a .iso format.

    -h          display this help and exit
    -f OUTFILE  name out output file, DEFAULTS to the input FILE.mkv
    -s #        starting title, DEFAULT 1
    -e #        ending title, DEFAULTs to last title
    -o #        offset the exported title to this, useful when dealing
                with multi dvd seasons. This option also forces OUTFILE##.mkv behaviour.
    -i          inspect the .iso and lists title index, lengths and total title counts.

./iso2mkv.sh -e 4 -f SomeShowSeason1E  dvd.iso
..exports titles 1 - 4 to files SomeShowSeason1E{01-04}.mkv

./iso2mkv.sh -s 5 -e 10 dvd.iso
..exports titles 5 - 10 to files  dvd{05-10}.mkv

./iso2mkv.sh -e 10 -o 11 dvd2.iso
..exports titles 1 - 10 to files  dvd2{11-20}.mkv

./iso2mkv.sh -e 1 dvd.iso
..exports titles 1 as dvd.mkv


This script requires handbrake, install with the following:
    add-apt-repository ppa:stebbins/handbrake-releases
    apt-get update
    apt-get install handbrake-cli

Customize the export on the very last line of the script
Handbrake CLI here:
https://handbrake.fr/docs/en/1.0.0/cli/cli-guide.html

EOF
}

# Initialize our own variables:
output_file=""
verbose=0
offset=0
title_start=1
title_end=0
inspect=0
autonumber=0

OPTIND=1
# Resetting OPTIND is necessary if getopts was used previously in the script.
# It is a good idea to make OPTIND local if you process options in a function.

while getopts hvif:o:s:e: opt; do
    case $opt in
        h)
            show_help
            exit 0
            ;;
        v)  verbose=$((verbose+1))
            ;;
        i)  inspect=$((inspect+1))
            ;;
        f)  output_file=$OPTARG
            ;;
        o)  offset=$OPTARG
            ((autonumber++))
            ;;
        s)  title_start=$OPTARG
            ;;
        e)  title_end=$OPTARG
            ;;
        *)
            show_help >&2
            exit 1
            ;;
    esac
done
shift "$((OPTIND-1))"   # Discard the options and sentinel --

#input file
FILE="$@"
if [ -f "$FILE" ]
then
   printf 'iso2mkv: <%s>\n' "$FILE"
else
   echo "File $FILE does not exist" >&2
   exit 0
fi

#output filename
if [ -z $output_file ]; then
    output_file="$(echo $FILE | sed 's=.*/==;s/.iso//I')"
fi

#count number of titles in iso
rawout=$(HandBrakeCLI --min-duration 0 -i $FILE -t 0 2>&1 >/dev/null)
count=$(echo $rawout | grep -Eao "\\+ title [0-9]+:" | wc -l)
title_list=$(echo $rawout | grep -Eao "\\+ duration: [0-9]+:[0-9]+:[0-9]+"| sed 's/+\sduration://g')

#inspect to spit out the title lengths so we know what titles we want to export.
if [ $inspect -gt 0 ]
then
 tIndex=1
 for title in $title_list; do
   printf 'Title: %2s %s\n' "$tIndex" "$title"
   ((tIndex++))
 done
 exit 0
fi

#bound title end to max count
if [ $title_end -lt 1 ] || [ $title_end -gt $count ]
then
   title_end=$count
fi

#bound title_start to title_end
if [ $title_start -gt $title_end ]
then
   title_start=$title_end
fi

#set offset to 1 if we haven't overridden it.
if [ $offset -lt 1 ]
then
   offset=$title_start
fi

#enable auto numbering if exporting more then 1 title
if [ $title_end -ne $title_start ]
then
  ((autonumber++))
fi

#set the file name
filename="${output_file}.mkv"

#loop from $title_start to $title_end
for i in $(seq $title_start $title_end)
do
    #override filename because we have more then one title, or -o was used.
    if [ $autonumber -gt 0 ]
    then
        filename="${output_file}$(printf "%02d" $offset).mkv"
        ((offset++))
    fi
    echo -e "\tExtracting title $i as '${filename}'\n"
    HandBrakeCLI -i "$FILE" -t $i --preset Normal --output "${filename}"
done