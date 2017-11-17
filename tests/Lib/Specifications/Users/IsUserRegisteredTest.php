<?php
/**
 * Created by PHPStorm.
 * User: Yaroslav Draha
 */

namespace SphereMall\MS\Tests\Lib\Specifications\Basic;

use SphereMall\MS\Lib\Specifications\Users\IsUserRegistered;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class IsUserRegisteredTest extends SetUpResourceTest
{
    private $email = 'ms-php-sdk-email-test@test.com';
    private $password = 'to-md5';
    private $testUserId;

    #region [Test methods]
    public function testIsUserRegisteredSpecificationSingle()
    {
        $encodedPass = md5($this->password);

        // create new user
        $resource = $this->client->users();
        $user = $resource->create([
            'email' => $this->email,
            'password' => $encodedPass
        ]);
        $this->testUserId = $user->id;
        $this->assertEquals($this->email, $user->email);
        $this->assertEquals($encodedPass, $user->password);

        // check spec
        $spec = new IsUserRegistered($this->email, $this->password);
        $this->assertTrue($spec->isSatisfiedBy($user));
    }

    public function testIsUserRegisteredSpecificationList()
    {
        $encodedPass = md5($this->password);

        // create new user
        $resource = $this->client->users();
        $user = $resource->create([
            'email' => $this->email,
            'password' => $encodedPass
        ]);
        $this->testUserId = $user->id;
        $this->assertEquals($this->email, $user->email);
        $this->assertEquals($encodedPass, $user->password);

        // check spec
        $users = $resource
            ->limit(10)
            ->all();

        $spec = new IsUserRegistered($this->email, $this->password);

        foreach ($users as $user) {
            if($user->email === $this->email) {
                $this->assertTrue($spec->isSatisfiedBy($user));
            } else {
                $this->assertFalse($spec->isSatisfiedBy($user));
            }
        }
    }

    protected function tearDown()
    {
        if($this->testUserId) {
            $resource = $this->client->users();
            $this->assertTrue($resource->delete($this->testUserId));
        }
    }
    #endregion
}
