
## Enunciados
### Ejercicio 1: Manipulación de Números

- Crea un script que realice las siguientes operaciones numéricas y muestre los resultados:
  1. Multiplica dos números flotantes.
  2. Encuentra el mayor de tres números enteros (se ofrece solución con una función, pero se podría hacer con condicionales).
  3. Calcula el resto de una división entre dos números (buscar el operador apropiado).

### Ejercicio 2: Trabajo con Cadenas

- Escribe un script PHP que:
  1. Concatena dos cadenas usando el operador `.`.
  2. Convierte una cadena a mayúsculas (buscar un método que realice la operación).
  3. Reemplaza todas las apariciones de "a" por "o" en una cadena (buscar un método que realice la operación).

### Ejercicio 3: Trabajando con Booleanos

- Crea un script que evalúe las siguientes expresiones y muestre "true" o "false" para cada una:
  1. Verifica si un número es positivo.
  2. Determina si una cadena está vacía.
  3. Comprueba si una variable está definida y no es nula.
(en las soluciones se utilizan operadores terciarios, pero no es la única solución)

### Ejercicio 4: Uso de Superglobales

- Escribe un script que muestre información del servidor utilizando la superglobal `$_SERVER`. Muestra el nombre del servidor, el software que está usando y la dirección IP del cliente. 'SERVER_NAME', 'SERVER_SOFTWARE', 'REMOTE_ADDR')

### Ejercicio 5: Control de Flujo con `break` y `continue`

**Enunciado**: 
- Modifica el bucle for anidado para que se detenga completamente cuando `j` sea igual a 1.
```php
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        echo "i: $i j: $j <br>";
    }
}
```
- Escribe un bucle que imprima todos los números del 1 al 10, excepto el número 5.

### Ejercicio 6: Trabajar con Arrays

**Enunciado**: 
- Crea un array asociativo que contenga nombres de estudiantes y sus respectivas notas. Luego, imprime cada nombre con su nota.
- Modifica el array anterior incrementando en 1 cada nota.
- Vuelve a imprimir el array por pantalla.

### Ejercicio 7: Programación Orientada a Objetos

**Enunciado**: 
- Define una clase `Persona` con propiedades para el nombre y la edad, y un método para presentarse (`introduceYourself`). Luego, crea una instancia de esta clase y llama a ese método.



## Soluciones

### Solución 1

```php
<?php
    $num1 = 3.5;
    $num2 = 2.4;
    echo $num1 * $num2 . '<br>';

    $numA = 10;
    $numB = 20;
    $numC = 5;
    echo max($numA, $numB, $numC) . '<br>';

    $dividendo = 15;
    $divisor = 4;
    echo $dividendo % $divisor . '<br>';
?>
```

### Solución 2

```php
<?php
    $str1 = "Hello ";
    $str2 = "World!";
    echo $str1 . $str2 . '<br>';

    $str3 = "hello world";
    echo strtoupper($str3) . '<br>';

    $str4 = "banana";
    echo str_replace("a", "o", $str4) . '<br>';
?>
```

### Solución 3

```php
<?php
    $num = 5;
    echo ($num > 0) ? "true" : "false";
    echo '<br>';

    $str = "";
    echo ($str === "") ? "true" : "false";
    echo '<br>';

    $var;
    echo (isset($var) && $var !== null) ? "true" : "false";
    echo '<br>';
?>
```

### Solución 4

```php
<?php
    echo $_SERVER['SERVER_NAME'] . '<br>';
    echo $_SERVER['SERVER_SOFTWARE'] . '<br>';
    echo $_SERVER['REMOTE_ADDR'] . '<br>';
?>
```

### Solución 5

```php
<?php
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($j == 1) break 2;
            echo "i: $i j: $j <br>";
        }
    }

    for ($i = 1; $i <= 10; $i++) {
        if ($i == 5) continue;
        echo "$i <br>";
    }
?>
```

### Solución 6

```php
<?php
    $estudiantes = [
        "Juan" => 8,
        "Ana" => 7,
        "Carlos" => 9
    ];

    foreach ($estudiantes as $nombre => $nota) {
        echo "Nombre: $nombre, Nota: $nota<br>";
    }

    foreach ($estudiantes as $nombre => &$nota) {
        $nota++;
    }

    foreach ($estudiantes as $nombre => $nota) {
        echo "Nombre: $nombre, Nota: $nota<br>";
    }
?>
```


### Solución 7

**Solución**:
```php
<?php
    class Persona {
        public $nombre;
        public $edad;

        public function __construct($nombre, $edad) {
            $this->nombre = $nombre;
            $this->edad = $edad;
        }

        public function introduceYourself() {
            echo "Hola, mi nombre es " . $this->nombre . " y tengo " . $this->edad . " años.<br>";
        }
    }

    $persona = new Persona("Juan", 25);
    $persona->introduceYourself();
?>
```



