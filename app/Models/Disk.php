<?php
/**
 *
 * Class Disk: Disk Model
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


use App\System\DiskInterface;
use App\System\System;
use Jenssegers\Model\Model;


class Disk extends Model
{
    use ModelTrait;

    /**
     * @var DiskInterface;
     */
    private $systemDisk;

    /**
     * Disk constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $system = app(System::class);
        $this->systemDisk = $system->getDisk();
    }

    /**
     * Fill the models attributes with data provided by System::getData().
     *
     * @param string $getData
     */
    public function init($getData) {
        $this->fill($this->systemDisk->$getData());
    }
}