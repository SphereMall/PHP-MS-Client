<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 14.11.2018
 * Time: 14:37
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticIndexer;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;

class EntityFilterParams extends FilterParams
{
    protected $entity;
    protected $filter = null;

    public function __construct(string $entity, $filter = null)
    {
        $this->entity = class_exists($entity) ? (new ClassReflectionHelper($entity))->getShortLowerCaseName() . 's' : $entity;

        $this->filter = $filter;
    }

    public function getParams()
    {
        if (is_array($this->filter)) {
            $filter = (string)(new Filter($this->filter));
        }

        if ($this->filter instanceof FilterSpecification) {
            $filter = (string)(new Filter($this->filter->asFilter()));
        }

        return [$this->entity => $filter ?? ''];
    }
}
