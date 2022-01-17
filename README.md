# Introduction

The Laravel eCommerce ABA Payment Gateway module allows the admin to integrate the ABA payment gateway to the online store.

## Requirements:

- **Bagisto**: v1.3.2.

## Installation :
- Run the following command
```
composer require bagisto/bagisto-aba-payment
```

- Run these commands below to complete the setup
```
composer dump-autoload
```

```
php artisan migrate
php artisan route:cache
php artisan config:cache
```

```
php artisan vendor:publish
```
-> Press 0 and then press enter to publish all assets and configurations.

> now execute the project on your specified domain.
