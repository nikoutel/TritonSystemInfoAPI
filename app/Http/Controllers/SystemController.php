<?php
/**
 *
 * Class SystemController: System Controller
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

namespace App\Http\Controllers;

use App\CPU;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * @param CPU $CPU
     * @return Response
     */
    public function cpuRoot(CPU $CPU) {
        $CPU->init('getRoot');
        return new Response($CPU);
    }

    /**
     * @param CPU $CPU
     * @return Response
     */
    public function cpuInfo(CPU $CPU) {
        $CPU->init('getInfo');
        return new Response($CPU);
    }

    /**
     * @param CPU $CPU
     * @return Response
     */
    public function cpuLoad(CPU $CPU) {
        $CPU->init('getLoad');
        return new Response($CPU);
    }

}

