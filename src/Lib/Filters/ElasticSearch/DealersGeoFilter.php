<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 13:42
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;

/**
 * Class DealersGeoFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 */
class DealersGeoFilter extends ElasticSearchFilterElement implements SearchInterface
{
    protected $name = 'geo_distance';

    /**
     * @return array
     */
    public function getValues()
    {
        $result = [];
        if (isset($this->values['distance'])) {
            $result[$this->getName()]['distance'] = $this->values['distance'];
        }
        if (isset($this->values['distance_unit'])) {
            $result[$this->getName()]['distance_unit'] = $this->values['distance_unit'];
        }

        // ToDo: replace FIELD to needed field
        if (isset($this->values['lat'])) {
            $result[$this->getName()]['FIELD']['lat'] = $this->values['lat'];
        }
        if (isset($this->values['lon'])) {
            $result[$this->getName()]['FIELD']['lon'] = $this->values['lon'];
        }

        return $result;
    }
}
