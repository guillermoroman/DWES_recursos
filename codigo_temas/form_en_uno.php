<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["usuario"] == "usuario" and $_POST["clave"] == "1234") {
        header("Location:bienvenido.html");
    } else {
        $usuario = $_POST["usuario"];
        $err = true;
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
