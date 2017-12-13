<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\WishListItem;
use SphereMall\MS\Resources\Resource;

/**
 * Class WishListItemsResource
 * @package SphereMall\MS\Resources\Users
 * @method WishListItem get(int $id)
 * @method WishListItem first()
 * @method WishListItem[] all()
 * @method WishListItem update($id, $data)
 * @method WishListItem create($data)
 */
class WishListItemsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "wishlistitems";
    }
    #endregion
}