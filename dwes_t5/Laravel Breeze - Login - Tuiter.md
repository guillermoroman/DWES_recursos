
## Instalación y Configuración inicial

Instalar breeze y blade
```shell
composer require laravel/breeze --dev
php artisan breeze:install blade
```

Breeze nos proporciona otras plantillas basadas no en blade, sino en Vue y React; dos de los frameworks js más populares. Para ello instalaríamos el front respectivamente con los comandos:

```
php artisan breeze:install vue
php artisan breeze:install react
```

Breeze instalará las dependencias del front-end con estos comandos. Ahoa debemos arrancar el servidor de desarrollo Vite para que recompile de forma automática nuestro CSS y refresque el navegador cuando hagamos cambios a nuestras plantillas Blade:

```shell
npm run dev
```

A continuación, abre otra terminal en el directorio aiz del proyecto `tuiter` e inicializa la base de datos con las migraciones por defecto de Laravel y Breeze:

```
php artisan migrate
```

Si arrancamos la aplicación en el navegador, deberíamos ver un enlace para registrarnos en la parte superior derecha. Podemos utilizar el sistema de registro que proporciona Laravel Breeze.

No olvidemos arrancar nuestro servidor con el comando

```
php artisan serve
```

## Modelos, migraciones y controladores

Para que los usuarios puedan publicar 'tuits', deberemos crear modelos, migraciones y controladores. Podemos utilizar un solo comando para crear un modelo, una migración y un controlador con el siguiente comando:

```
php artisan make:model -mrc Tuit
```

### Rutas
Deberemos crear las rutas para nuestro controlador. Ya que estamos utilizando un controlador de recurso, podemos utilizar una única declaración de tipo `Route::resource()`para definir todas las rutas siguiendo la estructura convencional de URLs para acceso a recursos.

No obstante, solo vamos a permitir dos métodos de momento:
- `index` para mostrar un formulario y una lista de Tuits.
- `store`para guardar nuevos `Tuits`.
Vamos a colocar dos elementos middleware delante de nuestra ruta:
- `auth`para asegurarnos de que solo pueden acceder los usuarios que hayan entrado en la plataforma.
- `verified` que utilizaremos  si decidimos activar la verificación de correo.

|Verbo |URI|Acción |Nombre de ruta |
|---|---|---|---|
|GET|`/tuits` |index|tuits.index |
|POST|`/tuits` |store|tuits.store |

Podemos ver todas nuestras rutas con  el comando `php artisan route:list`.

Comprobemos nuestra ruta devolviendo un mensaje del método index desde nuestra nueva clase `TuitController`:

```php
public function index() : Response
{
	return response ('Hola mundo!');
}
```

Solamente si nos hemos logeado aparecerá el mensaje. De lo contrario nos invitará a logearnos. Esto sucede gracias al middleware `auth`.

### Blade

Actualicemos ahora nuestro método `index`en el `TuitController`para que nos devuelva una vista Blade:


Código para la vista Blade:

```php
<x-app-layout>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

<form method="POST" action="{{ route('tuits.store') }}">

@csrf

<textarea

name="message"

placeholder="{{ __('¿Qué te cuentas?') }}"

class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"

>{{ old('message') }}</textarea>

<x-input-error :messages="$errors->get('message')" class="mt-2" />

<x-primary-button class="mt-4">{{ __('Tuit') }}</x-primary-button>

</form>

</div>

</x-app-layout>
```

Este código utiliza estilos de Tailwind, componentes blade, etc. Una versión simplificada es la siguiente:

```php
<!DOCTYPE html>

<html>

<head>

<title>Formulario de Tuits</title>
</head>
<body>
<div>
<form method="POST" action="/path/to/chirps/store">
<textarea name="message"></textarea>

  

<button type="submit">Tuit</button>

  

</form>

</div>

</body>

</html>
```

Con el código aportado, podemos ver nuestra página para la creación de un Tuit

## Menú de navegación

Añadamos un link al menú de navegación que nos proporciona Breeze.  En el archivo `resources/views/layouts/navigation.blade.php`, añadir el código:

```php
<x-nav-link :href="route('tuits.index')" :active="request()->routeIs('tuits.index')">

{{ __('tuits') }}

</x-nav-link>
```

Y también para pantallas móviles:

```php
<x-responsive-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
{{ __('Chirps') }}
</x-responsive-nav-link>
```

### Guardar el Tuit

Hemos configurado el form para que nos envíe los tuits a la ruta `tuits.store` que creamos previamente. Modifiquemos ahora el `TuitController` para que valide la información y cree un nuevo Tuit:

```php



```

Estamos usando aquí la potente función de validación de Laravel para asegurarnos de que el usuario envía un mensaje y de que este no exceda los 255 caracteres que pone como límite la columna de la base de datos que tenemos.

Después creamos un registro que pertenecerá al usuario registrado sirviéndonos de la relación `tuits`que deberemos de codificar en breve.

Por último, devolvemos un redirect como respuesta para devolver al usuario a la ruta `tuits.index`.

### Crear una relación

En el código anterior vimos que llamamos a un método `tuits` asociado al objeto `$request->user()`. Necesitamos crear este método en nuestro modelo `User`para definir una relación "has many".

```php
public function chirps(): HasMany
{
	return $this->hasMany(Chirp::class);
}
```

## Protección contra la asignación masiva

Pasar todos los datos de una solicitud a tu modelo puede ser arriesgado. Imagina que tienes una página donde los usuarios pueden editar sus perfiles. Si pasaras toda la solicitud al modelo, un usuario podría editar cualquier columna que desee, como una columna `is_admin`. Esto se conoce como una vulnerabilidad de asignación masiva.

Laravel te protege de hacer esto accidentalmente al bloquear la asignación masiva por defecto. Sin embargo, la asignación masiva es muy conveniente, ya que te evita tener que asignar cada atributo uno por uno. Podemos habilitar la asignación masiva para atributos seguros marcándolos como "fillable" o "rellenables".

Agreguemos la propiedad $fillable a nuestro modelo Chirp para habilitar la asignación masiva para el atributo de mensaje:

```php
protected $fillable = [
	'message',
];
```

### Completar la migración

```php
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('message');
```

Ahora podemos enviar un Tuit y verlo en la base de datos


### Artisan Tinker
Artisan Tinker es una herramienta interactiva de línea de comandos incluida en el framework Laravel. Permite a los desarrolladores interactuar con toda la aplicación Laravel desde la línea de comandos, incluyendo el manejo de Eloquent ORM, tareas, eventos y más. Es especialmente útil para experimentar con fragmentos de código y probar funcionalidades de la aplicación de forma rápida.

Podemos utilizar Tinker para ver los Tuits de nuestra base de datos. Para ello arrancamos tinker:

```
php artisan tinker
```

```
App\Models\Tuit::all();
```
