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
 * Class Company
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $urlCode
 * @property string $title
 * @property string $shortDescription
 */
class Document extends Entity
{
    #region [Properties]
    public $id;
    public $urlCode;
    public $title;
    public $shortDescription;
    #endregion
}