<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 22.02.19
 * Time: 15:19
 */

namespace SphereMall\MS\Lib\Elastic\Queries;

use SphereMall\MS\Lib\Elastic\Interfaces\{ElasticQueryInterface, ElasticBodyElementInterface};
use SphereMall\MS\Lib\Filters\GeoDistanceUnits;

/**
 * Class DistanceFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic
 */
class DistanceQuery extends BasicQuery implements ElasticQueryInterface, ElasticBodyElementInterface
{
    private $field        = null;
    private $lat          = null;
    private $lon          = null;
    private $distance     = null;
    private $distanceUnit = null;

    /**
     * DistanceQuery constructor.
     *
     * @param string $field
     * @param array  $coordinates
     * @param        $distance
     * @param string $distanceUnit
     */
    public function __construct(string $field, array $coordinates, $distance, $distanceUnit = GeoDistanceUnits::KILOMETER)
    {
        $this->field        = $field;
        $this->lat          = $coordinates['lat'];
        $this->lon          = $coordinates['lon'];
        $this->distance     = $distance;
        $this->distanceUnit = $distanceUnit;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'geo_distance' => array_merge([
                'distance'   => $this->distance . $this->distanceUnit,
                $this->field => [
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                ],
            ], $this->additionalParams),
        ];
    }
}
