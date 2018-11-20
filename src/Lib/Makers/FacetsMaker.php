<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/21/2017
 * Time: 5:26 PM
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\BrandsMapper;
use SphereMall\MS\Lib\Mappers\FacetAttributesMapper;
use SphereMall\MS\Lib\Mappers\FactorValuesMapper;
use SphereMall\MS\Lib\Mappers\FunctionalNamesMapper;
use SphereMall\MS\Lib\Mappers\Mapper;

/**
 * Class FacetsMaker
 *
 * @package SphereMall\MS\Lib\Makers
 */
class FacetsMaker extends ObjectMaker
{
    #region [Public methods]
    /**
     * @param Response $response
     *
     * @return array
     */
    public function makeSingle(Response $response)
    {
        if (!$response->getSuccess()) {
            return null;
        }

        $result = [];
        $data   = $response->getData();
        foreach ($data as $type => $items) {
            switch ($type) {
                case 'attributes':
                    $result[$type] = (new FacetAttributesMapper())->createObject($items);
                    break;
                case 'priceRange':
                    $result[$type] = $items;
                    break;
                case 'factorValues':
                    $mapper        = new FactorValuesMapper();
                    $result[$type] = $this->createList($mapper, $items);
                    break;
                case 'functionalNames' :
                    $mapper = new FunctionalNamesMapper();
                    $result[$type] = $this->createList($mapper, $items);
                    break;
                case 'brands' :
                    $mapper = new BrandsMapper();
                    $result[$type] = $this->createList($mapper, $items);
                    break;
            }
        }

        return $result;
    }
    #endregion

    #region [Private methods]
    /**
     * @param Mapper $mapper
     * @param array  $items
     *
     * @return array
     */
    private function createList(Mapper $mapper, array $items)
    {
        $result = [];
        foreach ($items as $item) {
            $result[] = $mapper->createObject($item);
        }

        return $result;
    }

    #endregion
}
