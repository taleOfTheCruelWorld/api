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
    <h1>add apartment</h1>
    <form action="" method="post">
        <label for="">rooms</label>
        <input type="number" name="rooms" value="<?= $apartment['rooms'] ?>">
        <label for="">floor</label>
        <input type="number" name="floor" value="<?= $apartment['floor'] ?>">
        <label for="">price</label>
        <input type="text" name="price" value="<?= $apartment['price'] ?>">
        <label for="">layout</label>
        <select name="layout_id">
            <? foreach ($layouts as $layout): ?>
                <option value="<?= $layout['id'] ?>"><?= $layout['image'] ?></option>
            <? endforeach ?>
        </select>
        <button type="submit">go</button>
    </form>
</body>

</html>