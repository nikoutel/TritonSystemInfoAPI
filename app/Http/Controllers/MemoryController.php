<?php
/**
 *
 * Class MemoryController: Memory Controller
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

use App\Models\Memory;
use Illuminate\Http\Response;

class MemoryController extends SystemController
{
    /**
     * Control method for the '[prefix]/system/memory/' route
     *
     * @param Memory $memory
     * @return Response
     */
    public function memoryRoot(Memory $memory) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $memory->setAttributeArray($links);
        return (new Response($memory))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/memory/usage' route
     *
     * @param Memory $memory
     * @return Response
     */
    public function memoryUsage(Memory $memory) {
        $memory->init('getUsage');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $memory->setAttributeArray($links);
        return (new Response($memory))->header('Content-Type', 'application/hal+json');
    }
}