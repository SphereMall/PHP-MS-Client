<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 07.11.2018
 * Time: 12:18
 */

namespace SphereMall\MS\Resources\Users;


use SphereMall\MS\Resources\Resource;

class UserAdditionalDataResource extends Resource
{

    function getURI()
    {
        return 'useradditionaldata';
    }

    function save($userId, $data)
    {
        return $this->create(['id' => $userId, 'data' => $data]);
    }
}