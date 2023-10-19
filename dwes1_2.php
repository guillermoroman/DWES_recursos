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
                ]
                ];
            
            //var_dump($libros);
            echo "<br>";
            //var_dump($libros2);
            echo "<br>";

            ?>
        </p>
        
        <ul>

            <?php foreach ($libros as $libro) : ?>
                <?php if ($libro['autor'] = 'Andy Weir') : ?>
                    <li>
                        <a href= <?= $libro['url'];?>> 
                            <?= $libro['titulo']; ?> (<?= $libro['fecha']?>)

                        </a>
                        
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        

        
    </body>
</html>

