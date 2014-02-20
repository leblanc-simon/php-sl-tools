<?php
/*
 Copyright © 2014 Simon Leblanc <contact@leblanc-simon.eu>
 This work is free. You can redistribute it and/or modify it under the
 terms of the Do What The Fuck You Want To Public License, Version 2,
 as published by Sam Hocevar. See the LICENSE file for more details.
*/

namespace SLTools;

/**
 * Class to manipulate configuration
 *
 * @package SLTools
 * @license WTFPL
 * @author  Simon Leblanc <contact@leblanc-simon.eu>
 */
class Config
{
    static private $datas = array();

    /**
     * Get a value in the configuration
     *
     * @param   string  $name       The name of the configuration to get
     * @param   mixed   $default    The default value if the configuration doesn't exist
     * @return  mixed               The value of the configuration
     */
    static public function get($name, $default = null)
    {
        return (array_key_exists($name, static::$datas) === true) ? static::$datas[$name] : $default;
    }

    /**
     * Add values in the configuration
     *
     * @param   array   $datas  The values to add in the configuration
     */
    static public function add(array $datas = array())
    {
        static::$datas = array_merge(static::$datas, $datas);
    }

    /**
     * Set a value in the configuration
     *
     * @param   string  $name       The name of the configuration to set
     * @param   mixed   $value      The value to set
     * @param   bool    $replace    True to force the replacement if a value already exist, false else
     * @return  bool                True if the value is setting, false else (already exist and replace = false)
     */
    static public function set($name, $value, $replace = false)
    {
        if (array_key_exists($name, static::$datas) === true && false === $replace) {
            return false;
        }

        static::$datas[$name] = $value;
        return true;
    }
}