
<?php
/* formulario de login habitual
Si los datos son correctos, guarda el nombre de usuario y redirige a principal.php
Si los datos son incorrectos, imprime un mensaje de error*/

function conectarBD(){
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";

    try {
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectando a la bd: " . $e->getMessage();
    }
}


function comprobar_usuario ($nombre, $clave) {
    $conn = conectarBD();
    $consulta = $conn->query("SELECT usuario, rol FROM usuarios WHERE usuario = '$nombre' AND clave = '$clave'");
    //$consulta = $conn->prepare("SELECT usuario, rol FROM usuarios WHERE usuario = $nombre AND clave = $clave");
    //$consulta->bindParam

    //$consulta->execute();

    if ($consulta->rowCount() > 0) {
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return array("nombre" => $row["usuario"], "rol" => $row["rol"]);
    } else {
        return FALSE;
    }

/*
    if ($nombre === "usuario" and $clave === "1234") {
        $usu["nombre"] = "usuario";
        $usu["rol"] = 0;
        return $usu;
    } elseif ($nombre === "admin"and $clave === "1234") {
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
        $usuario = $_POST["usuario"];
     } else {
        session_start();
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Location: sesiones1_principal.php");
     }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulario de login</title>
</head>

<body>
    <?php
        if (isset($_GET["redigrigido"])){
            echo "<p>Log in para continuar.<p>";
        }
    ?>
    <?php
        if (isset($err) and $err == true){
            echo "<p>Revise usuario y contraseña.<p>";
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