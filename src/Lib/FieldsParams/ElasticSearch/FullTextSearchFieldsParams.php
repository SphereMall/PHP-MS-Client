<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 23.02.2018
 * Time: 15:30
 */

namespace SphereMall\MS\Lib\FieldsParams\ElasticSearch;

use SphereMall\MS\Lib\FieldsParams\FieldsParams;

/**
 * Class FullTextSearchFieldsParams
 * @package SphereMall\MS\Lib\FieldsParams\ElasticSearch
 */
class FullTextSearchFieldsParams extends FieldsParams
{
    /**
     * FullTextSearchFieldsParams constructor.
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        $result = [];

        foreach ($this->fields as $field) {
            $result[] = $field . '_*';
        }

        return $result;
    }
}
