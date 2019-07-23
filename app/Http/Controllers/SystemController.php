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
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace App\Http\Controllers;

use App\Models\System;
use App\HAL;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    /**
     * @var HAL
     */
    protected $hal;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @param HAL $hal
     * @param Request $request
     */
    public function __construct(HAL $hal, Request $request) {
        $this->hal = $hal;
        $this->request = $request;
    }

    /**
     * Control method for the '[prefix]/' route
     *
     * @return Response
     */
    public function root() {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        return (new Response($links))->header('Content-Type', 'application/hal+json');

    }

    /**
     * Control method for the '[prefix]/system/info' route
     *
     * @param System $system
     * @return Response
     */
    public function systemInfo(System $system) {
        $system->init('getInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $system->setAttributeArray($links);
        return (new Response($system))->header('Content-Type', 'application/hal+json');

    }

    /**
     * Control method for the '[prefix]/system/' route
     *
     * @return Response
     */
    public function systemRoot() {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        return (new Response($links))->header('Content-Type', 'application/hal+json');

    }
}

