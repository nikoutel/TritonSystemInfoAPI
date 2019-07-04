<?php
/**
 *
 * Class CPU: CPU model
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

namespace App;

use App\System\System;
use Jenssegers\Model\Model;

class CPU extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['CPUs' => 'int', 'Cores' => 'int', 'Threads' => 'int'];

    /**
     * @var CPUInterface
     */
    private $systemCPU;

    /**
     * CPU constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemCPU = $system->getCpu();
    }

    /**
     * Fill the models attributes with data provided by CPUInterface::getData().
     *
     * @param array $getData
     */
    public function init($getData) {
        $this->fill($this->systemCPU->$getData());
    }

    /**
     * Set the Flags attribute on the model.
     *
     * @param $value
     */
    public function setFlagsAttribute($value) {
        $this->attributes['Flags'] = explode(' ', $value);
    }
}