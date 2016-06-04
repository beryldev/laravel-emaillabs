## Unofficial Laravel mail integration with EmailLabs
Simple package to integrate Laravel Email with [EmailLabs](http://emaillabs.io)

## Installation

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
php artisan vendor:publish --provider="Beryldev\EmailLabs\EmailLabsServiceProvider"
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