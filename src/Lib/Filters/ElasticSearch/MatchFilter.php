<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 15:01
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Exceptions\ConfigurationException;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;

/**
 * Class MatchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 * @property string $name
 */
class MatchFilter extends ElasticSearchFilterElement implements SearchInterface
{

    protected $name = 'match';

    /**
     * @return array
     * @throws ConfigurationException
     */
    public function getValues()
    {
        if (!isset($this->langCodes) || sizeof($this->langCodes) < 1) {
            foreach ($this->values as $key => $value) {
                $result[$this->getName()][$key] = $value;
            }

            return $result;
        }

        $result = [];
        foreach ($this->values as $key => $value) {
            foreach ($this->langCodes as $langCode) {
                $result[$this->getName()]["{$key}_{$langCode}"] = $value;
            }
        }

        return $result;
    }
}
