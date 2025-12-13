<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    img {
        width: 400px;
        height: 300px;
    }
</style>

<body>

    <h1>images of this apartment</h1>
    <h1><a href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $apartment_id ?>/images/create">add image</a></h1>
    <table>
        <? foreach ($images as $img): ?>
            <tr>
                <td><img src="/storage<?= $img['image'] ?>" alt=""></td>
                <td><a
                        href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $apartment_id ?>/images/<?= $img['id'] ?>/edit">edit</a>
                </td>
                <td><a
                        href="/complex/<?= $complex_id ?>/buildings/<?= $building_id ?>/apartments/<?= $apartment_id ?>/images/<?= $img['id'] ?>/delete">delete</a>
                </td>

            </tr>
        <? endforeach ?>
    </table>

</body>

</html>