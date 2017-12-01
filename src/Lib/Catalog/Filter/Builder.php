<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/30/2017
 * Time: 1:43 PM
 */

namespace SphereMall\MS\Lib\Catalog\Filter;

use SphereMall\MS\Lib\Filters\GridFilter;

/**
 * Class Builder
 * @package SphereMall\MS\Lib\Catalog\Filter
 * @property array $params
 */
class Builder
{
    #region [Properties]
    protected $params;
    #endregion

    #region [Constructor]
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }
    #endregion

    #region [Public methods]
    public function getFilter()
    {
        $elements = array_map(function ($item) {
            return $this->getElement($item);
        }, $this->params);

        return new GridFilter();
    }
    #endregion

    #region [Private methods]
    private function getElement($item)
    {
        return array_map(function ($element) {
            return [
                $element['type']['class'] => array_map(function ($el) {
                    return $el;
                }, $element['elements']['attributes']),
            ];
        }, $item);
    }
    #endregion
}