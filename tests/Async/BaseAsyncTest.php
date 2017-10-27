<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Async;

use SphereMall\MS\Client;
use SphereMall\MS\Lib\Async\AsyncContainer;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class BaseAsyncTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testAsyncCalls()
    {
        $time1 = microtime(true);
        $ac = new AsyncContainer($this->client);

        $ac->setCall(function(Client $client){
            return $client->products()->limit(1)->all();
        });

        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });
        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });
        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });
        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });
        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });
        $ac->setCall(function(Client $client){
            return $client->products()->limit(200)->all();
        });

        $data = $ac->call();

        $resTime = round((microtime(true) - $time1), 3);
        $this->assertEquals(true, true);
    }

    public function testNotAsyncCalls()
    {
        $time1 = microtime(true);

        $this->client->products()->limit(1)->all();

        $this->client->products()->limit(200)->all();
        $this->client->products()->limit(200)->all();
        $this->client->products()->limit(200)->all();
        $this->client->products()->limit(200)->all();
        $this->client->products()->limit(200)->all();
        $this->client->products()->limit(200)->all();


        $resTime = round((microtime(true) - $time1), 3);
        $this->assertEquals(true, true);
    }
    #endregion
}
