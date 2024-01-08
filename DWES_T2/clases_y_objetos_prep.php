<?php
// Clase padre
class Vehiculo {
    public $marca;
    public $modelo;

    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function detalles() {
        return "Marca: " . $this->marca . ", Modelo: " . $this->modelo;
    }
}

// Clase hija
class Coche extends Vehiculo {
    public $numeroDePuertas;

    public function __construct($marca, $modelo, $numeroDePuertas) {
        parent::__construct($marca, $modelo);
        $this->numeroDePuertas = $numeroDePuertas;
    }

    public function detalles() {
        return parent::detalles() . ", Número de puertas: " . $this->numeroDePuertas;
    }
}

// Uso de la herencia
$coche = new Coche("Toyota", "Corolla", 4);
echo $coche->detalles();
?>
