<?php
/**
 *
 * Class Php: Provides data for php on Linux Systems
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

namespace App\System\Linux\Software;


use App\System\Config;
use App\System\Linux\Software;
use Nikoutel\HelionConfig\HelionConfig;
use Nikoutel\HelionConfig\ConfigType\ConfigType;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class Php extends Software
{

    /**
     * Returns php configurations
     * @param array $parameter
     * @return array
     */
    public function getConfig($parameter) {
        $confPOSIX = preg_replace("/^[^a-zA-Z_]|[^a-zA-Z0-9]*/",'',$parameter['conf']);
        $path = env('PATH_'.strtoupper($confPOSIX));
        if (empty($path)) {
            $conf = $parameter['conf'];
            throw new \RuntimeException("No path for $conf found");
        }
        $configType=ConfigType::INI;
        $config = app(Config::class);
        $configArray = $config->getConfig($path, $configType);
        return $configArray;
    }

    /**
     * Returns formatted phpinfo
     *
     * @return array
     */
    public  function getPHPInfo() {
        $process = new Process(['php', '-r', 'phpinfo();']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $source = $process->getOutput();
        $helionConfig = app(HelionConfig::class);
        $options = array(
            'genericConf' => array(
                'equals' => "=>",
                'newline' => ','
            )
        );
        $configReader = $helionConfig->getConfigReader(ConfigType::CONF, $options); //@todo catch
        $config = $configReader->getConfig($source);
        return $config->asArrayFlat();
    }
}