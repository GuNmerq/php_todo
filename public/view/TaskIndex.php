<!DOCTYPE html>
<html lang="ja">

<head>
    <title>SimpleTODO</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>SimpleTODO</h1>

    <?php foreach ($tasks as $task) : ?>
        <?php foreach ($categories as $category) : ?>
            <h2>
                <?php if ($task['category_id'] === $category['id']) {
                echo $task['content'],$category['name'];
            }
                ?>
            </h2>
        <?php endforeach ?>
    <?php endforeach ?>
    <form method="post" action="./task/add">
        <input type="text" name="content">
        <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" name="submit" value="追加">
    </form>
</body>

</html>