<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>edit user</h1>
    <form action="" method="post">
        <input type="text" name='login' value="<?=$login?>">
        <input type="text" name='password'>
        <select name="role">
            <option value="admin">admin</option>
            <option value="manager">manager</option>
            <option value="reader">reader</option>
        </select>
        <button type="submit">go</button>
    </form>
</body>

</html>