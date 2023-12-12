
# Introducción
Laravel es un popular y poderoso framework de desarrollo de aplicaciones web en PHP que se utiliza para crear aplicaciones web de manera rápida y eficiente. Fue creado por Taylor Otwell y se lanzó por primera vez en 2011. Laravel se ha convertido en una de las opciones preferidas para el desarrollo web en PHP debido a su elegante sintaxis, su conjunto completo de herramientas y su enfoque en la simplicidad y la productividad. El objetivo era combinar las mejores prácticas y características de otros frameworks existentes.

Algunas de las características clave de Laravel incluyen:
1. **Elegante sintaxis:** Laravel utiliza una sintaxis limpia y expresiva que facilita la escritura de código limpio y legible. Esto mejora la mantenibilidad y la colaboración en el desarrollo de proyectos.
2. **Motor de plantillas Blade:** Laravel incluye Blade, un motor de plantillas que simplifica la creación de vistas y permite la reutilización de componentes.
3. **Sistema de enrutamiento:** Laravel proporciona un sistema de enrutamiento flexible que permite definir fácilmente rutas y controladores para manejar las solicitudes HTTP entrantes.
4. **ORM (Object-Relational Mapping):** Eloquent, el ORM de Laravel, simplifica la interacción con la base de datos al permitirte trabajar con modelos y consultas de manera orientada a objetos.
5. **Migraciones y esquemas de base de datos:** Laravel ofrece herramientas para gestionar esquemas de base de datos y migraciones de manera sencilla, lo que facilita la administración de la estructura de la base de datos a lo largo del tiempo.
6. **Autenticación y autorización:** Laravel incluye un sistema completo de autenticación y autorización que simplifica la implementación de la seguridad en tu aplicación.
7. Seguridad Integrada: Medidas contra la inyección de SQL y la Falsificación de Solicitudes entre Sitios (CSRF).
9. **Caché y sesiones:** Ofrece soporte para el almacenamiento en caché y la gestión de sesiones, lo que mejora el rendimiento de la aplicación.
10. **Tareas programadas:** Laravel permite programar tareas recurrentes con facilidad mediante la configuración de trabajos programados (cron jobs).
11. **Integración de servicios:** Facilita la integración de servicios externos, como sistemas de pago y API de terceros, mediante bibliotecas y herramientas específicas.
12. **Comunidad activa:** Laravel cuenta con una comunidad activa de desarrolladores, una amplia documentación y una gran cantidad de paquetes y extensiones que pueden acelerar el desarrollo de proyectos.
13. Soporte a largo plazo. (LTS)

# Instalación y configuración inicial
1. Descargar e instalar Composer.

3. Descargar e instalar Laravel.
```shell
composer global require laravel/installer
```

3. Crear un proyecto de Laravel utilizando composer.
```bash
composer create-project laravel/laravel nombre_proyecto
```
>commit 1: "Create empty Laravel project"

4. crear un repositorio Git: (opcional pero altamente recomendado)
Modificar el archivo `.env`para adaptarlo a nuestra base de datos.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
```
> commit 2: "Modify .env to connect DB"

5. Crear base de datos vacía con el nombre elegido. En este caso utilizaremos PhpMyAdmin sobre XAMPP.

6. Ejecutar migración de la base de datos. El comando `migrate`se utiliza para crear y actualizar la estructura de la base de datos de la aplicación según las migraciones definidas. Veremos en mayor profundidad las migraciones más adelante; ahora es suficiente saber que este comando crea unas tablas necesarias para la gestión del proyecto (administración de migraciones y sesiones, autenticación...), más allá de las tablas que creemos manualmente en el futuro.
```shell
php artisan migrate
```


# Estructura de un proyecto Laravel

`app`: Contiene la lógica principal de la aplicación, como controladores y modelos
`bootstrap`: Archivos de inicialización y configuración
`config`: Configuración de la aplicación, como bases de datos y servicios
`database`: Migraciones y seeders para gestionar la base de datos
`public`: Recursos estáticos accesibles públicamente, como imágenes y archivos CSS/JS
`resources`: Plantillas de vistas, archivos de idioma y recursos no compilados
`routes`: Definiciones de rutas para manejar las solicitudes entrantes
`storage`: Almacena archivos generados dinámicamente y otros datos
`tests`: Carpeta para escribir pruebas unitarias y de características
`vendor`: Dependencias de terceros gestionadas por Composer
`.env`: Archivo de configuración con variables de entorno específicas
`.env.example`: Ejemplo del archivo .env para configuración inicial

# Eloquent ORM
Eloquent es el ORM (Object Relational Mapping) de Laravel. Nos ayuda a transformar los contenidos de las tablas en objetos.

Ventajas:
- Simplifica el acceso y la manipulación a la BD
- Sintaxis Elegante y Expresiva
- Validación Integrada
- Relaciones Eloquent
- Migraciones (crear y modificar tablas) y Seeders (permiten crear datos nuevos en la tabla)
# Migraciones y Seeders
## Migraciones
Las **migraciones** en Laravel son archivos que permiten definir y gestionar la estructura de la base de datos de manera programática, utilizando código en lugar de realizar cambios directos en la base de datos. Estos archivos describen los cambios en las tablas, índices y restricciones de la base de datos de manera controlada y versionada. Por tanto, facilitan la colaboración en equipo, la reversión de cambios y el despliegue de la base de datos en diferentes entornos

Para crear una migración utilizamos el siguiente comando de artisan:
```shell
php artisan make:migration create_books_table
```
>Commit 3: Create first migration.

Podemos ver la migración creada. Veremos dos funciones: `up()` y `down()`, ya que podemos aplicarlas pero también revertirlas. Podemos añadir valores en la migración y estos se añadirán a la base de datos.

Para ejecutar la migración y poder ver el resultado en nuestra base de datos se ejecuta el comando que utilizamos durante la creación, ya que se usa tanto para la creación como para la actualización de migraciones.
```shell
php artisan migrate
```

Creemos algunas tablas más para este proyecto: *authors*, *loans* y *categories*. Podemos ejecutarlas una vez creadas y modificadas todas a la vez con una sola llamada a `php artisan migrate`.


Crear migraciones para las demás tablas:
```shell
php artisan make:migration create_authors_table
php artisan make:migration create_loans_table
php artisan make:migration create_categories_table
```

Tabla authors:
```php
$table -> string('name');
$table -> string('country');
```

Tabla préstamos:
```php
$table -> date('loan_date');
$table -> date('return_date');
```

Tabla categories:
```php
$table -> string('name');
```

Lanzamos las migraciones con
```shell
php artisan migrate
```
y ya podemos observar las tablas en la base de datos.



## Seeders

Los seeders en Laravel son archivos que se utilizan para poblar la base de datos con datos de prueba o predeterminados. Permiten crear registros de forma automática en las tablas de la base de datos, lo que es útil para llenar la base de datos con datos iniciales necesarios para el desarrollo y las pruebas de la aplicación.
Los seeders se utilizan en conjunto con las migraciones para asegurarse de que la base de datos esté en un estado coherente antes de iniciar las pruebas o el desarrollo de la aplicación.

Creación de seeder:
```shell
php artisan make:seeder BooksTableSeeder
```

En el documento creado, se pueden añadir elementos a la base de datos como en el ejemplo siguiente:
```php
DB::table('books') -> insert([
	'title' => 'El gran Gatsby',
	'published_year' => 1925
]);
```
Importar la clase DB:
```php
use Illuminate\Support\Facades\DB;
```
Tras esto, se indica qué datos queremos introducir de manera manual o aleatoria, como se muestra en la siguiente imagen, y ejecutamos el comando de artisan que hace efectivo el seeder y actualiza la base de datos:
```shell
php artisan db:seed --class=BooksTableSeeder
```

>Commit: Create and execute BookTableSeeder.php

Tras pedir ahora los libros de ejemplo están disponibles en nuestra base de datos.




# Continuar
