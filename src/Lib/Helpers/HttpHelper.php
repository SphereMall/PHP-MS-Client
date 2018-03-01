<?php
/**
 * Project PHP-MS-Client.
 * File: HttpHelper.php
 * Created by Sergey Yanchevsky
 * 23.02.2018 14:43
 */

namespace SphereMall\MS\Lib\Helpers;

/**
 * Class HttpHelper
 * @package SphereMall\MS\Lib\Helpers
 */
class HttpHelper
{
    #region [constants]
    const DEFAULT_PORT_HTTP  = 80;
    const DEFAULT_PORT_HTTPS = 443;
    const DELIMITER          = '://';
    #endregion

    #region [public static method]
    /**
     * @param string $url
     * @param bool $https
     *
     * @return string
     */
    public static function setHttPortToUrl(string $url, bool $https = null): string
    {
        if (preg_match("/\.([a-z0-9]{2,9})\:([0-9]+)/Ui", $url)) {
            return $url;
        }
        $urlArray = explode(self::DELIMITER, $url);
        $port = self::DEFAULT_PORT_HTTP;
        if (($https === true || $urlArray[0] == 'https' || static::isSecure($https, $urlArray[0])) && $https !== false) {
            $port = self::DEFAULT_PORT_HTTPS;
        }

        return $urlArray[0] . self::DELIMITER . static::addPort($urlArray[1], $port);
    }

    /**
     * @param string $url
     * @param int $port
     *
     * @return string
     */
    public static function addPort(string $url, int $port)
    {
        $url = explode('/', $url);
        $url[0] .= ':' . $port;

        return join('/', $url);
    }

    /**
     * @param bool|null $https
     * @param string $urlHttp
     *
     * @return bool
     */
    public static function isSecure(bool $https = null, string $urlHttp): bool
    {
        return ($https === true || $urlHttp == 'https' || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') && $https !== false);
    }
    #endregion
}
