#!/bin/bash

for f in /etc/seedbox-from-scratch/users/*.info; do
	f=${f##*/}
	printf ${f%.info}
done
