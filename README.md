<img src="https://github.com/dbrax/mpesa-tanzania/blob/main/mpesa-tanzania.png">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epmnzava/mpesa-tanzania.svg?style=flat-square)](https://packagist.org/packages/epmnzava/mpesa-tanzania)
[![Total Downloads](https://img.shields.io/packagist/dt/epmnzava/tigosecure.svg?style=flat-square)](https://packagist.org/packages/epmnzava/mpesa-tanzania)
[![Emmanuel Mnzava](https://img.shields.io/badge/Author-Emmanuel%20Mnzava-green)](mailto:epmnzava@gmail.com)

This package is created to help developers intergrate with Vodacom Mpesa Tanzania secure online api. More information of this can be found [here](https://epmnzava.medium.com/)

## Installation


## Version Matrix

Version | Laravel   | PHP Version
------- | --------- | ------------
1.0.0   | 8.0       | >= 8.0 


You can install the package via composer:

```bash
composer require epmnzava/mpesa-tanzania
```

## Update your config (for Laravel 5.4 and below)

Add the service provider to the providers array in config/app.php:

```php
Epmnzava\MpesaTanzania\MpesaTanzaniaServiceProvider::class,
```
Add the facade to the aliases array in config/app.php:

```php
'mpesa' =>\Epmnzava\MpesaTanzania\MpesaTanzaniaFacade::class,
```

## Publish the package configuration (for Laravel 5.4 and below)

Publish the configuration file and migrations by running the provided console command:

```bash
php artisan vendor:publish --provider="Epmnzava\MpesaTanzania\MpesaTanzaniaServiceProvider"