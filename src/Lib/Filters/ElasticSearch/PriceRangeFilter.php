<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 14:45
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;


class PriceRangeFilter extends ElasticSearchFilterElement
{
    protected $name = 'range';

    public function getValues()
    {
        $result = [];
        if (isset($this->values[0])) {
            $result[$this->getName()]['price']['gte'] = $this->values[0];
        }
        if (isset($this->values[1])) {
            $result[$this->getName()]['price']['lte'] = $this->values[1];
        }

        return $result;
    }
}
