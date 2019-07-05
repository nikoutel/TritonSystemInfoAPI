<?php
/**
 *
 * Interface CPUInterface: Provides data for the CPU
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

interface CPUInterface
{
    /**
     * Returns the CPU model and the number of physical CPUs (sockets), CPU cores, and logical CPUs (threads).
     *
     * @return array
     */
    public function getRoot();

    /**
     * Returns information for the CPU.
     *
     * @return array
     */
    public function getInfo();

    /**
     * Returns CPU loads (current and total).
     *
     * @return array
     */
    public function getLoad();
}