# 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


Widgets Manager AND Maker for Laravel 5.*

## Install

Via Composer

``` bash
$ composer require jtrachez/widgets-laravel
```

## Usage

### Services Provider
Add in your `config/app.php` :
``` php
Tequila\Widgets\WidgetsServiceProvider::class,
```

### Widgets Maker
``` bash
php artisan make:widget MyWidget
```

use `--backend` option if you want make a backend widget 

_example :_ 

``` bash
php artisan make:widget MyWidget --backend
```

### Views
Get widget on a blade view : 
``` blade
@widget('my_widget')
```

if you want use in backend :
``` blade
@widget('my_widget', 'backend')
```


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email @example.com instead of using the issue tracker.

## Credits

- [Julien Trachez][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v//.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis///master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g//.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g//.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt//.svg?style=flat-square

[link-packagist]: https://packagist.org/packages//
[link-travis]: https://travis-ci.org//
[link-scrutinizer]: https://scrutinizer-ci.com/g///code-structure
[link-code-quality]: https://scrutinizer-ci.com/g//
[link-downloads]: https://packagist.org/packages//
[link-author]: https://github.com/
[link-contributors]: ../../contributors
