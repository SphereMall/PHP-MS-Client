<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/30/2017
 * Time: 1:40 PM
 */


namespace SphereMall\MS\Tests\Lib\Helpers;

use SphereMall\MS\Tests\Resources\SetUpResourceTest;
use SphereMall\MS\Lib\Helpers\HttpHelper as Helper;

/**
 * Class HttpHelper
 * @package SphereMall\MS\Tests\Lib\Helpers
 */
class HttpHelperTest extends SetUpResourceTest
{

    public function testAddPort()
    {
        $url        = 'example.com/v1/test';
        $urlDefault = 'example.com:80/v1/test';

        $this->assertEquals($urlDefault, Helper::addPort($url, 80));

        $url        = 'example.com';
        $urlDefault = 'example.com:80';

        $this->assertEquals($urlDefault, Helper::addPort($url, 80));
    }

    public function testSetHttPortToUrl()
    {
        $url        = 'http://example.com/v1/test';
        $urlDefault = 'http://example.com:443/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($url, true));

        $urlDefault = 'http://example.com:80/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($url, false));

        $url        = 'http://example.com:9020/v1/test';
        $urlDefault = 'http://example.com:9020/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($url, false));
        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($url, true));

        $url        = 'https://example.com/v1/test';
        $urlDefault = 'https://example.com:443/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($url));
    }
}
