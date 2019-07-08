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
}