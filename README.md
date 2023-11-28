## Demo Laravel Application

This is a simple demo application that is using Laravel 10+. 

### Task description

1. Create user registration form with following fields:
   1. username
   2. email
   3. password
   4. password confirmation
   5. terms and conditions checkbox
   6. registration
2. save user data in a database
3. create login form

### Requirements

1. use laravel php framework
2. use mysql database

## Instalation

1. Checkout project from github.
```shell
git clone git@github.com:GrzegorzDrozd/example-laravel-application.git
```

2. Install dependencies
```shell
composer install
```

3. Check configuration in `.env` file

4. Run database migration and seeding
```shell
php artisan migrate --seed
```

5. Run tests:
```shell
php vendor/bin/phpunit tests
```
