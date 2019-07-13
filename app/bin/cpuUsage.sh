#!/usr/bin/env bash

# Outputs a query-string formatted string with CPU usage.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

logicalCPUs=`grep -c ^processor /proc/cpuinfo`

cpuUsageTotal=`awk '/cpu /{print 100*($2+$4)/($2+$4+$5)}' /proc/stat`
cpuUsage=`awk -v a="$(awk '/cpu /{print $2+$4,$2+$4+$5}' /proc/stat; sleep 0.2)" '/cpu /{split(a,b," "); print 100*($2+$4-b[1])/($2+$4+$5-b[2])}'  /proc/stat`
output='CPU-Total='${cpuUsageTotal}'&CPU='${cpuUsage}
for ((i = 0 ; i < $logicalCPUs ; i++)); do
    cpuUsageTotalX=$( awk -v pat="cpu${i}" ' index($0, pat) {print 100*($2+$4)/($2+$4+$5)}' /proc/stat )
    cpuUSAGEX=`awk -v pato="cpu${i}" -v a="$(awk -v pat="cpu${i}" 'index($0, pat) {print $2+$4,$2+$4+$5}' /proc/stat; sleep 0.2)" 'index($0, pato) {split(a,b," "); print 100*($2+$4-b[1])/($2+$4+$5-b[2])}'  /proc/stat`
    output=${output}"&CPU${i}-Total="${cpuUsageTotalX}"&CPU${i}="${cpuUSAGEX}
done
echo ${output}
