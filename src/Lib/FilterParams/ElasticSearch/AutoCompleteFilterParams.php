<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:52
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchQueryInterface;

/**
 * Class MatchFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 * @property string $field
 * @property string $value
 */
class AutoCompleteFilterParams extends MatchFilterParams implements SearchQueryInterface
{
    /**
     * MatchFilterParams constructor.
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        parent::__construct($field, $value);
    }
}
