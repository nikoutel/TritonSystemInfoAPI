#!/usr/bin/env bash



memTotal=$(awk '/MemTotal/ {print $2}' /proc/meminfo)
memFree=$(awk '/MemFree/ {print $2}' /proc/meminfo)
memAvailable=$(awk '/MemAvailable/ {print $2}' /proc/meminfo)
buffers=$(awk '/Buffers/ {print $2}' /proc/meminfo)
cached=$(awk '/^Cached/ {print $2}' /proc/meminfo)
swapCached=$(awk '/SwapCached/ {print $2}' /proc/meminfo)
swapTotal=$(awk '/SwapTotal/ {print $2}' /proc/meminfo)
swapFree=$(awk '/SwapFree/ {print $2}' /proc/meminfo)
slab=$(awk '/Slab/ {print $2}' /proc/meminfo)
hardwareCorrupted=$(awk '/HardwareCorrupted/ {print $2}' /proc/meminfo)

memUsed=$(( $memTotal - $memFree - $buffers - $cached - $slab  ))
swapUsed=$(( $swapTotal - $swapFree ))

out='memory-total='${memTotal}'&memory-free='${memFree}'&memory-available='${memAvailable}'&memory-used='${memUsed}
out=${out}'&memory-buffers='${buffers}'&memory-cached='${cached}'&swap-total='${swapTotal}'&swap-free='${swapFree}
out=${out}'&swap-used='${swapUsed}'&swap-cached='${swapCached}'&memory-hardware-corrupted='${hardwareCorrupted}

echo ${out}