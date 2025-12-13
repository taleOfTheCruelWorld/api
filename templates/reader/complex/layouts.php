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

    <h1>layouts of this complex</h1>
    <h1><a href="/complex/<?=$complex_id?>/layouts/create">add layout</a></h1>
    <table>
        <? foreach ($layouts as $layout): ?>
            <tr>
                <td><img src="/storage<?= $layout['image'] ?>" alt=""></td>
                <td><a href="/complex/<?=$complex_id?>/layouts/<?=$layout['id']?>/edit">edit</a></td>
                <td><a href="/complex/<?=$complex_id?>/layouts/<?=$layout['id']?>/delete">delete</a></td>
            </tr>
        <? endforeach ?>
    </table>

</body>

</html>