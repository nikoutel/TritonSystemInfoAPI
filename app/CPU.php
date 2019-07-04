<?php

namespace App;

use App\System\System;
use Jenssegers\Model\Model;

class CPU extends Model
{
    protected $casts = ['CPUs' => 'int', 'Cores' => 'int', 'Threads' => 'int'];

    private $systemCPU;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemCPU = $system->getCpu();
    }

    public function init($getData) {
        $this->fill($this->systemCPU->$getData());
    }

    public function setFlagsAttribute($value) {
        $this->attributes['Flags'] = explode(' ', $value);
    }
}