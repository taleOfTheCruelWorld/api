<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>layouts of this complex</h1>
    <h1><a href="/complex/layouts/add">add layout</a></h1>
    <table>
        <? foreach ($layouts as $layout): ?>
            <tr>
                <td><img src="<?= $layout['image'] ?>" alt=""></td>
                <td><a href="/complex/<?=$complex_id?>/layouts/<?=$layout['id']?>/add"></a></td>
                <a href="/complex/<?$complex_id?>/layouts/<?=$layout['id']?>/delete"></a>
            </tr>
        <? endforeach ?>
    </table>

</body>

</html>