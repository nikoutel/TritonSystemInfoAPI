<?php
/**
 *
 * Class CPU: Provides data for the CPU on Linux systems
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

namespace App\System\Linux;

use App\System\CPUInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CPU implements CPUInterface
{

    /**
     * Returns the CPU model and the number of physical CPUs (sockets), CPU cores, and logical CPUs (threads).
     *
     * @return array
     */
    public function getBasicInfo() {
        $process = new Process(['bash', '../app/bin/cpuInfo.sh']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);
        $return = array_map('trim', $return);
        return $return;
    }

    /**
     * Returns information for the CPU.
     *
     * @return array
     */
    public function getExtendedInfo() {
        $process = new Process(['lscpu']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $a = $process->getOutput();
        $array = preg_split('/$\R?^/m', $a);
        $return = array();
        array_walk($array, function ($val, $key) use (&$return) {
            $line = explode(':', $val);
            $return[$line[0]] = trim($line[1]);
        });
        return $return;
    }

    /**
     * Returns CPU usage (current and total).
     *
     * @return array
     */
    public function getUsage() {
        $process = new Process(['bash', '../app/bin/cpuUsage.sh']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);
        $return = array_map(function ($item) {
            return (int)trim($item);
        }, $return);
        return $return;
    }
}