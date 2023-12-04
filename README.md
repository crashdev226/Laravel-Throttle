Laravel Throttle
================

Laravel Throttle was created by, and is maintained by [crashdev226](https://github.com/crashdev226), and is a rate limiter for [Laravel](https://laravel.com/). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/crashdev226/Laravel-Throttle/releases), [security policy](https://github.com/crashdev226/Laravel-Throttle/security/policy), [license](LICENSE), [code of conduct](.github/CODE_OF_CONDUCT.md), and [contribution guidelines](.github/CONTRIBUTING.md).

## Installation

This version requires [PHP](https://www.php.net/) 7.4-8.2 and supports [Laravel](https://laravel.com/) 8-10.

| Throttle | L5.5               | L5.6               | L5.7               | L5.8               | L6                 | L7                 | L8                 | L9                 | L10                |
|----------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|--------------------|
| 7.5      | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 8.2      | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                |
| 9.0      | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :x:                |
| 10.0     | :x:                | :x:                | :x:                | :x:                | :x:                | :x:                | :white_check_mark: | :white_check_mark: | :white_check_mark: |

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):


Once installed, if you are not using automatic package discovery, then you need to register the `crashdev226\Throttle\ThrottleServiceProvider` service provider in your `config/app.php`.

You can also optionally alias our facade:

## Configuration

Laravel Throttle supports optional configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/throttle.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There is one config option:

##### Cache Driver

This option (`'driver'`) defines the cache driver to be used. It may be the name of any driver set in config/cache.php. Setting it to null will use the driver you have set as default in config/cache.php. The default value for this setting is `null`.


## Usage

##### Throttle

This is the class of most interest. It is bound to the ioc container as `'throttle'` and can be accessed using the `Facades\Throttle` facade. There are six public methods of interest.

The `'get'` method will create a new throttler class (a class that implements `Throttler\ThrottlerInterface`) from the 1-3 parameters that you pass to it. The first parameter is required and must either an instance of `\Illuminate\Http\Request`, or an associative array with two keys (`'ip'` should be the ip address of the user you wish to throttle and `'route'` should be the full url you wish to throttle, but actually, for advanced usage, may be any unique key you choose). The second parameter is optional and should be an `int` which represents the maximum number of hits that are allowed before the user hits the limit. The third and final parameter should be an `int` that represents the time the user must wait after going over the limit before the hit count will be reset to zero. Under the hood this method will be calling the make method on a throttler factory class (a class that implements `Factories\FactoryInterface`).

The other 5 methods all accept the same parameters as the `get` method. What happens here is we dynamically create a throttler class (or we automatically reuse an instance we already created), and then we call the method on it with no parameters. These 5 methods are `'attempt'`, `'hit'`, `'clear'`, `'count'`, and `'check'`. They are all documented bellow.

##### Facades\Throttle

This facade will dynamically pass static method calls to the `'throttle'` object in the ioc container which by default is the `Throttle` class.

##### Throttler\ThrottlerInterface

This interface defines the public methods a throttler class must implement. All 5 methods here accept no parameters.

The `'attempt'` method will hit the throttle (increment the hit count), and then will return a boolean representing whether or not the hit limit has been exceeded.

The `'hit'` method will hit the throttle (increment the hit count), and then will return `$this` so you can make another method call if you so choose.

The `'clear'` method will clear the throttle (set the hit count to zero), and then will return `$this` so you can make another method call if you so choose.

The `'count'` method will return the number of hits to the throttle.

The `'check'` method will return a boolean representing whether or not the hit limit has been exceeded.

##### Throttler\CacheThrottler

This class implements `Throttler\ThrottlerInterface` completely. This is the only throttler implementation shipped with this package, and in created by the `Factories\CacheFactory` class. Note that this class also implements PHP's `Countable` interface.

##### Factories\FactoryInterface

This interface defines the public methods a throttler factory class must implement. Such a class must only implement one method.

The `'make'` method will create a new throttler class (a class that implements `Throttler\ThrottlerInterface`) from data object you pass to it. This documentation of an internal interface is included for advanced users who may wish to write their own factory classes to make their own custom throttler classes.

##### Factories\CacheFactory

This class implements `Factories\FactoryInterface` completely. This is the only throttler implementation shipped with this package, and is responsible for creating the `Factories\CacheFactory` class. This class is only intended for internal use by the `Throttle` class.

##### ThrottleServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Further Information

There are other classes in this package that are not documented here (such as the transformers). This is because they are not intended for public use and are used internally by this package.


## Security

If you discover a security vulnerability within this package, please send an email to security@tidelift.com. All security vulnerabilities will be promptly addressed. You may view our full security policy [here](https://github.com/crashdev226/Laravel-Throttle/security/policy).


## License

Laravel Throttle is licensed under [The MIT License (MIT)](LICENSE).
