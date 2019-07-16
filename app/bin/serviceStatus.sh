#!/usr/bin/env bash

# Outputs a query-string formatted string with service status data.
#
# @package TritonSystemInfoAPI
# @author Nikos Koutelidis nikoutel@gmail.com
# @copyright 2019 Nikos Koutelidis
# @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
# @link https://github.com/nikoutel/TritonSystemInfoAPI

# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at https://mozilla.org/MPL/2.0/.

if [[ -z "$1" ]]; then exit 1; fi
service=${1}

systemctl status ${service} > /dev/null 2>&1
returnCode=$?
if [[ ${returnCode} == '4'  ]]; then status='service unknown'
elif [[ ${returnCode} == '3' ]]; then status='inactive'
else status='active'
fi
out="status="${status}

! systemctl is-enabled ${service}  > /dev/null 2>&1
out=${out}"&enabled="$?

! systemctl is-active ${service} > /dev/null 2>&1
out=${out}"&active="$?

! systemctl is-failed ${service}  > /dev/null 2>&1
out=${out}"&failed="$?

echo ${out}