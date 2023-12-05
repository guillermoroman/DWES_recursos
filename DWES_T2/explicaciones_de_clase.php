<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hello World!</title>
</head>

<body>
    <h1>Números</h1>
    <p>
        <?php
        /////////////
        // Números //
        /////////////
        
        echo PHP_INT_SIZE . '<br>'; // tamaño en bytes
        echo PHP_INT_MIN . '<br>';
        echo PHP_INT_MAX . '<br>';
        $a = 3 / 2; // división de enteros no da problemas
        echo $a . '<br>';
        $b = 7.6;
        $a = (int) $b; // casting a int
        echo $a . '<br>'; // 7 se trunca
        $b = 7e2; // notación científica
        echo $b . '<br>';
        $b = 7E2;
        echo $b . '<br>'; // equivalentes
        ?>
    </p>

    <h1>Cadenas</h1>
    <p>
        <?php
        /////////////
        // Cadenas //
        /////////////
        
        $var = "Paco";
        $a = "Hola $var <br>"; //Comillas mágicas!
        $b = 'Hola $var';
        $c = "<br>"."hola ".$var;
        echo $a;
        echo $b;
        echo $c;
        ?>
    </p>

    <h1>Booleans</h1>
    <p>
        <?php
        //////////////
        // Boleanos //
        //////////////
        
        $a = 23; //true
        $b = 0; //false
        $c = 0.0; //false
        $d = '0';
        $e = 'hola';
        $f = null;
        $g = [];
        $h = ['gominolas', 'chicle'];

        if ($a) {
            echo 'a distinto de 0<br>';
        }
        if (!$b) {
            echo 'b es 0<br>';
        }
        if (!$c) {
            echo 'c es 0<br>';
        }
        if (!$d) {
            echo 'd es string 0<br>';
        }
        if ($e) {
            echo 'e es string hola<br>';
        }
        if (!$f) {
            echo 'f es null<br>';
        }
        if (!$g) {
            echo 'g es un array vacío<br>';
        }
        if ($h) {
            echo 'h es un array no vacío<br>';
        }
        ?>
    </p>

    <h1>Superglobales</h1>
    <p>
        <?php
        ///////////////////
        // Superglobales //
        ///////////////////
        /*
        $GLOBALS        // Variables globales definidas en la aplicación
        $_SERVER        // Información sobre el servidor
        $_GET           //Parámetros enviados con el método GET (en la URL)
        $_POST          //Parámetros enviados con el método POST (formularios)
        $_FILES         //Ficheros subidos al servidor
        $_COOKIE        //Cookies enviadas por el cliente
        $_SESSION       //Información de sesión
        $_REQUEST       //Contiene la información de $_GET, $_POST y $_COOKIE
        $_ENV           //Variables de entorno
        */

        
        echo '<pre>';
        var_dump ($_ENV);
        echo '</pre>';
        

        ?>
    </p>

    <h1>Breaks</h1>
    <?php
    ////////////
    // Breaks //
    ////////////
    
    echo "Sin break: <br>";
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo "i: $i j: $j <br>";
        }
    }

    echo "Primer for anidado: <br>";
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo "i: $i j: $j <br>";
            if ($j == 1) {
                break; //es lo mismo que poner break 1
            }
        }
    }
    echo "Segundo for anidado: <br>";
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo "i: $i j: $j <br>";
            if ($j == 1) {
                break 2;
            }
        }

    }
    ?>

    <h1>Continue</h1>
    
    <p>
        <?php
        
        for ($i = 0; $i < 5; $i = $i + 1) {
            if ($i == 3) {
                continue;
            }
            echo "$i <br>";
        }
        ?>
    </p>
    
    <!--Ejercicio 2.1-->

    <h1>require / include</h1>
    <p>
        <?php
        include "miFichero.php"; // E_NOTICE
        echo "Si ocurre un error NOTICE si se imprime<br>";
        //require "miFichero.php"; // E_FATAL
        //echo "Si ocurre un error fatal no se imprime<br>";

        //Las variables fuera de funciones estarán disponibles

        ?>
    </p>
    
    <h1>Foreach arrays</h1>
    <p>
        <?php
        $arr2 = array(
            "1111A" => "Juan Vera Ochoa",
            "1112A" => "Maria Mesa Cabeza",
            "1113A" => "Ana Puertas Peral"
        );
        foreach ($arr2 as $nombre) {
            echo "$nombre <br>";
        }
        echo "<br>";
        foreach ($arr2 as $codigo => $nombre) {
            echo "Código: $codigo Nombre: $nombre <br>";
        }
        ?>
    </p>

    <h1>Paso de arrays a bucles por referencia para modificar</h1>
    <p>
        <?php
            $arr1 = array (
                "Viernes" => 22,
                "Sábado" => 34
            );

            print_r($arr1);
            echo "<br>";
            //var_dump($arr1);
            //echo "<br>";

            /* no modifica el array */
            foreach ($arr1 as $cantidad) {
                $cantidad = $cantidad * 2;
            }
            print_r($arr1);
            echo "<br>";

            /* modifica el array */
            foreach ($arr1 as &$cantidad) {
                $cantidad = $cantidad * 2;
            }
            print_r($arr1);
        ?>
    </p>
    

    <h1>Paso por referencia a funciones para modificar</h1>
    <p>
        <?php
            function duplicarMal ($a) { //No modifica el valor
                $a = $a *2;
            }
            function duplicar ($a) { //lo devuelve y se modifica en asignación
                return $a *2;
            }
            function duplicar2 (&$a) { //modifica el valor usando referencia
                $a = $a *2;
            }
            $var1 = 5;

            duplicarMal ($var1);
            echo "$var1 <br>";

            $var1 = duplicar ($var1);
            echo "$var1 <br>";

            duplicar2 ($var1);
            echo "$var1 <br>";
        ?>
    </p>

    <h1>Clases y objetos</h1>
    <p>
        <?php
        $arr2 = array(
            "1111A" => "Juan Vera Ochoa",
            "1112A" => "Maria Mesa Cabeza",
            "1113A" => "Ana Puertas Peral"
        );
        foreach ($arr2 as $nombre) {
            echo "$nombre <br>";
        }
        echo "<br>";
        foreach ($arr2 as $codigo => $nombre) {
            echo "Código: $codigo Nombre: $nombre <br>";
        }
        ?>
    </p>


</body>

</html>

