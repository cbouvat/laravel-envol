# Laravel Envol BETA

Laravel 5.2+ deploy with webhook Github and Bitbucket.

## Installation

Require this package with composer :

```shell
composer require cbouvat/laravel-envol
```

Add to `config/app.php`:

```php
Cbouvat\Envol\EnvolServiceProvider::class,
```

Install configuration

```shell
php artisan vendor:publish --provider="Cbouvat\Envol\EnvolServiceProvider"
```

Edit "/config/envol.php"

## Usage

Add webhook in Github or Bitbucket

http(s)://your-project/envol?key=YOURKEY

## Configuration

Soon

## TODO

- Unit test
- More documentation
- Custom mail
- Artisan command
- Improve logging
- Error exception
