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

$nuevaLista = array_filter($libros, function ($libro) {
    return $libro['autor'] === 'Andy Weir';
});

require "index.view.php";
