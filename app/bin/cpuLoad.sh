#!/usr/bin/env bash

logicalCPUs=`grep -c ^processor /proc/cpuinfo`

cpuLoadTotal=`awk '/cpu /{print 100*($2+$4)/($2+$4+$5)}' /proc/stat`
cpuLoad=`awk -v a="$(awk '/cpu /{print $2+$4,$2+$4+$5}' /proc/stat; sleep 0.2)" '/cpu /{split(a,b," "); print 100*($2+$4-b[1])/($2+$4+$5-b[2])}'  /proc/stat`
output='CPU-Total='${cpuLoadTotal}'&CPU='${cpuLoad}
for ((i = 0 ; i < $logicalCPUs ; i++)); do
    cpuLoadTotalX=$( awk -v pat="cpu${i}" ' index($0, pat) {print 100*($2+$4)/($2+$4+$5)}' /proc/stat )
    cpuLoadX=`awk -v pato="cpu${i}" -v a="$(awk -v pat="cpu${i}" 'index($0, pat) {print $2+$4,$2+$4+$5}' /proc/stat; sleep 0.2)" 'index($0, pato) {split(a,b," "); print 100*($2+$4-b[1])/($2+$4+$5-b[2])}'  /proc/stat`
    output=${output}"&CPU${i}-Total="${cpuLoadTotalX}"&CPU${i}="${cpuLoadX}
done
echo ${output}
