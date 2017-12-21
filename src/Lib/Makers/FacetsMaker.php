<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/21/2017
 * Time: 5:26 PM
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\FacetAttributesMapper;
use SphereMall\MS\Lib\Mappers\Mapper;

class FacetsMaker extends ObjectMaker
{
    #region [Public methods]
    /**
     * @param Response $response
     * @return array
     */
    public function makeSingle(Response $response)
    {
        if (!$response->getSuccess()) {
            return null;
        }

        $result = [];
        $data = $response->getData();
        foreach ($data as $type => $items) {
            switch ($type) {
                case 'attributes':
                    $mapper = new FacetAttributesMapper();
                    $result['attributes'] = $mapper->createObject($items);
                    break;

                case 'priceRange':
                    $result['priceRange'] = $items;
                    break;
            }
        }

        return $result;
    }
    #endregion
}