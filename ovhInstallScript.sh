#!/bin/bash
# Hellish Tech
# No commercial usage without authorization
exec 1> >(logger -s -t $(basename $0)) 2>&1 


sudo apt-get install -y git 
cd /opt 
git clone https://github.com/thevisad/seedbox-from-scratch.git