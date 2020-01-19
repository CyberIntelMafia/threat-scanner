#!/bin/bash

_dest="/var/www/html/view"

display(){
	printf "\033[35m[INFO]:\t \033[32m${1}.\033[0m\n"
}

if [ -d "${_dest}/scans" ];
then
	rm -rfv "${_dest}/scans"
fi

if [ ! -f "${_dest}/css/nmap.xsl" ];
then
	display "copying, nmap.xsl"
	cp -a -v "stylesheet/nmap.xsl" "${_dest}/css/nmap.xsl"
else
	display "File '${_dest}/css/nmap.xsl' already exists"
fi

cp -a -v "stylesheet/bootstrap" "${_dest}/"

for _fd in $(find scans/* -type d)
do
	cp -a -v "scans/index.php" "${_fd}"
done

display "copying, scans to ${_dest}/"
cp -a -v "scans" "${_dest}/"
