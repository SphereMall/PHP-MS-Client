<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 16:53
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;
use SphereMall\MS\Lib\Helpers\ElasticSearchIndexHelper;

class EntitiesFilterBuilder implements ElasticFilterInterface
{
    private $entities = [];

    public function __construct(string ...$entities)
    {
        $this->entities = array_map(function ($item) {
            return ElasticSearchIndexHelper::getIndexByClass($item);
        }, $entities);
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'entities' => implode(',', $this->entities),
        ];
    }
}
