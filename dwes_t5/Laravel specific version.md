Crear proyecto de una versión específica:
```shell
composer create-project laravel/laravel="10.1.0" myProject
```

Obtener versión específica de Breeze:
```shell
composer require laravel/breeze:^1.29.1 --dev
```


## Laravel 11
Laravel new version. Changes to file `config/database.php`.

en 'mysql'

```
'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci')
```

en 'mariadb'
```
'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci')
```
