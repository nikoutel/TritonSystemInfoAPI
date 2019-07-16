<?php
/**
 *
 * Class Apache2: Provides data for the apache2 service
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


use App\System\ServiceInterface;
use App\System\Linux\Service;
use Nikoutel\HelionConfig\HelionConfig;
use Nikoutel\HelionConfig\ConfigType\ConfigType;

class Apache2 extends Service implements ServiceInterface
{
    /**
     * Return the Apache server load
     *
     * @return array
     * @throws \ReflectionException
     */
    public function getLoad() {
        $keepKeys = [
            'Load1', 'Load5', 'Load15', 'Total Accesses', 'Total kBytes', 'Total Duration',
            'CPUUser', 'CPUSystem', 'CPULoad', 'ReqPerSec', 'BytesPerSec', 'BytesPerReq',
            'DurationPerReq', 'BusyWorkers', 'IdleWorkers'
        ];
        $return = array_filter($this->getModStatus(), function ($key) use ($keepKeys) {
            return in_array($key, $keepKeys);
        }, ARRAY_FILTER_USE_KEY);
        $return = array_map(function ($item) {
            return (float)$item;
        }, $return);
        return $return;
    }

    /**
     * Returns Apache serve related info
     *
     * @return array
     * @throws \ReflectionException
     */
    public function getInfo() {
        $keepKeys = ['ServerVersion', 'ServerMPM', 'Server Built', 'CurrentTime', 'RestartTime', 'ServerUptime',];
        $return = array_filter($this->getModStatus(), function ($key) use ($keepKeys) {
            return in_array($key, $keepKeys);
        }, ARRAY_FILTER_USE_KEY);
        return $return;

    }


    /**
     * Returns information and current statistics
     * provided by the 'mod_status' apache module
     *
     * @return array
     * @throws \ReflectionException
     */
    private function getModStatus() {
        if (!in_array('mod_status', apache_get_modules())) {
            return ['error' => "'mod_status' 'not enabled"];
        }

        $helionConfig = new HelionConfig();
        $modStatusURI = 'http://localhost/server-status?auto';
        $options = array(
            'genericConf' => array(
                'equals' => ":",
            )
        );
        $configReader = $helionConfig->getConfigReader(ConfigType::CONF, $options); //@todo catch
        $config = $configReader->getConfig($modStatusURI);
        return $config->asArrayFlat();
    }

}