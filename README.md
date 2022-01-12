# Introduction

Bagisto ABA Payment Gateway.

## Requirements:

- **Bagisto**: v1.3.2.

## Installation with composer:
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

### 3. Installation without composer:

- Unzip the respective extension zip and then merge "packages" folders into project root directory.
- Goto config/app.php file and add following line under 'providers'

~~~
Webkul\Aba\Providers\AbaServiceProvider::class
~~~

- Goto composer.json file and add following line under 'psr-4'

~~~
"Webkul\\Aba\\": "packages/Webkul/Aba/src"
~~~

- Run these commands below to complete the setup

~~~
composer dump-autoload
~~~

~~~
php artisan migrate
~~~

~~~
php artisan route:cache
~~~

~~~
php artisan vendor:publish

-> Press 0 and then press enter to publish all assets and configurations.
~~~

> now execute the project on your specified domain.