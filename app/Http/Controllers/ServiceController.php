<?php
/**
 *
 * Class ServiceController: Service Controller
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

use App\Models\Service;
use Illuminate\Http\Response;

class ServiceController extends SystemController
{
    /**
     * Control method for the '[prefix]/services' route
     *
     * @param Service $service
     * @return Response
     */
    public function servicesRoot(Service $service) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/services/{services}/status' route
     *
     * @param Service $service
     * @param $services
     * @return Response
     */
    public function servicesStatus(Service $service, $services) {
        $parameter['services'] = $services;
        $service->init('getStatus', $parameter);
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/services/{services}/load' route
     *
     * @param Service $service
     * @param $services
     * @return Response
     */
    public function servicesLoad(Service $service, $services) {
        $parameter['services'] = $services;
        $service->init('getLoad', $parameter);
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/services/{services}/info' route
     *
     * @param Service $service
     * @param $services
     * @return Response
     */
    public function servicesInfo(Service $service, $services) {
        $parameter['services'] = $services;
        $service->init('getInfo', $parameter);
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/services/{services}/config' route
     *
     * @param Service $service
     * @param string $services
     * @return Response
     */
    public function servicesConfigRoot(Service $service, $services) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo(), $services);
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/services/{services}/config/{conf}' route
     *
     * @param Service $service
     * @param string $services
     * @param string $conf
     * @return Response
     */
    public function servicesConfig(Service $service, $services, $conf = '') {
        $parameter['services'] = $services;
        $parameter['conf'] = $conf;
        $service->init('getConfig', $parameter);
        $links = $this->hal->getHalLinks($this->request->getPathInfo(), $services);
        $service->setAttributeArray($links);
        return (new Response($service))->header('Content-Type', 'application/hal+json');
    }
}