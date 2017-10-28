<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

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
    public $media;
    public $brand;
    public $functionalName;
    #endregion
}