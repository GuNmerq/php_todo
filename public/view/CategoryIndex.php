<!DOCTYPE html>
<html lang="ja">

<head>
    <title>SimpleTODO</title>
    <meta charset="utf-8">
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
                        <a class="nav-link" href="./task">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user">User</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php foreach ($categories as $category) : ?>
        <p>
            <?php echo $category['content'] ?>
        <form method="post" action="./category/delete">
            <input type="submit" value="削除">
            <input type="hidden" name="param" value="<?php echo $category['id'] ?>">
        </form>
        </p>
    <?php endforeach ?>
    <form method="post" action="./category/add">
        <input type="text" name="content">
        <input type="submit" value="追加">
        <p><?php echo @$_SESSION['id'] ?></p>
        <p><?php echo @$_SESSION['name'] ?></p>
</body>

</html>