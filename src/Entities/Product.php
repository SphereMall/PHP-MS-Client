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
    protected $id;
    protected $urlCode;
    protected $title;
    protected $shortDescription;
    protected $fullDescription;
    protected $seoTitle;
    protected $seoDescription;
    protected $seoKeywords;
    protected $visible;
    protected $purchasePrice;
    protected $price;
    protected $oldPrice;
    protected $importedId;
    protected $variantsCompound;
    #endregion
}