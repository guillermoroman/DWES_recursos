<?php
$cadena_conexion = 'mysql:dbname=classicmodels;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try{
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexión realizada con éxito" . "<br>";

    $preparada = $bd->prepare("select customerName from customers where country = ?");
 
    $preparada->execute(array("USA"));

    echo "Clientes de USA: " . $preparada->rowCount() ."<br>";

    foreach($preparada as $usu) {
        //print_r($usu);
        print "Cliente: " . $usu["customerName"] . "<br>";
    }

}
catch(PDOException $e) {
    echo 'Error conectando a la base de datos: '. $e->getMessage();
}
