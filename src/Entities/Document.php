<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

/**
 * Class Company
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $urlCode
 * @property Attribute[] $attributes
 */
class Document extends AutoCompleteEntity
{
    use InteractsWithAttributes;

    #region [Properties]
    public $functionalName;
    #endregion
}