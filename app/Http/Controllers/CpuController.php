<?php
/**
 *
 * Class CpuController: CPU Controller
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

use App\Models\CPU;
use Illuminate\Http\Response;

class CpuController extends SystemController
{
    /**
     * Control method for the '[prefix]/system/cpu/' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuRoot(CPU $CPU) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/cpu/info' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuInfo(CPU $CPU) {
        $CPU->init('getBasicInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/cpu/extended-info' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuExtendedInfo(CPU $CPU) {
        $CPU->init('getExtendedInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/cpu/usage' route
     *
     * @param CPU $CPU
     * @return Response
     */
    public function cpuUsage(CPU $CPU) {
        $CPU->init('getUsage');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $CPU->setAttributeArray($links);
        return (new Response($CPU))->header('Content-Type', 'application/hal+json');
    }
}