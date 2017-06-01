<?php

/*
 * This file is part of Laravel Throttle.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Throttle;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use GrahamCampbell\Throttle\Factories\CacheFactory;
use GrahamCampbell\Throttle\Factories\FactoryInterface;
use GrahamCampbell\Throttle\Http\Middleware\ThrottleMiddleware;
use GrahamCampbell\Throttle\Throttle;
use GrahamCampbell\Throttle\Transformers\TransformerFactoryInterface;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testCacheFactoryIsInjectable()
    {
        $this->assertIsInjectable(CacheFactory::class);
        $this->assertIsInjectable(FactoryInterface::class);
    }

    public function testTransformerFactoryIsInjectable()
    {
        $this->assertIsInjectable(TransformerFactoryInterface::class);
    }

    public function testThrottleIsInjectable()
    {
        $this->assertIsInjectable(Throttle::class);
    }

    public function testMiddlewareIsInjectable()
    {
        $this->assertIsInjectable(ThrottleMiddleware::class);
    }
}
