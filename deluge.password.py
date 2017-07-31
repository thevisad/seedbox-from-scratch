#!/usr/bin/env python
# Hellish Tech
# No commercial usage without authorization


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
