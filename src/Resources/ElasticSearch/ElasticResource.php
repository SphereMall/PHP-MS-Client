<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 19.11.18
 * Time: 17:10
 */

namespace SphereMall\MS\Resources\ElasticSearch;

use SphereMall\MS\Lib\Filters\Elastic\Builders\ElasticFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Config\ConfigBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Params\ElasticFilterParams;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigInterface;
use SphereMall\MS\Lib\Makers\FacetsMaker;
use SphereMall\MS\Resources\Resource;

class ElasticResource extends Resource
{
    private $config = [];
    private $params;

    public function getURI()
    {
        return 'elasticsearch';
    }

    /**
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function facets()
    {
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', $this->config, 'filter', $params);

        return $this->make($response, false, new FacetsMaker());
    }

    public function setConfigs(ConfigBuilder $config)
    {
        $this->config = $config->getConfig();

        return $this;
    }

    public function setFilter(ElasticFilterBuilder $params)
    {
        $this->params = $params->getParams();

        return $this;
    }

    protected function getQueryParams(array $additionalParams = [])
    {
        return array_merge($this->params, $additionalParams);
    }
}
