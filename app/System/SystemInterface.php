<?php
/**
 *
 * Interface SystemInterface: Interface abstraction of the System Strategy
 *
 *
 * @package TritonSystemInfoAPI
 * @author Nikos Koutelidis nikoutel@gmail.com
 * @copyright 2019 Nikos Koutelidis
 * @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace App\System;

interface SystemInterface
{
    /**
     * @return CPUInterface
     */
    public function getCpu();

    /**
     * @return mixed
     */
    public function getInfo();

    /**
     * @return NetworkInterface
     */
    public function getNetwork();

    /**
     * @return MemoryInterface
     */
    public function getMemory();

    /**
     * @return DiskInterface
     */
    public function getDisk();

    /**
     * @return ServiceInterface
     */
    public function getService();
}