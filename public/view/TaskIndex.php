<!DOCTYPE html>
<html lang="ja">

<head>
    <title>SimpleTODO</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SimpleTODO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./task">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user">User</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Task</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 0 ?>
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <th><?php echo ++$id ?></th>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($task['category_id'] === $category['id']) : ?>
                            <?php if ($task['id'] != @$_SESSION['editId']) : ?>
                                <th><p class="<?php if ($task['status'] == 1) {
                                                        echo 'Achived';
                                                    } else {
                                                        echo 'NotAchived';
                                                    } ?>"><a href="./task/switch?s=<?php echo $task['status'] ?>&id=<?php echo $task['id'] ?>"></a><?php echo $task['content'] ?></p></th>
                                <th><?php echo $category['content'] ?></th>
                                <th><?php echo date('Y/m/d',strtotime($task['date'])) ?></th>
                                <th>
                                    <form method="post" action="./task/delete">
                                        <input type="submit" value="削除">
                                        <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                                    </form>
                                    <form method="post" action="./task/edit">
                                        <input type="submit" value="編集">
                                        <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                                    </form>
                                </th>
                            <?php else : ?>
                                <form method="post" action="./task/update">
                                    <input type="text" name="content" value="<?php echo $task['content'] ?>">
                                    <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                                    <select name="category_id">
                                        <?php foreach ($categories as $category) : ?>
                                            <?php if ($category['id'] === $task['category_id']) : ?>
                                                <option selected value="<?php echo $category['id'] ?>"><?php echo $category['content'] ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $category['id'] ?>"><?php echo $category['content'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                    <input type="submit" value="編集">
                                </form>
                                <form method="post" action="./task/edit/cancel">
                                    <input type="submit" value="キャンセル">
                                </form>
                            <?php endif ?>

                        <?php endif ?>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php foreach ($tasks as $task) : ?>
        <?php foreach ($categories as $category) : ?>
            <?php if ($task['category_id'] === $category['id']) : ?>
                <?php if ($task['id'] != @$_SESSION['editId']) : ?>
                    <a class="task <?php if ($task['status'] == 1) {
                                        echo 'Achived';
                                    } else {
                                        echo 'NotAchived';
                                    } ?>" href="./task/switch?s=<?php echo $task['status'] ?>&id=<?php echo $task['id'] ?>"><?php echo $task['content'], $category['content']; ?></a>
                    <form method="post" action="./task/delete">
                        <input type="submit" value="削除">
                        <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                    </form>
                    <form method="post" action="./task/edit">
                        <input type="submit" value="編集">
                        <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                    </form>
                <?php else : ?>
                    <form method="post" action="./task/update">
                        <input type="text" name="content" value="<?php echo $task['content'] ?>">
                        <input type="hidden" name="param" value="<?php echo $task['id'] ?>">
                        <select name="category_id">
                            <?php foreach ($categories as $category) : ?>
                                <?php if ($category['id'] === $task['category_id']) : ?>
                                    <option selected value="<?php echo $category['id'] ?>"><?php echo $category['content'] ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $category['id'] ?>"><?php echo $category['content'] ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <input type="submit" value="編集">
                    </form>
                    <form method="post" action="./task/edit/cancel">
                        <input type="submit" value="キャンセル">
                    </form>
                <?php endif ?>

            <?php endif ?>
        <?php endforeach ?>
    <?php endforeach ?>
    <form method="post" action="./task/add">
        <input type="text" name="content">
        <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['content'] ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" name="submit" value="追加">
        <p><?php echo @$_SESSION['id'] ?></p>
        <p><?php echo @$_SESSION['name'] ?></p>
</body>

</html>