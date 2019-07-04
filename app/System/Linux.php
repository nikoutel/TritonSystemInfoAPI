<?php
/**
 *
 * Class Linux: Linux implementation of the System Strategy
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

use App\System\Linux\CPU;

class Linux implements SystemInterface
{

    /**
     * @var CPU
     */
    private $cpu;

    /**
     * Linux constructor.
     * @param CPU $cpu
     */
    public function __construct(CPU $cpu) {
        $this->cpu = $cpu;
    }

    /**
     * @return CPU
     */
    public function getCPU() {
        return $this->cpu;
    }
}