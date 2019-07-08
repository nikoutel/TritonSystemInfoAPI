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
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace App\System;

use App\System\Linux\CPU;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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

    /**
     * Returns general system Information like OS and nodename
     *
     * @return array|mixed
     */
    public function getInfo() {
        $process = new Process(['bash', '../app/bin/systemInfo.sh']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);
        $return = array_map('trim', $return);
        return $return;
    }
}