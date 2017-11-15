<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class SMEntity
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $code
 * @property string $title
 * @property int $inRelationWithFactor
 * @property int $visible
 * @property string $table
 * @property string $displayField
 * @property string $where
 */
class SMEntity extends Entity
{
    #region [Properties]
    public $id;
    public $code;
    public $title;
    public $inRelationWithFactor;
    public $visible;
    public $table;
    public $displayField;
    public $where;
    #endregion
}