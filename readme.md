## BlogMVC : Laravel 5.4

This is my contribution to BlogMVC.com using Laravel 5.4. I used this project to learn the framework so if you think some patterns are not respected please create an issue :).

```bash
composer install
php artisan key:generate # Edit your .env
php artisan migrate
php artisan db:seed # fill the database with some data
php artisan serve # http://localhost:8000/
```

I wrote a test for the counter cache that can be accessed using

```php
./vendor/bin/phpunit
```
