<?php
/**
 * Created by PhpStorm.
 * User: RomanSydorchuk
 * Date: 2/25/2019
 * Time: 2:41 PM
 */

namespace SphereMall\MS\Entities;

/**
 * Class PriceConfiguration
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $affectAttributes
 * @property string $code
 */
class PriceConfigurations extends Entity
{
    #region [Properties]
    public $id;
    public $affectAttributes;
    public $code;
    #endregion

}