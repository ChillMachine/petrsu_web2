<?php 
    session_start();

    if (!isset($_SESSION['authorized'])) {
        header( 'Location: login.php', true);
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="center">
        <?php
        if(isset($_FILES['file'])) {
            $fileName = $_FILES['file']['name'];
        
            $uploadDir = 'dir_upload/';
        
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName)) {
                echo "<p>Файл успешно загружен на сервер.</p>
                    <img src=\"$uploadDir$fileName\" />";
            } else {
                echo "<p>Загрузка файла не удалась!</p>";
            }
        ?>
            <div style="display: flex; flex-direction: row;">
                <form action="filter.php" method="post">
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="file" value="<?= $uploadDir.$fileName ?>">
                    <input type="submit" value="Сделать черно-белым" />
                </form>
                <form action="filter.php" method="post">
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="file" value="<?= $uploadDir.$fileName ?>">
                    <input type="submit" value="Сделать негативным" />
                </form>
                <form action="filter.php" method="post">
                    <input type="hidden" name="type" value="3">
                    <input type="hidden" name="file" value="<?= $uploadDir.$fileName ?>">
                    <input type="submit" value="Добавить рельеф" />
                </form>
            </div>

            <form action="index.php"><input type="submit" value="На главную" /></form>
        <?php } ?>
    </div>
</body>
</html>
