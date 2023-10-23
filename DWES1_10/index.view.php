<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hello World!</title>
</head>

<body>
    <ul>
        <?php foreach ($nuevaLista as $libro): ?>
            <li>
                <a href=<?= $libro['url']; ?>>
                    <?= $libro['titulo']; ?> (<?= $libro['fecha'] ?>), por <?= $libro['autor'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>