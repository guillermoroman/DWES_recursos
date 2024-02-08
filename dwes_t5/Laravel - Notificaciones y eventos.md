### 1. Crear la notificación

```shell
php artisan make:notification NewTuit
```

`app/Notifications/NewTuit.php`
```php
use App\Models\Tuit;
use Illuminate\Support\Str;

// Modificar cabecera del constructor
public function __construct(public Chirp $chirp)

// Crear correo
public function toMail(object $notifiable): MailMessage
{
	return (new MailMessage)
	->subject("Nuevo Tuit de {$this->tuit->user->name}")
	->greeting("Nuevo Tuit de {$this->tuit->user->name}")
	->line(Str::limit($this->tuit->message, 50))
	->action('Ir a Tuiter', url('/'))
	->line('Gracias por usar nustra aplicación!');
}

```


### 2. Crear un evento

```shell
php artisan make:event TuitCreated
```

Un evento es una buena forma de vincular comportamientos ya que cada evento puede tener varios listeners sin que estos dependan unos de otros.

Evento disponible en `app/Events/TuitCreated.php`

### Lanzar el evento (dispatch)

Ahora que tenemos la clase evento, podemos dispararlo cada vez que se crea un Tuit. En este caso queremos hacerlo cuando se genera un Tuit, así que lo llamaremos desde el modelo. Para ello, añadimos como atributo el array de eventos que este modelo es capaz de lanzar. En este caso, solo lanza un evento, en el momento que es creado el Tuit.

```php
use App\Events\TuitCreated;
// ...
protected $dispatchesEvents = [
	'created' => TuitCreated::class,
];
```

### Crear un event listener

Ahora que este evento se lanza al crear un Tuit, necesitamos que alguien se mantenga a la escucha, para efectuar una acción cuando se produzca. Para eso usamos un event listener:

```
php artisan make:listener SendTuitCreatedNotifications --event=TuitCreated
```

```php
use App\Models\User;
use App\Notifications\NewTuit;

//Modificamos cabecera para incluir cola
class SendChirpCreatedNotifications implements ShouldQueue

// ...

public function handle(TuitCreated $event): void
{
	foreach (User::whereNot('id', $event->tuit->user_id)->cursor() as $user) {
	$user->notify(new NewTuit($event->tuit));
	}
}

```

Nuestro listener implementa la interfaz ShouldQueue que indica a Laravel que el listener debería funcionar en una cola. Por defecto, esta cola funciona en modo "sync" o síncrono, pero se puede configurar para que sea una cola tradicional y suponga menos carga puntual para el servidor.

Hemos optado por mandar notificaciones a todos los usuarios excepto al autor del Tuit. Sería interesante tener una opción de "Seguir" para limitar mensajes.

También se puede apreciar el uso de un cursor de base de datos, que evita cargar todos los usuarios a la vez para no sobrecargar la memoria de la base de datos.

### Registrar el event listener

Por último, debemos vincular el event listener al evento. Con esto, Laravel sabe que debe invocar al event listener cuando se ejecuta el evento. Para ello utilizamos la clase `EventServiceProvider`:

`App\Providers\EventServiceProvider.php`

```php
use App\Events\TuitCreated;
use App\Listeners\SendTuitCreatedNotifications;

TuitCreated::class => [
	SendTuitCreatedNotifications::class
],
```


### Pruebas

Para realizar pruebas vamos a configurar Laravel para que guarde los correos en el archivo `laravel.log`. Modificamos la variable `MAIL_MAILER` y le damos el valor `log`para que utilice el archivo. Los logs estarán disponibles en `storage/logs/laravel.log`

Podríamos utilizar una herramienta como Mailpit para capturar los correos salientes y verlos. Si se desarrolla la aplicación con Docker y Laravel Sail, Mailpit está incluido. Si no, se puede instalar manualmente.
Mailpit: https://github.com/axllent/mailpit

Más adelante, deberemos conectarnos con un servidor de correo SMTP o un servicio similar como Mailgun, Postmark o Amazon SES, todos soportados por Laravel.