<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchQueryInterface;
use SphereMall\MS\Lib\Filters\GeoDistanceUnits;

/**
 * Class DealersGeoFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 */
class DealersGeoFilterParams extends FilterParams implements SearchQueryInterface
{
    protected $distance;
    protected $distance_unit;
    protected $lat;
    protected $lon;

    /**
     * DealersGeoFilterParams constructor.
     * @param int $distance
     * @param float $lat
     * @param float $lon
     * @param string $distance_unit
     */
    public function __construct(int $distance, float $lat, float $lon, string $distance_unit = GeoDistanceUnits::KILOMETER)
    {
        $this->distance      = $distance;
        $this->lat           = $lat;
        $this->lon           = $lon;
        $this->distance_unit = $distance_unit;
    }

    /**
     * @return array|mixed
     */
    public function getParams()
    {
        return [
            'distance'      => $this->distance . $this->distance_unit,
            'lat'           => $this->lat,
            'lon'           => $this->lon,
        ];
    }
}
