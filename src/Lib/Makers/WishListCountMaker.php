<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 24.10.2018
 * Time: 13:45
 */

namespace SphereMall\MS\Lib\Makers;


use SphereMall\MS\Lib\Http\Response;

class WishListCountMaker extends ObjectMaker
{

    #region [Protected methods]
    /**
     * @param Response $response
     *
     * @return array
     */
    protected function getResultFromResponse(Response $response)
    {
        $result = [];

        foreach ($response->getData() as $element) {
            $attributes = $this->getAttributes($element);
            $attributes['type'] = $element['type'];

            $result[] = $attributes;
        }

        return $result;
    }
}