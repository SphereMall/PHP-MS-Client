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
 * Class Brand
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $urlCode
 * @property string $title
 * @property string $shortDescription
 * @property string $fullDescription
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeywords
 * @property string $image
 * @property int $visible
 * @property string $orderNumber
 * @property string $lastUpdate
 */
class Brand extends Entity
{
    #region [Properties]
    public $id;
    public $urlCode;
    public $title;
    public $shortDescription;
    public $fullDescription;
    public $seoTitle;
    public $seoDescription;
    public $seoKeywords;
    public $image;
    public $visible;
    public $orderNumber;
    public $lastUpdate;
    #endregion
}