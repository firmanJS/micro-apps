<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## USER MANAGEMENT SERVICE API
Build with laravel 7.x + MySql

## Installation

```sh
$ cp .env.example .env
$ docker-compose up -d
$ sudo docker exec -it user_management_service bash
$ php composer.phar install
$ php artisan key:generate
$ php artisan jwt:secret
$ php artisan migrate
```


## Coding Style
- Naming conventions :
https://github.com/alexeymezenin/laravel-best-practices#follow-laravel-naming-conventions
- PSR standards :
https://www.php-fig.org/psr/psr-2/

## License
User Management Service API is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).