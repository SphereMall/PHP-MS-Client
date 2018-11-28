<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:45
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigElementInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigInterface;

class ConfigBuilder implements ElasticConfigInterface
{
    private $config = [];

    public function __construct(array $configs)
    {
        foreach ($configs as $configItem) {
            $this->setConfig($configItem);
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig(ElasticConfigElementInterface $config)
    {
        $this->config += $config->getElements();
    }
}
