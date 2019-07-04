<?php

namespace App\System;

class System
{
    private $system;

    public function __construct(SystemInterface $system) {
        $this->system = $system;
    }

    public function getCpu() {
        return $this->system->getCpu();
    }
}