# Installation:

## Requirements:

 - sqlite
 - php 5.5.9
 - node(npm)
 - gulp

## Commands:

- composer install
- npm install
- gulp
- php artisan migrate
- php artisan tinker

```php

// Create data
factory(App\User::class)->create();
factory(App\Article::class, 10)->create();
factory(App\Notification::class, 10)->create();

```
- php artisan key:generate
- php artisan serve

User url:
 - http://localhost:8000/

Admin panel:
 - http://localhost:8000/admin

Admin User:
 - email: test@gmail.com
 - password: test
