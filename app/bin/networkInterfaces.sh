#!/usr/bin/env bash

# Outputs a query-string formatted string with active network interfaces.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

interfaces=$(basename -a /sys/class/net/*)
out=''
for interface in ${interfaces} ;do
    out=${out}'interface[]='${interface}'&';
done
out=${out: : -1}
echo ${out}