<?php
/**
 *
 * Class NetworkController: Network Controller
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

use App\Models\Network;
use Illuminate\Http\Response;

class NetworkController extends SystemController
{
    /**
     * Control method for the '[prefix]/system/network/' route
     *
     * @param Network $network
     * @return Response
     */
    public function networkRoot(Network $network) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $network->setAttributeArray($links);
        return (new Response($network))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/network/usage' route
     *
     * @param Network $network
     * @return Response
     */
    public function networkUsage(Network $network) {
        $network->init('getUsage');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $network->setAttributeArray($links);
        return (new Response($network))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/system/network/info' route
     *
     * @param Network $network
     * @return Response
     */
    public function networkInfo(Network $network) {
        $network->init('getInfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $network->setAttributeArray($links);
        return (new Response($network))->header('Content-Type', 'application/hal+json');
    }
}