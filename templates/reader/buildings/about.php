<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    img{
        width: 400px;
        height: 300px;
    }
</style>


<body>
    <h1>apartments of this building</h1>
    <h1><a href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/create">add apartment</a></h1>
    <table>
        <tr>
            <td>id</td>
            <td>rooms</td>
            <td>floor</td>
            <td>price</td>
            <td>layout</td>
        </tr>
        <? foreach ($apartments as $app): ?>
            <tr>
                <td><?= $app['id'] ?></td>
                <td><?= $app['rooms'] ?></td>
                <td><?= $app['floor'] ?></td>
                <td><?= $app['price'] ?></td>
                <td><img src="/storage<?=$app['layout']?>"></td>
                <td><a
                        href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $app['id'] ?>/edit">edit</a>
                </td>
                <td><a
                        href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $app['id'] ?>/delete">delete</a>
                </td>
                <td><a
                        href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $app['id'] ?>/images">images</a>
                </td>
            </tr>
        <? endforeach ?>
    </table>
</body>

</html>