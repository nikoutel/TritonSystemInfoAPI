<?php
/**
 *
 * Class HAL: Methods implementing the 'Hypertext Application Language' Model
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

namespace App;


class HAL
{

    /**
     * @var array
     */
    private $endPoints;

    /**
     * @var string
     */
    private $linksKey = '_links';

    /**
     * HAL constructor.
     * Provides the available endpoints from the defined routes
     */
    public function __construct() {
        $routes = array_keys(app()->router->getRoutes());
        $endPoints = array_filter(array_map(function ($route) {
            return strncmp($route, "GET", 3) === 0 && strpos($route, '{route') === false ? substr($route, 3, strlen($route)) : null;
        }, $routes));
        $this->endPoints = $endPoints;
    }

    /**
     * Returns an array of HAL link elements to be included along the resources for $route
     *
     * @param $route
     * @return array
     */
    public function getHalLinks($route) {
        $linksArray = array();
        $prefix = env('API_PREFIX') ?? "";
        $routeWithoutPrefix = substr($route, strlen($prefix) + 1, strlen($route));
        list($routeCategory, $routeType, $routePoint) = array_pad(array_values(array_filter(explode('/', $routeWithoutPrefix))), 3, null);

        foreach ($this->endPoints as $endPoint) {
            $endPointWithoutPrefix = substr($endPoint, strlen($prefix) + 1, strlen($endPoint));
            list($endPointCategory, $endPointType, $endPointPoint) = array_pad(array_values(array_filter(explode('/', $endPointWithoutPrefix))), 3, null);

            if (!is_null($routeType) && $routeType == $endPointType) {
                $linksArray[$endPointWithoutPrefix . '/'] = array('href' => url($endPoint));
            } elseif (!is_null($routeCategory) && (is_null($routeType)) && (is_null($endPointPoint)) && $routeCategory == $endPointCategory) {
                $linksArray[$endPointWithoutPrefix . '/'] = array('href' => url($endPoint));
            } elseif (is_null($routeCategory) && (is_null($endPointType))) {
                $linksArray[$endPointWithoutPrefix . '/'] = array('href' => url($endPoint));
            }
        }
        $linksArray = array('self' => $linksArray[$routeWithoutPrefix . '/']) + $linksArray;
        unset($linksArray[$routeWithoutPrefix . '/']);
        return array($this->linksKey => $linksArray);
    }

}