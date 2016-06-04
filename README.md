## Unofficial Laravel mail driver for EmailLabs.pl
Simple package to integrate Laravel Email with EmailLabs.pl

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