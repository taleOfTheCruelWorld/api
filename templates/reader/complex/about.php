<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>buildings of this complex</h1>
    <h1><a href="/complex/<?=$complex_id?>/buildings/create">add bulding</a></h1>
    <table>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>planning date</td>
            <td>floors</td>
        </tr>
        <? foreach ($buildings as $build): ?>
            <tr>
                <td><?= $build['id'] ?></td>
                <td><?= $build['name'] ?></td>
                <td><?= $build['planning_date'] ?></td>
                <td><?= $build['floors'] ?></td>
                <td><a href="/complex/<?= $complex_id ?>/buildings/<?=$build['id']?>/edit">edit</a></td>
                <td><a href="/complex/<?= $complex_id ?>/buildings/<?=$build['id']?>/delete">delete</a></td>
                <td><a href="/complex/<?=$complex_id?>/buildings/<?=$build['id']?>/apartments">apartments of this building</a></td>
            </tr>
        <? endforeach ?>
    </table>
</body>
</html>