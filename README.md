## Unofficial Laravel mail integration with EmailLabs&trade;
Simple package to integrate Laravel Email with [EmailLabs&trade;](http://emaillabs.io)

## Installation

**Important!**

This package is in early beta stage, and is no available via packagist.org

To install add to your Laravel project `composer.json`:
```
"minimum-stability": "dev",
"repositories": [
    {
        "url": "https://github.com/beryldev/laravel-emaillabs.git",
        "type": "git"
    }
],
```

EmailLabs API driver require that the Guzzle HTTP library be installed for your application. 

You may install Guzzle to your project by adding the following line to your `composer.json` file:
```
"guzzlehttp/guzzle": "~5.3|~6.0"
```

Require this package with composer:

```
composer require beryldev/laravel-emaillabs
```

After updating composer, add the EmailLabsServiceProvider to the providers array in config/app.php
> If you use Laravel Debugbar with enabled email collector, make sure you load EmailLabsServiceProvider before Debugbar ServiceProvider.

### Laravel 5.x:

```
Beryldev\EmailLabs\EmailLabsServiceProvider::class,
```

Copy the package config to your local config with the publish command:

```
php artisan vendor:publish --provider="Beryldev\EmailLabs\EmailLabsServiceProvider" --tag=config
```

## Configuration

After install add to your .env file requred parameters.

### App Key

```
EL_APP=your_emaillabs_app_key
```

### Secret Key

```
EL_SECRET=your_emaillabs_secret_key
```

### SMTP account name

```
EL_SMTP=your_emaillabs_smtp_account_name
```

Now you can use `emaillabs` mail driver

```
MAIL_DRIVER=emaillabs
```

## License

The Laravel EmailLabs Integration is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)