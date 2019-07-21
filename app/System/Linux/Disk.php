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
                return ($value !== null && $value !== '');
            });
        }, $return);
    }

    /**
     * Returns disk usage
     *
     * @return mixed
     */
    public function getUsage() {
        $keys = ['major_num', 'minor_num', 'name',
            'read_io', 'read_merges', 'read_sectors', 'time_spend_reading',
            'write_io', 'write_merges', 'write_sectors', 'time_spend_writing',
            'io_in_progress', 'time_spend_on_io', 'time_in_queue',
            'discards_io', 'discards_merges', 'discards_sectors', 'time_spend_discarding',
            'avg_reads_ps', 'avg_read_size_kb', 'avg_num_read_mbs', 'per_merged_read_reqs',
            'avg_read_response_time',
            'avg_write_ps', 'avg_write_size_kb', 'avg_num_write_mbs', 'per_merged_write_reqs',
            'avg_write_response_time',
            'busy', 'avg_io_ps'
        ];
        $process = new Process(['bash', '../app/bin/diskUsage.sh']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);

        foreach ($return as $k => $a) {
            $return[$k] = $n = array_combine($keys, $a);
        }
        return $return;
    }
}