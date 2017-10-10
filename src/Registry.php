<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10.10.2017
 * Time: 23:00
 */

namespace SphereMall\MS;

class Registry
{
    /**
     * @var null
     */
    static private $_instance = null;

    /**
     * @var array
     */
    private $_registry = [];

    /**
     * Registry constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return null|Registry
     */
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * @param $key
     * @param $value
     */
    static public function set($key, $value)
    {
        self::getInstance()->_registry[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    static public function get($key)
    {
        return self::getInstance()->_registry[$key];
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }
}