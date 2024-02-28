
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
<form method="POST" action="/path/to/tuits/store">
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
<x-responsive-nav-link :href="route('tuits.index')" :active="request()->routeIs('tuits.index')">
{{ __('Tuits') }}
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
public function tuits(): HasMany
{
	return $this->hasMany(Tuit::class);
}
```

## Protección contra la asignación masiva

Pasar todos los datos de una solicitud a tu modelo puede ser arriesgado. Imagina que tienes una página donde los usuarios pueden editar sus perfiles. Si pasaras toda la solicitud al modelo, un usuario podría editar cualquier columna que desee, como una columna `is_admin`. Esto se conoce como una vulnerabilidad de asignación masiva.

Laravel te protege de hacer esto accidentalmente al bloquear la asignación masiva por defecto. Sin embargo, la asignación masiva es muy conveniente, ya que te evita tener que asignar cada atributo uno por uno. Podemos habilitar la asignación masiva para atributos seguros marcándolos como "fillable" o "rellenables".

Agreguemos la propiedad $fillable a nuestro modelo Tuit para habilitar la asignación masiva para el atributo de mensaje:

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




### Explicación botón delete



# Followers - Nueva funcionalidad

En esta parte vamos a añadir la funcionalidad de seguir a un usuario. El objetivo es que podamos añadir una sección a nuestra web donde cada usuario pueda ver solo tuits de los usuarios a los que sigue. Así mismo solo recibirá notificaciones por correo sobre tuits de los usuarios a los que sigue.

## Migración tabla `followers`

```php
$table->foreignId('followed_id')->constrained('users')->onDelete('cascade');
$table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
```
Es necesario especificar `users` en constrained porque si el campo está en blanco, Laravel buscaría la columna 'id' en la tabla follower o followed respectivamente. De esta forma buscará el id en la tabla indicada : users.

## Relación en el modelo `User`

```php
public function followers()
{
	return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
}
public function following()
{
	return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
}
```

## Evento de nueva publicación
TODO: Enviar mensaje solo a seguidores.


## Enlace en dashboard

Enlace *normal*:
`navigation.blade.php`
```php
<!-- Enlace a lista de tuits de usuarios seguidos -->
<x-nav-link :href="route('tuits.index_followed')" :active="request()->routeIs('tuits.index_followed')">
{{ __('Followed') }}
</x-nav-link>
```

Enlace *responsive*:
`navigation.blade.php`
```php
<!-- Enlace a lista de tuits de usuarios seguidos -->
<x-responsive-nav-link :href="route('tuits.index_followed')" :active="request()->routeIs('tuits.index_followed')">
{{ __('Followed') }}
</x-responsive-nav-link>
```

## Ruta a vista de Followed

```php
Route::get('/tuits/followed', [TuitController::class, 'index_followed'])
	->name('tuits.index_followed')
	->middleware(['auth', 'verified']);
```

## Ruta para registrar un nuevo Follow

```php
Route::post('/follow', [FollowController::class, 'store'])
	->name('follow.store');
```

## Ruta para borrar un Follow existente

```php
Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])
	->name('follow.destroy');
```


## Método `index_followed`en TuitController

El método `index_followed` nos devuelve una vista con una lista de los tuits de los usuarios a los que sigue el usuario actual.

```php
public function index_followed(): View
{
	// Obtener el ID del usuario actual
	$userId = auth()->id();
	
	// Obtener los IDs de los usuarios que el usuario actual sigue
	$followedUsersIds = auth()->user()->following()->pluck('users.id');
	
	// Filtrar los tuits para mostrar solo los de los usuarios seguidos
	$tuits = Tuit::with('user')
		->whereIn('user_id', $followedUsersIds)
		->latest()
		->get();
	
	return view('tuits_followed.index', ['tuits' => $tuits]);
}
```


`->auth()->user()` es un helper de Laravel que obtiene el usuario autenticado actualmente. `auth()` es una fachada que accede al servicio de autenticación de Laravel, y `user()` devuelve la instancia del modelo `User` que representa al usuario autenticado.

El método `pluck`se utiliza en general para extraer un conjunto de valores específicos de una colección. Cuando lo usamos en una consulta de base de datos de Eloquent, nos permite especificar la columna de la cual queremos obtener los valores. En este caso, indicamos que queremos los valores de la columna `id`de la tabla `users`. Normalmente no hace falta especificar la tabla, ya que en el modelo especificamos con quién se tiene la relación, pero en esta relación de muchos a muchos reflexiva, parece exigirlo.

La función `whereIn`de Laravel compara el contenido de la columna que indicamos con el String que se usa como primer parámetro, con el valor contenido en el segundo parámetro.

## Funcionalidad Follow/Unfollow

Queremos añadir la opción de seguir y dejar de seguir a usuarios. Queremos agregar los controles necesarios para seguir y dejar de seguir a un usuario, así como una sección donde se puedan ver solamente los tuits de los usuarios seguidos.

### Controlador `FollowerController`
Creamos un controlador que se ocupe de hacer las modificaciones oportunas en la tabla `followers` y nos devuelve a la página anterior.

```php
public function store(Request $request)
{
	$userToFollow = User::findOrFail($request->user_id);
	auth()->user()->following()->attach($userToFollow); 
	return back();
}

public function destroy(User $user)
{
	auth()->user()->following()->detach($user);
	return back();
}
```

### Agregar rutas

```php
// Ruta para establecer un nuevo Follow
Route::post('/follow', [FollowController::class, 'store'])
	->name('follow.store');

// Ruta para borrar un Follow
Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])
	->name('follow.destroy');
```

#### Ruta para Establecer un Nuevo Follow

- **`Route::post('/follow', ...)`**: Define una ruta que responde a solicitudes HTTP POST. El método POST se utiliza típicamente para crear recursos en el servidor, lo cual tiene sentido en este contexto porque "seguir a un usuario" se puede considerar como la creación de una nueva relación de seguimiento.
  
- **`[FollowController::class, 'store']`**: Especifica que el método `store` del `FollowController` debe manejar las solicitudes a esta ruta. El método `store` en los controladores de Laravel generalmente se usa para manejar la lógica de crear nuevos recursos, en este caso, una nueva relación de seguimiento entre usuarios.
  
- **`->name('follow.store')`**: Asigna un nombre único, `follow.store`, a la ruta. Nombrar las rutas facilita su referencia en otras partes de la aplicación, como en las vistas para generar URLs o en el código del servidor para redirecciones.

#### Ruta para Borrar un Follow

```php
Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])
    ->name('follow.destroy');
```

- **`Route::delete('/unfollow/{user}', ...)`**: Define una ruta que responde a solicitudes HTTP DELETE. El método DELETE se utiliza para eliminar recursos, lo cual es coherente con la acción de "dejar de seguir" a un usuario, considerada como la eliminación de una relación de seguimiento existente.
  
- **`{user}`**: Es un parámetro de ruta que representa el identificador (ID) del usuario a dejar de seguir. Laravel captura este valor y lo pasa al método `destroy` del `FollowController` como un argumento. Esto permite que el método `destroy` sepa qué relación de seguimiento necesita ser eliminada.
  
- **`[FollowController::class, 'destroy']`**: Indica que el método `destroy` del `FollowController` se encargará de las solicitudes a esta ruta. En el contexto de Laravel, `destroy` es comúnmente usado para manejar la eliminación de recursos.
  
- **`->name('follow.destroy')`**: Asigna un nombre único, `follow.destroy`, a la ruta. Al igual que con `follow.store`, nombrar la ruta facilita la referencia a esta en la aplicación.

## Seeders

Se han creado unos seeders para ayudar a probar la aplicación de forma repetida. Hay cuatro usuarios, con 3 tuits cada uno, y cada usuario sigue a otros dos.
### Seeder `UsersTableSeeder.php`

```php
public function run()
{
	$users = [
		['name' => 'u1', 'email' => 'u1@example.com', 'password' => bcrypt('password')],
		['name' => 'u2', 'email' => 'u2@example.com', 'password' => bcrypt('password')],
		['name' => 'u3', 'email' => 'u3@example.com', 'password' => bcrypt('password')],
		['name' => 'u4', 'email' => 'u4@example.com', 'password' => bcrypt('password')], ];
		
	foreach ($users as $user) 
	{
		User::create($user); 
	} 
}
```

Agregar al mismo UsersTableSeeder 
### Seeder `TuitsTableSeeder`

```php
public function run(): void
{
	$users = User::all();
	foreach ($users as $user) {
		for ($i = 1; $i <= 3; $i++) {
		Tuit::create([
		'user_id' => $user->id,
		'message' => "Este es el tuit número $i de {$user->name}"]);
		}
	}
}
```


### Registrar los seeders
Registrar los seeders para su ejecución automática en `DatabaseSeeder.php` con el comando `db:seed`.

```php
public function run()
{
    $this->call([
        UsersTableSeeder::class,
        TuitsTableSeeder::class
    ]);
}
```


## Vista:

`views/tuits/index.blade.php`
`views/tuits_followed/index.blade.php`

TODO: Mostrar los cambios en las vistas.
// TODO: Combinar en una; solo debería cambiar la lista de tuits que se le mandan



>[!Ejercicio]
Agregar Funcionalidad de "Me Gusta" a los Tuits
Objetivo: Implementar una funcionalidad que permita a los usuarios dar "me gusta" a los tuits.
Subtareas:
- Crear una nueva tabla likes que relacione los tuits con los usuarios que les han dado "me gusta".
- Modificar el modelo Tuit para incluir una relación que identifique los "me gusta" que ha recibido.
- Añadir un botón de "me gusta" en la vista de cada tuit y actualizar la vista para mostrar el conteo de "me gusta".
- Crear una acción en un controlador para manejar la lógica de dar/quitar "me gusta".



