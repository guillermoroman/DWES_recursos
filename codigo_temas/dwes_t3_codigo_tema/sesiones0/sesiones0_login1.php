<?php

function comprobar_usuario($nombre, $clave ) {
    if ($nombre === "usuario" and $clave === "1234") {
        $usu["nombre"] = "usuario";
        $usu["rol"] = 0;
        return $usu;
    } elseif ($nombre === "admin"and $clave === "1234") {
        $usu["nombre"] = "admin";
        $usu["rol"] = 1;
        return $usu;
    } else return FALSE;
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
