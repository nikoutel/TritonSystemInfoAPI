<?php
/**
 *
 * Interface ServiceInterface: Provides data for system services
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

namespace App\System;

interface ServiceInterface
{
    /**
     * Returns the status of requested service
     *
     * @param string $service
     * @return array
     */
    public function getStatus($service);

    /**
     * Returns the load of requested service
     * if applicable
     *
     * @return array
     */
    public function getLoad();

    /**
     * Returns the info of requested service
     * if applicable
     *
     * @return array
     */
    public function getInfo();

    /**
     * Returns configuration of requested service
     * if applicable
     *
     * @param $parameter
     * @return mixed
     */
    public function getConfig($parameter);
}