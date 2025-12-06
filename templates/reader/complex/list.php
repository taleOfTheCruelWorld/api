<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>complex</h1>
    <a href="/complex/create">add complex</a>
    <table>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>adress</td>
            <td>latitude</td>
            <td>longitude</td>
            <td>slug</td>
        </tr>
        <? foreach ($complex as $comp): ?>
            <tr>
                <td><?= $comp['id'] ?></td>
                <td><?= $comp['name'] ?></td>
                <td><?= $comp['adress'] ?></td>
                <td><?= $comp['latitude'] ?></td>
                <td><?= $comp['longitude'] ?></td>
                <td><?= $comp['slug'] ?></td>
                <td><a href="/complex/<?= $comp['id'] ?>/edit">edit</a></td>
                <td><a href="/complex/<?= $comp['id'] ?>/delete">delete</a></td>
            </tr>
        <? endforeach ?>
    </table>
</body>

</html>