<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "newsdb");
$sql = "SELECT * FROM `header`";
$headerResult = mysqli_query($conn, $sql);
if(isset($_SESSION['adminid'])){
    header('Location: adminMenu.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настоящая LENTA.ru</title>
</head>

<body>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/style.css">
        <title>Настоящая LENTA.ru</title>
    </head>

    <body>
        <div class="header">
            <header>

                <div class="left">

                    <div>
                        <img src="../img/logo.png" class="respons" alt="">
                        <span class="header_info">Информационное агенство <a href="auth.php">Настоящая LENTA</a></span>
                    </div>


                </div>

            </header>
        </div>
        <div class="menu">

            <?php
            foreach ($headerResult as $headerrow) {
                echo "<ul class='menu'";
                echo "<li><a href='index.php?title=" . $headerrow["title"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
        <div class="content">

            <form method="POST" action="adminMenu.php">
                <h1>Введите данные для авторизации</h1>
                <label class="text-field__label" for="login">Логин</label>
                <p><input type="text" class="text-field__input" name="login"></p>
                <label class="text-field__label" for="password">Пароль</label>
                <p><input type="password" class="text-field__input" name="password"></p>
                <br>
                <p><input type="submit" class="text-field__input" value="Отправить"></p>
            </form>
            
        </div>

    </body>

</html>