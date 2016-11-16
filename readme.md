Installation:

##Requirements:

 - sqlite
 - php 5.5.9
 - node(npm)
 - gulp

## Instructions:

- componser install
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

- php artisan serve

User url:
 - http://localhost:8000/
Admin panel:
 - http://localhost:8000/admin

User:
 email: test@gmail.com
 password: test
