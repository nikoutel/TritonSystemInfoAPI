<?php
/**
 *
 * Class SoftwareController: Software Controller
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


use App\Models\Software;
use App\Models\Php;
use Illuminate\Http\Response;

class SoftwareController extends SystemController
{
    /**
     * Control method for the '[prefix]/software' route
     *
     * @param Software $software
     * @return Response
     */
    public function softwareRoot(Software $software) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $software->setAttributeArray($links);
        return (new Response($software))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/software/php' route
     *
     * @param Php $software
     * @return Response
     */
    public function phpRoot(Php $software) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $software->setAttributeArray($links);
        return (new Response($software))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/software/php/phpinfo' route
     *
     * @param Php $software
     * @return Response
     */
    public function phpinfo(Php $software) {
        $software->init('getPhpinfo');
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $software->setAttributeArray($links);
        return (new Response($software))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/software/php/config' route
     *
     * @param Php $software
     * @return Response
     */
    public function phpConfigRoot(Php $software) {
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $software->setAttributeArray($links);
        return (new Response($software))->header('Content-Type', 'application/hal+json');
    }

    /**
     * Control method for the '[prefix]/software/php/config/{conf}' route
     *
     * @param Php $software
     * @param string $conf
     * @return Response
     */
    public function phpConfig(Php $software, $conf) {
        $parameter['conf'] = $conf;
        $software->init('getConfig', $parameter);
        $links = $this->hal->getHalLinks($this->request->getPathInfo());
        $software->setAttributeArray($links);
        return (new Response($software))->header('Content-Type', 'application/hal+json');
    }
}