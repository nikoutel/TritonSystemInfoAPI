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
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
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
     * @param string $secPoint
     * @return array
     */
    public function getHalLinks($route, $secPoint = '') {
        $linksArray = array();
        $prefix = env('API_PREFIX') ?? "";
        $routeWithoutPrefix = substr($route, strlen($prefix) + 1, strlen($route));
        list($routeCategory, $routeType, $routePoint) = array_pad(array_values(array_filter(explode('/', $routeWithoutPrefix))), 3, null);

        $routesWithParameter = preg_grep('/\{([^}]+)\}/', $this->endPoints);
        if (!empty($routesWithParameter)) {
            $this->addDynamicRoutesFromParameters($routesWithParameter);
        }
        if (in_array($secPoint, explode(',', env('TYPES_WITH_SEC_PARAMETER')))) {
            $routesWithParameter = preg_grep('/\{([^}]+)\}/', $this->endPoints);
            if (!empty($routesWithParameter)) {
                $this->addDynamicRoutesFromParameters($routesWithParameter, $secPoint);
            }
        } else {
            $this->endPoints = preg_grep('/\{([^}]+)\}/', $this->endPoints, PREG_GREP_INVERT);// Temp ugly fix removing second parameter
        }

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
        if (array_key_exists($routeWithoutPrefix . '/', $linksArray)) {
            $linksArray = array('self' => $linksArray[$routeWithoutPrefix . '/']) + $linksArray;
            unset($linksArray[$routeWithoutPrefix . '/']);
        }
        return array($this->linksKey => $linksArray);
    }

    /**
     * Add dynamically routes generated from the 'allowed' env variables
     * to the endpoints
     *
     * @param $routesWithParameter
     * @param string $secPoint
     */
    private function addDynamicRoutesFromParameters($routesWithParameter, $secPoint = '') {
        foreach ($routesWithParameter as $routeWithParameter) {
            preg_match('/\{([^}]+)\}/', $routeWithParameter, $param);
            $allowedArray = explode(',', env('ALLOWED_'.strtoupper($param[1]).strtoupper($secPoint)));
            if (!empty($allowedArray) && (!empty($allowedArray[0]))) {
                foreach ($allowedArray as $allowedValue) {
                    $this->endPoints[] = str_replace($param[0], $allowedValue, $routeWithParameter);
                }
            }
            $this->endPoints = array_diff($this->endPoints, array($routeWithParameter));
        }
    }
}