<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\Company;
use SphereMall\MS\Resources\Resource;

/**
 * Class CompaniesResource
 * @package SphereMall\MS\Resources\Users
 * @method Company get(int $id)
 * @method Company[] all()
 * @method Company update($id, $data)
 * @method Company create($data)
 */
class CompaniesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "companies";
    }
    #endregion
}