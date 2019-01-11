<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 04.12.18
 * Time: 9:42
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticQueryInterface;

class QueryFactory
{
    /**
     * @param $name
     * @param $data
     *
     * @return ElasticQueryInterface|null
     */
    public static function createInstance($name, $data): ElasticQueryInterface
    {
        $className = __NAMESPACE__ . '\\' . lcfirst($name) . 'Filter';

        if (class_exists($className)) {
            $obj = new $className($data);

            if (is_a($obj, ElasticQueryInterface::class)) {
                return $obj;
            }
        }

        return null;
    }
}
