<?php
/**
 *
 * Class DiskController: Disk Controller
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

use App\Models\Disk;
use Illuminate\Http\Response;

class DiskController extends SystemController
{
    /**
     * Control method for the '[prefix]/system/disk/' route
     *
     * @param Disk $disk
     * @return Response
     */
    public function diskRoot(Disk $disk) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $disk->setAttributeArray($links);
        return (new Response($disk))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/disk/info' route
     *
     * @param Disk $disk
     * @return Response
     */

    public function diskInfo(Disk $disk) {
        $disk->init('getInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $disk->setAttributeArray($links);
        return (new Response($disk))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/disk/usage' route
     *
     * @param Disk $disk
     * @return Response
     */
    public function diskUsage(Disk $disk) {
        $disk->init('getUsage');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $disk->setAttributeArray($links);
        return (new Response($disk))->header('Content-Type', 'application/hal+json');
    }
}