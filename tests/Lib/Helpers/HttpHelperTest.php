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
 *
 * @property string $url
 * @property string $urlDefault
 */
class HttpHelperTest extends SetUpResourceTest
{

    protected $url        = 'example.com/v1/test';
    protected $urlDefault = 'example.com:80/v1/test\'';

    /**
     *
     */
    public function testAddPort()
    {
        $this->assertEquals($this->urlDefault, Helper::addPort($this->url, 80));

        $this->url        = 'example.com';
        $this->urlDefault = 'example.com:80';

        $this->assertEquals( $this->urlDefault, Helper::addPort($this->url, 80));
    }

    /**
     *
     */
    public function testSetHttPortToUrl()
    {
        $this->url        = 'http://example.com/v1/test';
        $this->urlDefault = 'http://example.com:443/v1/test';

        $this->assertEquals( $this->urlDefault, Helper::setHttPortToUrl( $this->url, true));

        $urlDefault = 'http://example.com:80/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($this->url, false));

        $this->url        = 'http://example.com:9020/v1/test';
        $this->urlDefault = 'http://example.com:9020/v1/test';

        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($this->url, false));
        $this->assertEquals($urlDefault, Helper::setHttPortToUrl($this->url, true));

        $this->url        = 'https://example.com/v1/test';
        $this->urlDefault = 'https://example.com:443/v1/test';

        $this->assertEquals($this->urlDefault, Helper::setHttPortToUrl($this->url));
    }
}
