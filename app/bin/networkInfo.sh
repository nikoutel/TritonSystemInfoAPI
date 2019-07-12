#!/usr/bin/env bash

# Outputs a query-string formatted string with general network information.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.


## Public IP
ipv4=$(dig @resolver1.opendns.com ANY myip.opendns.com +short -4)
ipv6=$(dig @resolver1.opendns.com ANY myip.opendns.com +short -6)
if [[ ! ${ipv6} =~ .*:.* ]]; then
  ipv6=''
fi
out='public-IPv4='${ipv4}'&public-IPv6='${ipv6}

## Private IP
interfaces=$(basename -a /sys/class/net/*)
for interface in ${interfaces} ;do
    ip=$(ip -f inet a show ${interface} | grep inet | awk '{ print $2}' | cut -d/ -f1)
    out=${out}'&IP['${interface}']='${ip}
done

## Hostname, domain, fully qualified domain name
out=${out}'&hostname='$(hostname)'&domain='$(hostname -d)'&FQDN='$(hostname -f)

## Gateway
out=${out}'&gateway='$(/sbin/route -n | awk '$4 == "UG" {print $2}')

## DNS
if ! [[ -x "$(command -v nmcli)" ]]; then
    dns=($(cat /etc/resolv.conf |grep -i '^nameserver'|cut -d ' ' -f2))
else
    dns=($(nmcli dev show | grep DNS | sed 's/\s\s*/\t/g' | cut -f 2))
fi
for i in ${dns[@]}; do
    out=${out}'&DNS[]='${i}
done

## Broadcast address
out=${out}'&broadcast='$(ip -o -f inet addr show | awk '/scope global/ {print $6}')

## Netmask
netmaskCIDR=$(ip -o -f inet addr show | awk '/scope global/ {print $4}')
CIDRsubnet=${netmaskCIDR#*/}
obits=$(( 0xffffffff ^ ((1 << (32 - $CIDRsubnet)) - 1) ))
netmask=$(( ($obits >> 24) & 0xff )).$(( ($obits >> 16) & 0xff )).$(( ($obits >> 8) & 0xff )).$(( $obits & 0xff ))
out=${out}'&netmask='${netmask}'&netmask-CIDR='${netmaskCIDR}

echo ${out}