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
 * Class WishListItem
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $userId
 * @property string $createDate
 * @property string $updateDate
 * @property Product $product
 */
class WishListItem extends Entity
{
    #region [Properties]
    public $id;
    public $userId;
    public $createDate;
    public $updateDate;

    public $product;
    #endregion
}