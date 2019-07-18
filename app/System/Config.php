<?php
/**
 *
 * Class Config: Wrapper class for HelionConfig
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


use Nikoutel\HelionConfig\ConfigType\ConfigType;
use Nikoutel\HelionConfig\HelionConfig;

class Config
{

    /**
     * @var HelionConfig
     */
    public $helionConfig;

    /**
     * Config constructor.
     * @param HelionConfig $helionConfig
     */
    public function __construct(HelionConfig $helionConfig) {
        $this->helionConfig = $helionConfig;
    }

    /**
     * @param $path
     * @param $configType
     * @param array $helionOptions
     * @return array|null
     * @throws \ReflectionException
     */
    public function getConfig($path, $configType, array $helionOptions=array()) {
        $config = null;
        if (is_dir($path)){
            $files = array_diff(scandir($path), array('.', '..'));
            $files = preg_filter('/^/', $path.'/', $files);
            foreach ($files as $file) {
                $config[] = $this->getConfFromFile($file, $configType, $helionOptions);
            }
        } elseif(is_file($path)) {
            $config = $this->getConfFromFile($path, $configType, $helionOptions);
        } else {
            throw new \RuntimeException("$path is unknown");
        }
        return $config;
    }

    /**
     * @param $file
     * @param $configType
     * @param array $helionOptions
     * @return array
     * @throws \ReflectionException
     */
    public function getConfFromFile($file, $configType, array $helionOptions=array()) {
        if (!file_exists($file)) {
            throw new \RuntimeException("$file does not exist");
        }
        $helionOptions = array_merge($helionOptions, array('rootName' => $file));
        $configSrc = file_get_contents($file);
        $configReader = $this->helionConfig->getConfigReader($configType, $helionOptions); //@todo catch
        $config = $configReader->getConfig($configSrc);
        return $config->asArray();
    }
}