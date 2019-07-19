<?php
/**
 *
 * Class Disk: Provides disk data on Linux systems
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


use App\System\DiskInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Disk implements DiskInterface
{

    /**
     * Returns disk information
     *
     * @return array
     */
    public function getInfo() {
        $process = new Process(['lsblk', '-J', '-l', '-o', 'NAME,LABEL,PARTLABEL,VENDOR,PATH,MOUNTPOINT,TYPE,FSTYPE,SIZE,FSSIZE,FSAVAIL,FSUSED,FSUSE%,HOTPLUG,RM']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $processOutput = json_decode($process->getOutput(), true);
        $return = $processOutput['blockdevices'];

        foreach ($return as $key => $value) {
            $return[$value['name']] = $value;
            unset($return[$key]);
        }
        return array_map(function ($value) {
            return array_filter($value, function ($value) {
                return ($value !== null  && $value !== '');
            });
        }, $return);
    }

    public function getUsage() {
        return ['usage'];
    }
}