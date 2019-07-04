#!/usr/bin/env bash

# Outputs the CPU model and the number of physical CPUs (sockets), CPU cores, and logical CPUs (threads).
#
# By Mickaël Le Baillif [https://superuser.com/users/177298/micka%c3%abl-le-baillif]
# from [https://superuser.com/a/583067]
# used under CC BY-SA 4.0 [https://creativecommons.org/licenses/by-sa/4.0/]
# Adapted variables and output

cat /proc/cpuinfo | awk -v FS=':' ' /^physical id/ { if(cpu<$2)  { cpu=$2 } }  \
/^cpu cores/   { if(cores<$2){ cores=$2 } }  /^processor/   { if(threads<$2){ threads=$2 } }   /^model name/  { model=$2 } \
  END{ cpu=(cpu+1); threads=(threads+1); \
  print "CPUs="cpu"&Cores="cores"&Threads="threads"&Model="model}'
