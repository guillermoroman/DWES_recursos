<?php

interface CosaQueSuena {
    public function hacerRuido();
}

//Clase madre
abstract class Vehiculo implements CosaQueSuena{
    public $marca;
    public $modelo;

    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function detalles() {
        return "Marca: " . $this->marca . ", Modelo: " . $this->modelo;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca){
        $this->marca = $marca;
        return $this;
    }

    public function setModelo($modelo){
        $this->modelo = $modelo;
        return $this;
    }

    public function hacerRuido(){
        return "BROOMMM";
    }
}

//Clase hija
class Coche extends Vehiculo {
    public $numeroDePuertas;

    public function __construct($marca, $modelo, $numeroDePuertas) {
        parent::__construct ($marca, $modelo);
        $this->numeroDePuertas = $numeroDePuertas;
    }
}

//Uso de la herencia
//$coche = new Coche("Toyota", "RAV4", 4);
//echo $coche->detalles();

/*
$vehiculoPrueba = new Vehiculo("Honda", "VFR");
echo $vehiculoPrueba->detalles();
echo "<br>";
$vehiculoPrueba
    ->setMarca("BMW")
    ->setModelo("1250GS");

echo $vehiculoPrueba->detalles();

*/
