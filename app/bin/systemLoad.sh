#!/usr/bin/env bash

# Outputs a query-string formatted string with system load average.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.


loadavg1=$(awk '{ print $1 }' /proc/loadavg)
loadavg5=$(awk '{ print $2 }' /proc/loadavg)
loadavg15=$(awk '{ print $3 }' /proc/loadavg)

echo "loadavg1="${loadavg1}"&loadavg5="${loadavg5}"&loadavg15="${loadavg15}