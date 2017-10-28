<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Collection;

/**
 * Class Product
 * @package SphereMall\MS\Entities
 * @property Collection $attributes
 * @property Brand $brand
 * @property FunctionalName $functionalName
 * @property Collection $media
 * @property Media $mainMedia
 */
class Product extends Entity
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
    public $visible;
    public $purchasePrice;
    public $price;
    public $oldPrice;
    public $importedId;
    public $variantsCompound;

    public $attributes;
    public $brand;
    public $functionalName;

    public $media;
    public $mainMedia;
    #endregion
}