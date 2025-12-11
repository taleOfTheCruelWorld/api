<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>apartments of this building</h1>
    <table>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>planning date</td>
            <td>floors</td>
        </tr>
        <? foreach ($apartments as $app): ?>
            <tr>
                <td><?= $app['id'] ?></td>
                <td><?= $app['rooms'] ?></td>
                <td><?= $app['floor'] ?></td>
                <td><?= $app['price'] ?></td>
                <td><?= $app['layout'] ?></td>
                <td><a href="/complex/<?= $app['id'] ?>/edit">edit</a></td>
                <td><a href="/complex/<?= $app['id'] ?>/delete">delete</a></td>
            </tr>
        <? endforeach ?>
    </table>
</body>

</html>