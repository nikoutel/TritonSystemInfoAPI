<?php
/**
 *
 * Class Service: Service model
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

use App\System\ServiceInterface;
use App\System\System;
use Jenssegers\Model\Model;

class Service extends Model
{
    use ModelTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['enabled' => 'boolean', 'active' => 'boolean', 'failed' => 'boolean'];

    /**
     * @var ServiceInterface
     */
    private $systemService;

    /**
     * Service constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemService = $system->getService();
    }


    /**
     * Fill the models attributes with data provided by ServiceInterface::getData().
     *
     * @param string $getData
     * @param $parameter
     */
    public function init($getData, $parameter) {
        $this->fill($this->systemService->$getData($parameter));
    }
}