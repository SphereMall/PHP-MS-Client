<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:32
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;

/**
 * Class IndexFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 */
class IndexFilterParams extends FilterParams
{
    protected $entities;

    /**
     * IndexFilterParams constructor.
     * @param array $entities
     */
    public function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->entities;
    }
}
