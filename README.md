# LaravelAddressParser

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Take a look at [contributing.md](contributing.md) to see a to do list.

Requirements
------------
 - PHP >= 7.1.0
 - Mbstring PHP Extension
 - Laravel >= 5.5.0

## Installation

Via Composer

``` bash
$ composer require zifan/laravel-addressparser
```
Then run these commands to publish config：

```
$ php artisan vendor:publish --tag="addressparser.config"
```
After run command you can find config file in `config/addressparser.php`, in this file you can change the settings.

## Configuration

* dataProvider array Default setting: [
      'driver' => 'database', 
      'model' => 'Zifan\LaravelAddressParser\Models\Area'
  ]

If you use the plug-in's default data provider, follow these instructions:

```
$ php artisan address-parser:table
$ php artisan migrate --step
```
* Omit others

## Usage

\AddressParser::smart('浙江省杭州市滨江区西兴街道滨康路228号万福中心A座21楼');

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email s443939412@163.com instead of using the issue tracker.

## Credits

- [zifan][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zifan/addressparser.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zifan/addressparser.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zifan/addressparser/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/zifan/addressparser
[link-downloads]: https://packagist.org/packages/zifan/addressparser
[link-travis]: https://travis-ci.org/zifan/addressparser
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/a443939412
[link-contributors]: ../../contributors
