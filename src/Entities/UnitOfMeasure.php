<?php
/**
 * Created by PhpStorm.
 * User: [Viktor Matushevskyi](mailto:v.matushevskyi@spheremall.com)
 * Date: 17.04.2018
 * Time: 14:39
 */

namespace SphereMall\MS\Entities;

/**
 * Class Brand
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $code
 * @property int $visible
 * @property string $group
 * @property int $coefficient
 */

class UnitOfMeasure extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $code;
    public $visible;
    public $group;
    public $coefficient;
    #endregion
}