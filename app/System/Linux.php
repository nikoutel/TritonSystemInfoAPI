<?php


namespace App\System;

use App\System\Linux\CPU;

class Linux implements SystemInterface
{

    private $cpu;

    public function __construct(CPU $cpu) {
        $this->cpu = $cpu;
    }

    public function getCPU() {
        return $this->cpu;
    }
}