# Inertia
https://inertiajs.com
Librería que une el un framework front-end como React o Vue, con un framework back-end como Laravel o Rails.

### Proyecto de muestra: CRM
https://inertiajs.com/demo-application


## Configuración
### Crear nuevo proyecto

```
composer create-project laravel/laravel tuiter
```

### Instalar Laravel Breeze

```
composer require laravel/breeze --dev
php artisan breeze:install react
```

### Arrancar servidor Vite

```
npm run dev
```


## Crear Tuits

### Crear modelos, migraciones y controladores:

```
php artisan make:model -mrc Chirp
```

### Registrar rutas

```
Route::resource('tuits', TuitController::class)
	->only(['index', 'store', 'update', 'destroy'])
	->middleware(['auth', 'verified']);
```

### Método index en controlador. *Inertia*

No cargamos una vista, sino un componente de frontend utilizando Inertia. Inertia es una biblioteca que permite crear aplicaciones de una sola página (SPA) utilizando los lenguajes y marcos de trabajo tradicionales del lado del servidor, como PHP con Laravel, sin necesidad de construir una API. Al trabajar con React, Inertia permite a los desarrolladores utilizar componentes de React en el frontend, mientras manejan las interacciones con el servidor a través de Laravel en el backend.

La principal ventaja de Inertia.js es que te permite aprovechar todo lo que te gusta de trabajar con frameworks como Laravel, incluyendo el enrutamiento, los controladores y la autenticación, mientras disfrutas de los beneficios de una SPA, como la carga de páginas sin recargar y una experiencia de usuario más fluida. Esto se logra gracias a que Inertia proporciona un adaptador entre el backend de Laravel y el frontend de React (o Vue.js, o Svelte si prefieres).



```php
public function index()

{
	return Inertia::render('Tuits/Index', [
		'tuits' => Tuit::with('user:id,name')->latest()->get(),
	]);
}
```

### Creación de Tuits/Index
Creamos la vista junto con un form para crear Tuits en `resources/js/Pages/Tuits/Index.jsx`

### Añadir enlace a menú navegación
Ubicado en `resources/js/Layouts/AuthenticatedLayout.jsx`. Añadir enlaces en el menú normal y el responsivo.

### Añadir método de guardado en controlador

### Crear relación entre User y Tuit
```php
public function tuits(): HasMany

{

return $this->hasMany(Tuit::class);

}
```

### Protección contra asignación masiva en modelo

```php
protected $fillable = [
	'message',
];
```


### Migración

```php
public function up(): void
{
	Schema::create('tuits', function (Blueprint $table) {
	$table->id();
	$table->foreignId('user_id')->constrained()->cascadeOnDelete();
	$table->string('message');
	$table->timestamps();
	});
}
```
### Conectar User a Tuits

En el modelo de Tuit:

```php
public function user(): BelongsTo
{
	return $this->belongsTo(User::class);
}
```

### Componente Tuit
En `resources/js/Components/Tuit.jsx`

1. **Uso de `usePage` y `useForm` de Inertia.js**: 
   - `usePage()` permite acceder a las propiedades pasadas por Inertia desde el servidor, en este caso, la información de autenticación del usuario (`auth`).
   - `useForm()` se utiliza para manejar el formulario de edición del mensaje del tuit, incluyendo el estado del formulario, la gestión de errores, y la funcionalidad para enviar el formulario.

2. **Edición Condicionada**: 
   - El estado `editing` controla si el formulario de edición está visible o no. Esto permite alternar entre mostrar el mensaje del tuit y mostrar un área de texto para editar el mensaje.
   - Si el `id` del usuario del tuit coincide con el `id` del usuario autenticado (`auth.user.id`), se muestra un menú desplegable (`Dropdown`) con opciones para editar o eliminar el tuit.

3. **Interacción con el Formulario**:
   - El formulario de edición se muestra basado en el estado `editing`. Utiliza un área de texto para editar el mensaje, mostrando el valor actual del mensaje en `data.message`.
   - Los cambios en el área de texto se manejan con `setData`, lo cual actualiza el estado del formulario.
   - Al enviar el formulario, se llama a `patch` para enviar una solicitud PATCH al servidor con la ruta `tuits.update` y el `id` del tuit, lo que permite actualizar el mensaje. Si la operación es exitosa, se desactiva el modo de edición.

4. **Mejoras de la UX**:
   - Se proporciona feedback visual sobre errores en la entrada del formulario a través de `InputError`, que muestra mensajes de error relacionados con el campo `message`.
   - Los botones "Save" y "Cancel" permiten guardar los cambios o cancelar la edición, respectivamente. Cancelar restablece el formulario a su estado inicial y limpia los errores.

5. **Presentación**:
   - El componente visualiza información relevante del tuit, como el nombre del usuario, la fecha de creación y si ha sido editado, junto con el mensaje del tuit.
   - Se incluye un icono de tres puntos verticales que actúa como el disparador del `Dropdown` para las opciones de editar y eliminar, visible solo para el usuario que creó el tuit.

En resumen, este componente React facilita la visualización y la edición interactiva de tuits en una aplicación, ofreciendo una experiencia de usuario dinámica y reactiva en línea con las prácticas modernas de desarrollo web.