<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hello World!</title>
</head>

<body>
    <?php

    echo "<h1>Métodos estáticos</h1>";

    interface Bicho {
        public function emitirSonido();
    }
    abstract class Animal implements Bicho{
        protected $patas;
        private $cola;

        public function __construct($patas, $cola) {
            $this->patas = $patas;
            $this->cola = $cola;
        }

        public static function metodoEstatico() {
            echo "Los animales son seres vivos";
        }

        public function getCola() {
            return $this->cola;
        }

        public function getPatas() {
            return $this->patas;
        }
        
        public function setPatas($patas){
            $this->patas = $patas;
        }

        public function setCola($cola){
            $this->cola = $cola;
        }

        public function emitirSonido(){
            echo "??????";
        }
    }

    class Dog extends Animal {
        private $orejas = 2;

        public function emitirSonido(){
            echo "guau guau";
        }
    }

    $perro = new Dog(4, true);
    $perro->setCola(false);
    if ($perro->getCola() == true) {
        echo "tiene cola";
    } else {
        echo "no tiene cola";
    }
    echo "<br>";

    $perro->emitirSonido();

    $perro = new Dog(4, true);
    echo "<br>";
    $perro->emitirSonido();
    echo "<br>";
    echo "<br>";
    $perro->metodoEstatico();
    

    ?>
</body>
</html>