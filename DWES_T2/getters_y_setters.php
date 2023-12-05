<?php
class MiClase {
    private $var1 = "Esto es un atributo privado";

    // Getter
    public function getVar1() {
        return $this->var1;
    }

    // Setter
    public function setVar1($value) {
        $this->var1 = $value;
        return $this;   // Devolvemos el objeto al terminar
    }

    // __toString
    public function __toString() {
        return "MiClase: var1 = " . $this->var1;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hello World!</title>
</head>

<body>
    <h1>Setters & Getters</h1>
    <h2>Uso de getter para ver el valor por defecto del atributo privado</h2>
    <?php
        $objeto1 = new MiClase();
        echo $objeto1;
    ?>
    <h2>Uso de setter para cambiar el valor de un atributo privado</h2>
    <?php
        $objeto1->setVar1("Valor asignado con setter");
        echo $objeto1;
    ?>
    <h2>Leer valor con getter</h2>
    <?php
        echo $objeto1->getVar1();
    ?>

</body>

</html>

