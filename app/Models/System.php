<?php
/**
 *
 * Class System: System Model
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

use App\System\System as SysSystem;
use Jenssegers\Model\Model;

class System extends Model
{

    use ModelTrait;

    private $system;
    /**
     * CPU constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->system = app(SysSystem::class);
    }

    /**
     * Fill the models attributes with data provided by System::getData().
     *
     * @param string $getData
     */
    public function init($getData) {
        $this->fill($this->system->$getData());
    }
}