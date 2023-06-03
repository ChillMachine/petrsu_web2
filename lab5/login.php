<?php
    session_start();
    $username = 'user';
    $password = 'qwerty';
    
    if (isset($_POST['user']) && isset($_POST['pass'])){
        if (($_POST['user'] === $username) && ($_POST['pass'] === $password)){
            $_SESSION['authorized'] = true;
            $_SESSION['user'] = $_POST['user'];
        }
    }

    if (isset($_POST['logout'])) {
        unset($_SESSION['authorized']);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php if (isset($_SESSION['authorized'])) { ?>
        <div class="center">
            <form action="upload.php" enctype="multipart/form-data" method="post">
                Файл:<br><input type="file" name="file"><br>
                <input type="submit" value="Загрузить"><br>
            </form>
            <form method="POST"><input name="logout" type="submit" value="Выйти" /></form>
        </div>
    <?php } else { ?>
    <form class="center" method="POST">
        <label for="user">Логин:</label><input name="user" id="user" type="text">
        <label for="pass">Пароль:</label><input name="pass" id="pass" type="password">
        <input type="submit" value="Войти">
    </form>
    <?php } ?>
</body>
</html>