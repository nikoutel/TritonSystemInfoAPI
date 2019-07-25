<?php
/**
 *
 * Class Software: Software model
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

namespace App\Models;


use App\System\SoftwareInterface;
use App\System\System;
use Jenssegers\Model\Model;

class Software extends Model
{
    use ModelTrait;
    /**
     * @var SoftwareInterface;
     */
    private $systemSoftware;

    /**
     * @var string
     */
    protected $concrete = '';
    /**
     * Disk constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemSoftware = $system->getSoftware($this->concrete);
    }

    /**
     * Fill the models attributes with data provided by System::getData().
     *
     * @param string $getData
     * @param array $parameter
     */
    public function init($getData, $parameter = []) {
        $this->fill($this->systemSoftware->$getData($parameter));
    }
}