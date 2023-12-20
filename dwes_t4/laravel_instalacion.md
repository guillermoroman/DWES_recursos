# Instalación de Laravel

## Requisitos
- PHP
- Base de datos
  
Si tienes instalado el entorno XAMPP que utilizamos en el tema anterior, ya tienes Php instalado, así como el servidor Apache para interpretarlo y la base de datos MariaDB.

## Composer

Descarga e instala composer:
1. Descargar: https://getcomposer.org
2. Seguir las instrucciones de instalación.

Composer es una herramienta de gestión de dependencias para PHP. Se utiliza para manejar y mantener las bibliotecas de las que depende tu proyecto PHP.

## Instalar Laravel a través de Composer
Ejecuta la siguiente orden en la línea de comandos:

```shell
composer global require laravel/installer
```

## Crear un nuevo proyecto

Para crear un proyecto de Laravel, utilizaremos la linea de comandos. Debemos abrir la linea de comandos desde el directorio donde queramos crear nuestro proyecto, o navegar hasta el mismo. Una vez dentro, podemos crear nuestro proyecto de las siguientes formas:

- Utilizando composer:
```bash
composer create-project laravel/laravel [nombre_a_elegir]
```
- Utilizando Laravel
```shell
laravel new [nombre_a_elegir]
```

## Abrir el proyecto con VSCode

Al crear el proyecto, se ha generado una carpeta en la ubicaciónd desde la que ejecutamos la orden. Para 
1. Entramos en el nuevo directorio
```shell
cd [nombre_elegido]
```
2. Abrimos la carpeta con visual studio con el comando:
```shell
code .
```

## Arrancar el servidor laravel

```shell
php artisan serve
````
``