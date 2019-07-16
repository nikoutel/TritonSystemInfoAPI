<?php
/**
 *
 * Class Service: Provides data for system services on Linux Systems
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


use App\System\ServiceInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Service implements ServiceInterface
{
    /**
     * Returns the status of requested service
     *
     * @param string $service
     * @return array
     */
    public function getStatus($service){
        $process = new Process(['bash', '../app/bin/serviceStatus.sh', $service]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);
        $return = array_map('trim', $return);
        return $return;
    }

    /**
     * Load data return only from overriding methods for
     * requested services
     *
     * @return array
     */
    public function getLoad() {
        return ['info' => 'N/A'];
    }

    /**
     * Info data return only from overriding methods for
     * requested services
     *
     * @return array
     */
    public function getInfo() {
        return ['info' => 'N/A'];
    }
}