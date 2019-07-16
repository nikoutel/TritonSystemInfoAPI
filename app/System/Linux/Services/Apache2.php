<?php
/**
 *
 * Class Apache2:
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

namespace App\System\Linux\Services;


use App\System\ServiceInterface;
use App\System\Linux\Service;

class Apache2 extends Service implements ServiceInterface
{
    public function getStatus2() {
        return ['active2'];
    }
}