# Maun Laravel Admin package

Maun Laravel Admin package is a PHP package for Laravel Framework. Used for manipulation data and models.

## Requirements

- "php": ">=7.0",
- "muan/laravel-acl": "^1.1"
- "intervention/image": "^2.4"

## Install

1) Type next command in your terminal:

```bash
composer require muan/laravel-acl
```

2) Add the service provider to your config/app.php file in section providers:

> Laravel 5.5 uses Package Auto-Discovery, so does not require you to manually add the ServiceProvider.

```php
'providers' => [
    // ...
    Muan\Admin\Providers\AdminServiceProvider::class,
    // ...
],
```

3) Start command for installation:

```bash
php artisan admin:install
```

4) Use the following trait on your User model

```php
// Use traits
use Muan\Acl\Traits\{HasPermissionsTrait, HasRolesTrait};
use Muan\Admin\Models\Traits\AdminExtendUser;
 
class User extends Authenticatable
{
    use HasPermissionsTrait, HasRolesTrait, AdminExtendUser;
    
    // ...
}
```

## Commands

Publishing views:
```bash
php artisan vendor:publish --provider="Muan\Admin\Providers\AdminServiceProvider" --tag=admin
```

Add new user:

```bash
php artisan user:add
```

## License

Muan Laravel Admin package is licensed under the [MIT License](http://opensource.org/licenses/MIT).
