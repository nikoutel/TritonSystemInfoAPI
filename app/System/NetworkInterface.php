<?php
/**
 *
 * Interface NetworkInterface: Provides networking data
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

namespace App\System;


interface NetworkInterface
{
    /**
     * Returns information for the networking interface.
     *
     * @return array
     */
    public function getInfo();

    /**
     * Returns networking interface loads.
     *
     * @return array
     */
    public function getLoad();
}