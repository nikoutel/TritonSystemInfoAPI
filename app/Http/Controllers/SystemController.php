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
use App\HAL;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemController extends Controller
{

    /**
     * @var HAL
     */
    private $hal;

    /**
     * @var Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param HAL $hal
     */
    public function __construct(HAL $hal, Request $request) {
        $this->hal = $hal;
        $this->request = $request;
    }

    /**
     * Control method for the '[prefix]/metrics/cpu/' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuRoot(CPU $CPU) {
        $CPU->init('getRoot');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/metrics/cpu/info' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuInfo(CPU $CPU) {
        $CPU->init('getInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/metrics/cpu/load' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuLoad(CPU $CPU) {
        $CPU->init('getLoad');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }
}

