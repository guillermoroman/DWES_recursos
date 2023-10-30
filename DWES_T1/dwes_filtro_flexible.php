<!--Nuestra primera instrucción en PHP!-->
<!--LC1.1.3-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hello World!</title>
    </head>
    <body>
        <p>
            <?php
            $libros = [
                [
                    "titulo" => "Harry Potter",
                    "autor" => "JK Rowling",
                    "fecha" => "1997",
                    "url" => "http://ejemplo.com"
                ],
                [
                    "titulo" => "The Lord of the Rings",
                    "autor" => "Tolkien",
                    "fecha" => "1953",
                    "url" => "http://ejemplo.com"
                ],
                [
                    "titulo" => "Do Androids dream of Electric Sheep",
                    "autor" => "Pilip K. Dick",
                    "fecha" => "1968",
                    "url" => "http://ejemplo.com"
                ],
                [
                    "titulo" => "The Martian",
                    "autor" => "Andy Weir",
                    "fecha" => "2011",
                    "url" => "http://ejemplo.com"
                ],
                [
                    "titulo" => "Project Hail Mary",
                    "autor" => "Andy Weir",
                    "fecha" => "2021",
                    "url" => "http://ejemplo.com"
                ]
                ];
            
            ?>
        </p>

        <?php
            $filtro = function ($items, $key, $value) {
                $filteredItems = [];

                foreach ($items as $item) {
                    if ($item[$key] === $value) {
                        $filteredItems[] = $item;
                    }
                }
                return $filteredItems;
                var_dump($filteredItems);
            };

            $nuevaLista = $filtro($libros, 'autor', 'Andy Weir');
            var_dump($nuevaLista);
            //$listaNueva = filtrarPorAutor ($libros);
            //var_dump($listaNueva);
        ?>
       
        

        <ul>

            <?php foreach ($filtro($libros, 'autor', 'Andy Weir') as $libro) : ?>
                    <li>
                        <a href= <?= $libro['url'];?>> 
                            <?= $libro['titulo']; ?> (<?= $libro['fecha']?>), por <?= $libro['autor']?>

                        </a>
                    </li>
            <?php endforeach; ?>


        </ul>

          

        
    </body>
</html>

