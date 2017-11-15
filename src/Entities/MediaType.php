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
 * Class MediaType
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $class
 * @property int $orderNumber
 */
class MediaType extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $description;
    public $class;
    public $orderNumber;
    #endregion
}