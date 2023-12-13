<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
    
</head>
<body>

<?php
if(!isset($_COOKIE['visitas'])){
    $visitas = 1;
} else {
    $visitas = (int) $_COOKIE['visitas'];
    $visitas++;

}
setcookie('visitas', $visitas, time() + 3600 * 24);
?>

<?php print_r($_COOKIE) ?>
<h1>Bienvenido!</h1>
 
        <!-- Formulario con un botón para borrar cookies -->
    <form method="post">
        <button type="submit" name="borrarCookies">Borrar cookies</button>
    </form>
 
    <?php
        // Verificar si se ha enviado la solicitud POST desde el formulario
        if (isset($_POST["borrarCookies"])) {
            // Eliminar la cookie "visitas" estableciendo su tiempo de expiración en el pasado
            setcookie("visitas", "", time() - 3600);
           
            // Recargar la página para reflejar el cambio en las cookies
            header("Refresh:0");
        }
    ?>
</body>
</html>
