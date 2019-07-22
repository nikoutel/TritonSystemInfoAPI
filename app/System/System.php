<?php
/**
 *
 * Class System:  System Strategy
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

class System
{
    /**
     * @var SystemInterface
     */
    private $system;

    /**
     * System constructor.
     *
     * @param SystemInterface $system
     */
    public function __construct(SystemInterface $system) {
        $this->system = $system;
    }

    /**
     * @return CPUInterface
     */
    public function getCpu() {
        return $this->system->getCpu();
    }

    /**
     * @return NetworkInterface
     */
    public function getNetwork() {
        return $this->system->getNetwork();
    }

    /**
     * @return MemoryInterface
     */
    public function getMemory() {
        return $this->system->getMemory();
    }

    /**
     * @return DiskInterface
     */
    public function getDisk() {
        return $this->system->getDisk();
    }

    /**
     * @return ServiceInterface
     */
    public function getService() {
        return $this->system->getService();
    }

    /**
     * @param string $concrete
     * @return SoftwareInterface
     */
    public function getSoftware($concrete) {
        return $this->system->getSoftware($concrete);
    }

    /**
     * Returns general system Information like OS and nodename
     *
     * @return mixed
     */
    public function getInfo() {
        return $this->system->getInfo();
    }

}