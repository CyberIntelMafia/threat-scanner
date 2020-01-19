#!/bin/bash

option="${1}"
source "$F2BTOOL_CONFIG"

logdir="${app_dir}/logs"

create_logdir(){
	if [ ! -d "${logdir}" ];
	then
		mkdir -v -p ${logdir}
	fi
}

help_menu(){
	printf "\033[36mDaemonizer: F2B Tools\033[0m\n"
	printf "\033[1;35mRun Daemon\t\033[32m[ -r, -run, --run ]\033[0m\n"
	printf "\033[1;35mKill Daemon\t\033[32m[ -k, -kill, --kill ]\033[0m\n"
}

case $option in
	-r|-run|--run)
	create_logdir
	nohup ${app_dir}/threat_scanner.sh & >> ${logdir}/threat_scanner.log
	pgrep "threat_scanner"
	;;
	-k|-kill|--kill)
	if [ ! -z "$(pgrep 'threat_scanner' | tr -d [:alpha:])" ];
	then
		kill -9 $(pgrep "threat_scanner")
	else
		printf "No running daemon process for threat scanner was found\n"
	fi
	;;
	-h|-help|--help) help_menu;;
	*) printf "\033[35mError:\t\033[31mMissing or invalid parameter was given.\033[0m\n";;
esac
