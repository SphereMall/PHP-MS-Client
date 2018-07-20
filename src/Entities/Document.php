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
 * Class Document
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $urlCode
 * @property string $title
 * @property Attribute[] $attributes
 * @property FunctionalName $functionalName
 * @property Media[] $media
 * @property Media $mainMedia
 */
class Document extends AutoCompleteEntity
{
    use InteractsWithAttributes;

    #region [Properties]
    public $functionalName;
    #endregion
}