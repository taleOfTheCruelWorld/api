<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>users</h1>
    <a href="/admin/users/new-user">new user</a>
    <table>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>role</td>
        </tr>
        <? foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['login'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><a href="/admin/users/<?= $user['id'] ?>/edit">edit</a></td>
                <td><a href="/admin/users/<?= $user['id'] ?>/delete">delete</a></td>
            </tr>
        <? endforeach ?>
    </table>
</body>

</html>