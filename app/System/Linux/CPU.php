<?php

namespace App\System\Linux;

use App\System\CPUInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CPU implements CPUInterface
{

    public function getRoot() {
        $process = new Process(['bash', '../app/bin/cpuRoot.sh']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        parse_str($process->getOutput(), $return);
        $return = array_map('trim', $return);
        return $return;
    }

    public function getInfo() {
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

    public function getLoad() {
        $process = new Process(['bash', '../app/bin/cpuLoad.sh']);
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