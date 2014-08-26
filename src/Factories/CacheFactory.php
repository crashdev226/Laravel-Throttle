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

namespace GrahamCampbell\Throttle\Factories;

use GrahamCampbell\Throttle\Throttlers\CacheThrottler;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

/**
 * This is the cache throttler factory class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Throttle/blob/master/LICENSE.md> Apache 2.0
 */
class CacheFactory implements FactoryInterface
{
    /**
     * The cache instance.
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Cache\Repository $cache
     *
     * @return void
     */
    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Make a new throttler instance.
     *
     * @param string[]|\Illuminate\Http\Request $data
     * @param int                               $limit
     * @param int                               $time
     *
     * @return \GrahamCampbell\Throttle\Throttlers\CacheThrottler
     */
    public function make($data, $limit = 10, $time = 60)
    {
        $data = $this->parseData($data);
        $store = $this->getStore($data['ip']);
        $key = $this->getKey($data['route']);

        return new CacheThrottler($store, $key, $limit, $time);
    }

    /**
     * Parse the data.
     *
     * @param string[]|\Illuminate\Http\Request $data
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function parseData($data)
    {
        if (is_object($data) && $data instanceof Request) {
            return array('ip' => $data->getClientIp(), 'route' => $data->path());
        }

        if (is_array($data) && array_key_exists('ip', $data) && array_key_exists('route', $data)) {
            return array('ip' => $data['ip'], 'route' => $data['route']);
        }

        throw new \InvalidArgumentException('An array, or an instance of Illuminate\Http\Request was expected.');
    }

    /**
     * Get the store.
     *
     * @param string $ip
     *
     * @return \Illuminate\Cache\TaggableStore
     */
    protected function getStore($ip)
    {
        return $this->cache->tags('throttle', $ip);
    }

    /**
     * Get the key.
     *
     * @param string $path
     *
     * @return string
     */
    protected function getKey($path)
    {
        return md5($path);
    }

    /**
     * Get the cache instance.
     *
     * @return \Illuminate\Cache\Repository
     */
    public function getCache()
    {
        return $this->cache;
    }
}
