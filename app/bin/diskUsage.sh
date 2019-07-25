#!/usr/bin/env bash

# Outputs a query-string formatted string with disk interface usage.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

source ../app/bin/calc.sh
out=''
waitTime=1
declare -A resultsRun1
while read -a run1; do
    resultsRun1["${run1[2]}"]="${run1[@]}"
done < /proc/diskstats

sleep ${waitTime}

while read -a run2; do
    for elem in ${run2[@]}
    do
        out=${out}${run2[2]}'[]='${elem}'&'
    done
    ## Calculate read stats
    run1_1=$(awk '{print $4}' <<<"${resultsRun1[${run2[2]}]}")
    run2_1=${run2[3]}
    run1_2=$(awk '{print $5}' <<<"${resultsRun1[${run2[2]}]}")
    run2_2=${run2[4]}
    run1_3=$(awk '{print $6}' <<<"${resultsRun1[${run2[2]}]}")
    run2_3=${run2[5]}
    run1_4=$(awk '{print $7}' <<<"${resultsRun1[${run2[2]}]}")
    run2_4=${run2[6]}

    delta_1=$((${run2_1} - ${run1_1}))
    delta_2=$((${run2_2} - ${run1_2}))
    delta_3=$((${run2_3} - ${run1_3}))
    delta_4=$((${run2_4} - ${run1_4}))

    rd_s=$(calc ${delta_1} / ${waitTime})
    out=${out}${run2[2]}'[]='${rd_s}'&'

    if [[ delta_1 -eq 0 ]]; then
        rd_avkb=0
    else
        rd_avkb=$(calc ${delta_3} / ${delta_1})
    fi
    out=${out}${run2[2]}'[]='${rd_avkb}'&'

    rd_mb_s=$(calc $((2 * ${delta_3})) / ${waitTime})
    out=${out}${run2[2]}'[]='${rd_mb_s}'&'


    if [[ $((${delta_1} + ${delta_2})) -eq 0 ]]; then
        rd_mrg=0
    else
        rd_mrg=$(calc $((100 * ${delta_1})) / $((${delta_1} + ${delta_2})))
    fi

    out=${out}${run2[2]}'[]='${rd_mrg}'&'
    if [[ $((${delta_1} + ${delta_2})) -eq 0 ]]; then
        rd_rt=0
    else
        rd_rt=$(calc ${delta_1} / $((${delta_1} + ${delta_2})))
    fi
    out=${out}${run2[2]}'[]='${rd_rt}'&'

    ## Calculate write stats
    run1_5=$(awk '{print $8}' <<<"${resultsRun1[${run2[2]}]}")
    run2_5=${run2[7]}
    run1_6=$(awk '{print $9}' <<<"${resultsRun1[${run2[2]}]}")
    run2_6=${run2[8]}
    run1_7=$(awk '{print $10}' <<<"${resultsRun1[${run2[2]}]}")
    run2_7=${run2[9]}
    run1_8=$(awk '{print $11}' <<<"${resultsRun1[${run2[2]}]}")
    run2_8=${run2[10]}

    delta_5=$((${run2_5} - ${run1_5}))
    delta_6=$((${run2_6} - ${run1_6}))
    delta_7=$((${run2_7} - ${run1_7}))
    delta_8=$((${run2_8} - ${run1_8}))


    wr_s=$(calc ${delta_5} / ${waitTime})
    out=${out}${run2[2]}'[]='${wr_s}'&'

    if [[ delta_5 -eq 0 ]]; then
        wr_avkb=0
    else
        wr_avkb=$(calc ${delta_7} / ${delta_5})
    fi
    out=${out}${run2[2]}'[]='${wr_avkb}'&'

    wr_mb_s=$(calc $((2 * ${delta_7})) / ${waitTime})
    out=${out}${run2[2]}'[]='${wr_mb_s}'&'


    if [[ $((${delta_5} + ${delta_6})) -eq 0 ]]; then
        wr_mrg=0
    else
        wr_mrg=$(calc $((100 * ${delta_5})) / $((${delta_5} + ${delta_6})))
    fi
    out=${out}${run2[2]}'[]='${wr_mrg}'&'

    if [[ $((${delta_5} + ${delta_6})) -eq 0 ]]; then
        wr_rt=0
    else
        wr_rt=$(calc ${delta_5} / $((${delta_5} + ${delta_6})))
    fi
    out=${out}${run2[2]}'[]='${wr_rt}'&'

    ## Calculate general stats
    run1_10=$(awk '{print $13}' <<<"${resultsRun1[${run2[2]}]}")
    run2_10=${run2[12]}
    delta_10=$((${run2_10} - ${run1_10}))

    busy=$(calc $((100 * ${delta_10})) / $((1000 * ${waitTime})))
    out=${out}${run2[2]}'[]='${busy}'&'

    ios_s=$((${rd_s} + ${wr_s}))
    out=${out}${run2[2]}'[]='${ios_s}'&'

done < /proc/diskstats
out=${out::-1}
echo ${out}