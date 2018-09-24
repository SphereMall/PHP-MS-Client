<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

/**
 * Class ComplexFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 */
abstract class ComplexFilter extends BaseFilter
{
    protected $fields;

    /**
     * @param array $fields
     * @return ComplexFilter
     */
    public function fields(array $fields)
    {
        foreach ($fields as $field) {
            $this->fields[] = $field;
        }

        return $this;
    }

    /**
     * @param $body
     * @return array
     */
    public function setFilterFields($body): array
    {
        if (empty($this->fields)) {
            return $body;
        }

        if (!isset($body['_source'])) {
            $body['_source'] = $this->fields;
        }

        return $body;
    }
}
