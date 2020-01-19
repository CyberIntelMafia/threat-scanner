#!/bin/bash

source "$F2BTOOL_CONFIG"
srcfile="/var/log/fail2ban.log"

if  [ -f "${ds_results}" ];
then
	rm -v ${ds_results}
fi

# Extracts Current Date attacks
# JJJJ-MM-TT 123.123.123.123
# Returns 123.123.123.123
cat $srcfile | awk '{print $8}' | sort -u | grep -v [0-255]\.[0-255]\.[0-255]\.[0-255] | grep -v [a-z] >> ${ds_results}

# Returns the number of attacks found
attack_count="$(wc -l ${ds_results} | awk '{print $1}')"
printf "Found Attacks: ${attack_count}\n"
case $attack_count in
	0) printf "Nothing found\n";;
	*)
	[ ! -d "${scan_dir}/$(date '+%F')" ] && mkdir -v -p "${scan_dir}/$(date '+%F')"
	for _ipaddr in `cat ${ds_results}`
	do
		skip=1
		printf "Scanning: [ $_ipaddr ]\n"
		_destfile=${scan_dir}/$(date '+%F')/f2b-inv-$(echo "${_ipaddr}_$(date '+%F')" | sed 's/\.//g' | openssl sha | awk '{print $2}').xml
		if  [ ! -f "${_destfile}" ];
		then
			printf "\033[35mDestination File: \033[36m${_destfile}\033[0m\n"
			nmap -sV -sC -O -v ${_ipaddr} --stylesheet ${stylesheet} -oX ${_destfile}
			printf "\033[32mDone!\033[0m\n"
		else
			printf "\033[1;34m[Duplicate]\t\033[2;33m${_destfile}\033[0m\n"
			printf "\033[1;96mSkipping, results creation.\033[0m\n"
		fi
	done
	;;
esac

