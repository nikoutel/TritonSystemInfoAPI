<?php
/**
 *
 * Trait ModelTrait: Extends Model
 *
 *
 * @package TritonSystemInfoAPI
 * @author Nikos Koutelidis nikoutel@gmail.com
 * @copyright 2019 Nikos Koutelidis
 * @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace App\Models;


trait ModelTrait
{
    /**
     * Set a given attribute on the model from an array instead of a key, value pair
     *
     * @param $array
     */
    public function setAttributeArray($array) {
        $value = reset($array);
        $key = key($array);
        parent::setAttribute($key, $value);
    }

}