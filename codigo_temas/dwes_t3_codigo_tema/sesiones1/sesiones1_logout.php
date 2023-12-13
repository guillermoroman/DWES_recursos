
<?php
    session_start(); //unirse a la sesión
    $_SESSION = array(); //limpia las variables de sesión.

    session_destroy(); //eliminar la información asociada con la sesión actual

    //eliminar la cookie sobreescribiendo su contenido con valores arbitrarios.
    setcookie(session_name(), 123, time() - 1000);
    header("Location:sesiones1_login.php");
    
?>
