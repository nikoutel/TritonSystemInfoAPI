#!/usr/bin/env bash

# Outputs a query-string formatted string with network interface usage.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

interface=${1}
waitTime=1

downStart=$(cat /sys/class/net/${interface}/statistics/rx_bytes)
upStart=$(cat /sys/class/net/${interface}/statistics/tx_bytes)
sleep ${waitTime}
downStop=$(cat /sys/class/net/${interface}/statistics/rx_bytes)
upStop=$(cat /sys/class/net/${interface}/statistics/tx_bytes)

down=$(( ( ( $downStop - $downStart ) / 1024 ) / ${waitTime} ))
up=$(( ( ( $upStop - $upStart ) / 1024 ) / ${waitTime} ))
echo 'upload='${up}'&download='${down}