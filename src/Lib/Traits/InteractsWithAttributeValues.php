<?php
/**
 * Created by PhpStorm.
 * User: RomanSydorchuk
 * Date: 3/29/2019
 * Time: 2:48 PM
 */

namespace SphereMall\MS\Lib\Traits;

/**
 * Trait InteractsWithAttributeValues
 * @package SphereMall\MS\Lib\Traits
 */
trait InteractsWithAttributeValues
{
    #region [Public methods]
    /**
     * @param string $property
     */
    public function sortAttributeValues(string $property = 'orderNumber')
    {
        if ($this->values) {
            usort($this->values, function ($a1, $a2) use ($property) {
                return $a1->$property > $a2->$property;
            });
        }
    }
    #endregion

}