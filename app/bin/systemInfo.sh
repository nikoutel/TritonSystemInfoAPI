#!/usr/bin/env bash

# Outputs a query-string formatted string with general system information.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

flags=('kernel-name'
'nodename'
'kernel-release'
'kernel-version'
'machine'
'processor'
'hardware-platform'
'operating-system')
out=''
for i in "${flags[@]}"; do
    cmd="uname --${i}"
    res=$($cmd)
    out=${i}"="${res}"&"${out}
done
if [ -f /etc/os-release ]; then
    . /etc/os-release
    distro=$ID
    release=$VERSION_ID
    codename=$VERSION_CODENAME
elif type lsb_release >/dev/null 2>&1; then
    distro=$(lsb_release -si)
    release=$(lsb_release -sr)
    codename=$(lsb_release -sc)
fi
out=${out}"Distribution="${distro^}"&Version="${release}"&Codename="${codename}"&uptime-since="$(uptime -s)
echo ${out}
