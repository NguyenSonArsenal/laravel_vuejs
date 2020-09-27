# README

## SYSTEM REQUIREMENT

* DB
  - MySQL 5.6
* Apache 
    - 2.4
* PHP
  - 7.3
* Laravel
  - 8.6.0
* Composer
  - 1.8.4


## Deploy
* permission
```
chmod -R 777 bootstrap/cache
chmod -R 777 storage/logs/
chmod -R 777 storage/logs_for_130/
chmod -R 777 storage
chmod -R 777 storage/framework
chmod -R 777 public/media
chmod -R 777 public/tmp_uploads
```

* run
```bash
 composer install
 php artisan config:cache
 php artisan config:clear 
 php artisan cache:clear
 php artisan route:clear
```

* run deploy
```bash
cp .env.example .env
php artisan key:generate
```
* config your database in .env
find and replace database config
```bash
vi .env
```
* run database
```bash
php artisan migrate
php artisan db:seed
```

* run project 
```bash
php artisan serve
```
