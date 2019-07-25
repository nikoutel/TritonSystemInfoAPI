<?php
/**
 *
 * Class Mysql: Provides data for the Mysql service
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

namespace App\System\Linux\Services;


use App\System\Config;
use App\System\Linux\Service;
use App\System\ServiceInterface;
use Nikoutel\HelionConfig\ConfigType\ConfigType;

class Mysql extends Service implements ServiceInterface
{
    /**
     * Returns Mysql server configurations
     *
     * @param $parameter
     * @return array|mixed
     */
    public function getConfig($parameter) {
        $confPOSIX = preg_replace("/^[^a-zA-Z_]|[^a-zA-Z0-9]*/",'',$parameter['conf']);
        $path = env('PATH_'.strtoupper($confPOSIX));
        if (empty($path)) {
            $conf = $parameter['conf'];
            throw new \RuntimeException("No path for $conf found");
        }
        $configType=ConfigType::CONF;
        $config = app(Config::class);
        $helionOptions = array(
            'genericConf' => array(
                'commentStart' => "#",
            )
        );
        $configArray = $config->getConfig($path, $configType, $helionOptions);
        return $configArray;
    }
}