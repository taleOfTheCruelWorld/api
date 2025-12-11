<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>edit complex</h1>
    <form action="" method="post">
        <label for="">name</label>
        <input type="text" name="name" value="<?= $building['name'] ?>">
        <label for="">planning date</label>
        <input type="date" name="planning_date" value="<?= $building['planning_date'] ?>">
        <label for="">floors</label>
        <input type="number" name="floors" value="<?= $building['floors'] ?>">
        <button type="submit">go</button>
    </form>
</body>

</html>