<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:52
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;

/**
 * Class MatchFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 * @property string $field
 * @property string $value
 */
class MatchFilterParams extends FilterParams
{
    protected $field;
    protected $value;

    /**
     * MatchFilterParams constructor.
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return [$this->field => $this->value];
    }
}
