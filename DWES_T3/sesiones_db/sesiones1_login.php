<?php

function conectarBD(){
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    
    try {
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        //echo "Conexión realizada con éxito";
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectando a la base de datos: " . $e->getMessage();
    }
}


function comprobar_usuario ($nombre, $clave){
    $conn = conectarBD();
    $stmt = $conn->prepare("SELECT usuario, rol FROM usuarios WHERE usuario = :nombre AND clave = :clave");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':clave', $clave);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array("nombre" => $row['usuario'], "rol" => $row['rol']);
    } else {
        return FALSE;
    }


/*
    if ($nombre === "usuario" and $clave === "1234"){
        $usu["nombre"] = "usuario";
        $usu["rol"] = 0;
        return $usu;
    } elseif ($nombre === "admin" and $clave === "1234"){
        $usu["nombre"] = "admin";
        $usu["rol"] = 1;
        return $usu;
    } else return FALSE;
    */
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = comprobar_usuario ($_POST["usuario"], $_POST["clave"]);
     if ($usu == FALSE) {
        $err = TRUE;
     } else {
        session_start();
        //Guardamos usuario y rol
        $_SESSION["usuario"] = $usu["nombre"];
        $_SESSION["rol"] = $usu["rol"];
        //$_SESSION["usuario"] = $_POST["usuario"];
        header("Location: sesiones1_principal.php");
     }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <?php
    
    if (isset($err)){
        echo "<p> Revise usuario y contraseña</p>";
    }
    ?>

    <form method = "POST"
    action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for = "usuario">Usuario</label>
		<input value = "<?php if (isset($usuario)) echo $usuario;?>" name = "usuario" type = "text">

        <label for = "clave">Clave</label>
		<input name = "clave" type = "password">
		<input type = "submit">
	</form>
</body>
</html>
