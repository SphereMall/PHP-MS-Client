<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 07.11.2018
 * Time: 12:21
 */

namespace SphereMall\MS\Tests\Resources\Users;


use SphereMall\MS\Entities\UserAdditionalData;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class UserAdditionalDataResourceTest extends SetUpResourceTest
{
    public function testSaveUserAdditionalData()
    {
        $all = $this->client->users()->all();

        $data = 'test2';

        $this->client->userAdditionalData()->save($all[0]->id,$data);

        $additionalData = $this->client->userAdditionalData()->get($all[0]->id);

        $this->assertEquals($data, $additionalData->data);

        $this->assertInstanceOf(UserAdditionalData::class, $additionalData);
    }
}