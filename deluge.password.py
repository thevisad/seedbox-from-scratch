#!/usr/bin/env python
## See Readme.md for License ###
#
# The Seedbox From Scratch Script
#   ---> https://github.com/thevisad/
#
#
#
#
# Deluge password generator
#
#   deluge.password.py <password> <salt>
#
#

import hashlib
import sys

password = sys.argv[1]
salt = sys.argv[2]

s = hashlib.sha1()
s.update(salt)
s.update(password)

print s.hexdigest()
