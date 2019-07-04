#!/usr/bin/env bash

cat /proc/cpuinfo | awk -v FS=':' ' /^physical id/ { if(cpu<$2)  { cpu=$2 } }  \
/^cpu cores/   { if(cores<$2){ cores=$2 } }  /^processor/   { if(threads<$2){ threads=$2 } }   /^model name/  { model=$2 } \
  END{ cpu=(cpu+1); threads=(threads+1); \
  print "CPUs="cpu"&Cores="cores"&Threads="threads"&Model="model}'
