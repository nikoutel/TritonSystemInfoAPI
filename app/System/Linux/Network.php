<?php
/**
 *
 * Class Network: Provides networking data on Linux systems
 *
 *
 * @package TritonSystemInfoAPI
 * @author Nikos Koutelidis nikoutel@gmail.com
 * @copyright 2019 Nikos Koutelidis
 * @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace App\System\Linux;


use App\System\NetworkInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Network implements NetworkInterface
{
    /**
     * Returns information for the networking interface.
     *
     * @return array
     */
    public function getInfo() {
        return ['info'];
    }

    /**
     * Returns networking interface loads.
     *
     * @return array
     */
    public function getLoad() {
        return ['load'];
    }
}