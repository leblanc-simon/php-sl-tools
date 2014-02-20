<?php
/*
 Copyright © 2014 Simon Leblanc <contact@leblanc-simon.eu>
 This work is free. You can redistribute it and/or modify it under the
 terms of the Do What The Fuck You Want To Public License, Version 2,
 as published by Sam Hocevar. See the LICENSE file for more details.
*/

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $reflection = new ReflectionClass('SLTools\\Config');
        $reflection_property = $reflection->getProperty('datas');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue(array());
        $reflection_property->setAccessible(false);
    }

    public function testAddWithEmpty()
    {
        $config = array(
            'a' => 1,
            'b' => 'b',
            'c' => array(1),
            'd' => new stdClass()
        );

        SLTools\Config::add($config);

        foreach ($config as $key => $value) {
            $this->assertEquals($value, SLTools\Config::get($key));
        }
    }


    public function testAddNotEmpty()
    {
        SLTools\Config::set('a', 1);

        $config = array(
            'b' => 'b',
            'c' => array(1),
            'd' => new stdClass()
        );

        SLTools\Config::add($config);

        $this->assertEquals(1, SLTools\Config::get('a'));

        foreach ($config as $key => $value) {
            $this->assertEquals($value, SLTools\Config::get($key));
        }
    }


    public function testAddNotEmptyWithSameKey()
    {
        SLTools\Config::set('a', 1);

        $this->assertEquals(1, SLTools\Config::get('a'));

        $config = array(
            'a' => 2,
            'b' => 'b',
            'c' => array(1),
            'd' => new stdClass()
        );

        SLTools\Config::add($config);

        foreach ($config as $key => $value) {
            $this->assertEquals($value, SLTools\Config::get($key));
        }
    }


    public function testSet()
    {
        SLTools\Config::set('a', 1);

        $this->assertEquals(1, SLTools\Config::get('a'));

        SLTools\Config::set('a', 2);

        $this->assertEquals(1, SLTools\Config::get('a'));

        SLTools\Config::set('a', 2, true);

        $this->assertEquals(2, SLTools\Config::get('a'));
    }
}