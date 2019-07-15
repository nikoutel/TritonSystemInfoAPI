<?php
/**
 *
 * Class Network: Network Model
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

use App\System\NetworkInterface;
use App\System\System;
use Jenssegers\Model\Model;

class Network extends Model
{
    use ModelTrait;

    /**
     * @var NetworkInterface;
     */
    private $systemNetwork;

    /**
     * CPU constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemNetwork = $system->getNetwork();
    }

    /**
     * Fill the models attributes with data provided by System::getData().
     *
     * @param string $getData
     */
    public function init($getData) {
        $this->fill($this->systemNetwork->$getData());
    }

    /**
     * Casts network interface array values to float before calling parent method
     *
     * @param string $key
     * @param mixed $value
     * @return Model|void
     */
    public function setAttribute($key, $value)
    {
        if(is_array($value) && key_exists('upload', $value)){
            $value['upload'] = (float) $value['upload'];
        }
        if(is_array($value) && key_exists('download', $value)){
            $value['download'] = (float) $value['download'];
        }
        parent::setAttribute($key, $value);
    }
}