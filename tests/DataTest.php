<?php

/**
 * This file is part of Laravel Throttle by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Throttle;

use GrahamCampbell\Throttle\Data;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

/**
 * This is the data test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Throttle/blob/master/LICENSE.md> Apache 2.0
 */
class DataTest extends AbstractTestBenchTestCase
{
    public function testGetIp()
    {
        $data = $this->getData();

        $this->assertSame('127.0.0.1', $data->getIp());
    }

    public function testGetRoute()
    {
        $data = $this->getData();

        $this->assertSame('https://google.co.uk/', $data->getRoute());
    }

    public function testGetRouteKey()
    {
        $data = $this->getData();

        $this->assertSame('72bdf68973bae84cb0fc9ad08f49b799', $data->getRouteKey());
    }

    public function testGetLimit()
    {
        $data = $this->getData();

        $this->assertSame(123, $data->getLimit());
    }

    public function testGetTime()
    {
        $data = $this->getData();

        $this->assertSame(321, $data->getTime());
    }

    public function testGetKey()
    {
        $data = $this->getData();

        $this->assertSame('648af8e05d0872dd391879160369caea', $data->getKey());
    }

    protected function getData()
    {
        return new Data('127.0.0.1', 'https://google.co.uk/', 123, 321);
    }
}
