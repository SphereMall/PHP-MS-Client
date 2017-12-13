<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Users;

use SphereMall\MS\Entities\Message;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class MessagesResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $all = $this->client->messages()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Message::class, $item);
        }
    }

    #endregion
}
