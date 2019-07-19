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
use App\System\Linux\Disk;
use App\System\Linux\Memory;
use App\System\Linux\Network;
use App\System\Linux\Service;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Linux implements SystemInterface
{

    /**
     * @var CPU
     */
    private $cpu;

    /**
     * @var Network
     */
    private $network;

    /**
     * @var Memory
     */
    private $memory;

    /**
     * @var Service
     */
    private $service;

    /**
     * @var Disk
     */
    private $disk;

    /**
     * Linux constructor.
     * @param CPU $cpu
     * @param Network $network
     * @param Memory $memory
     * @param Service $service
     * @param Disk $disk
     */
    public function __construct(CPU $cpu, Network $network, Memory $memory, Service $service, Disk $disk) {
        $this->cpu = $cpu;
        $this->network = $network;
        $this->memory = $memory;
        $this->service = $service;
        $this->disk = $disk;
    }

    /**
     * @return CPU
     */
    public function getCPU() {
        return $this->cpu;
    }

    /**
     * @return Network
     */
    public function getNetwork() {
        return $this->network;
    }

    /**
     * @return Memory
     */
    public function getMemory() {
        return $this->memory;
    }
    /**
     * @return Disk
     */
    public function getDisk() {
        return $this->disk;
    }

    /**
     * Return the Service object.
     * If a child Service object for the requested service exists
     * return this instead
     *
     * @return Service
     */
    public function getService() {
        if (key_exists('services', app()->request->route()[2])) {
            $childService = 'App\System\Linux\Services\\' . ucfirst(app()->request->route()[2]['services']);
            if (class_exists($childService)) {
                return app($childService);
            }
        }
        return $this->service;
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