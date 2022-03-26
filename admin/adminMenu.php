<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "newsdb");
$sql = "SELECT * FROM `adminheader`";
$headerResult = mysqli_query($conn, $sql);
$newsSelect = "SELECT * FROM `news`";

$newsResult = mysqli_query($conn, $newsSelect);
?>
<?php
if (isset($_POST["login"]) && isset($_POST["password"]) && !isset($_SESSION["adminid"])) {
    $login = $_POST["login"];
    $auth = "SELECT * FROM `admins` WHERE login='$login'";
    $authResult = mysqli_query($conn, $auth);
    $authAssoc = mysqli_fetch_assoc($authResult);
    if (!empty($authAssoc)) {
        $hash = $authAssoc['password'];
        if (password_verify($_POST['password'], $hash)) {
            $adminid = $authAssoc['id'];
            $adminlogin = $authAssoc['login'];
            $_SESSION["login"] = $adminlogin;
            $_SESSION["adminid"] = $adminid;
            echo "Авторизация успешна";
        } else {
            echo "Пароль неверный";
        }
    } else {
        echo "Админа с таким логином не существует(";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <?php
                        if (isset($_SESSION["adminid"])) {
                            $currentID = $_SESSION["adminid"];
                            $loginSelect = "SELECT login FROM `admins` WHERE id = '$currentID'";
                            $loginResult = mysqli_query($conn, $loginSelect);
                            $loginFetch = mysqli_fetch_array($loginResult);
                            echo "<div class='login'>";
                            echo "Привет, " . $loginFetch['login'];
                            echo "<a href='exit.php'>" . " Выйти?" . "</a>";
                            echo "</div>";
                        }
                        ?>
                    </div>


                </div>

            </header>
        </div>
        <div class="menu">

            <?php
            foreach ($headerResult as $headerrow) {
                echo "<ul class='menu'";
                echo "<li><a href='adminMenu.php?title=" . $headerrow["id"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";

            }
            echo "<li>" . "<a href='../index.php'>" . "Назад" . "</a>" ."</li>";
            echo "</ul>";
            ?>
        </div>
        <div class="content">

            <div class="cont">

                <?php

                if (isset($_GET['title']) && $_GET['title'] == 1) {
                ?>
                    <form method="POST" enctype="multipart/form-data">
                        <h1>Заполните все поля</h1>
                        <label class="text-field__label" for="title">Заголовок</label>
                        <p><input type="text" class="text-field__input" name="title"></p>
                        <label class="text-field__label" for="titleNew">Выберите изображение для статьи</label>
                        <p><input type="file" name="filename" size="10"></p>
                        <label class="text-field__label" for="titleNew">Введите короткое описание статьи</label>
                        <textarea name="shortdesc" cols="25" rows="5" class="text-bigfield__label"></textarea>
                        <label class="text-field__label" for="titleNew">Введите описание статьи</label>
                        <textarea name="longdesc" cols="55" rows="25" class="text-bigfield__label"></textarea>
                        <label class="text-field__label" for="titleNew">Введите тип статьи</label>
                        <p><input type="text" class="text-field__input" name="type"></p>
                        <br>
                        <p><input type="submit" class="text-field__input" value="Отправить"></p>
                    </form>
                    <?php
                    if (
                        isset($_POST["title"]) && isset($_POST["longdesc"]) && isset($_POST["shortdesc"])
                        && isset($_POST["type"]) && $_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK
                    ) {
                        $name = $_FILES["filename"]["name"];
                        $type = $_FILES["filename"]["type"];
                        $path = __DIR__ . "/../" . '/img/';
                        move_uploaded_file($_FILES["filename"]["tmp_name"], $path . $name);
                        $title = $_POST["title"];
                        $longdesc = $_POST["longdesc"];
                        $currentID = $_SESSION["adminid"];
                        $loginSelect = "SELECT login FROM `admins` WHERE id = '$currentID'";
                        $loginResult = mysqli_query($conn, $loginSelect);
                        $loginFetch = mysqli_fetch_array($loginResult);
                        $autor = $loginFetch['login'];
                        $type = $_POST["type"];
                        $shortdesc = $_POST["shortdesc"];
                        $newsAdd = "INSERT INTO `news` (`title`, `image`, `longdesc`, `date`, `autor_name`, `type`, `shortdesc`)
                        VALUES ('$title', '$name', '$longdesc', NOW(),'$autor', '$type', '$shortdesc')";
                        if ($conn->query($newsAdd)) {
                            echo "<script>alert(\"Новость добавлена\");</script>";
                        } else {
                            echo "Ошибка: " . $conn->error;
                        }
                    } else {
                        echo "<script>alert(\"Введите все данные\");</script>";
                    }


                    ?>
                <?php

                } else if (isset($_GET['title']) && $_GET['title'] == 2) {
                    foreach ($newsResult as $newsRow) {

                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='../img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsRow['shortdesc'] .  "</p>";
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor_name'] .  "</p>";

                        echo "<form method='GET' action='red.php'>
                            <input type='hidden' name='newred' value='" . $newsRow["id"] . "'/>
                            <input type='submit' class='text-field__input' value='Редактировать'>
                        </form>";

                        echo "</div>";
                    }
                ?>
                    <?php
                    if (isset($_GET['newred'])) {
                        $newid = mysqli_real_escape_string($conn, $_GET['new']);
                        $deleteNews = "DELETE FROM `news` WHERE id = '$newid'";
                        if (mysqli_query($conn, $deleteNews)) {
                            echo "<script>alert(\"Новость удалена\");</script>";
                        } else {
                            echo "Ошибка: " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }
                    ?>
                <?php
                } else if (isset($_GET['title']) && $_GET['title'] == 3) {
                    foreach ($newsResult as $newsRow) {

                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='../img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsRow['shortdesc'] .  "</p>";
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor_name'] .  "</p>";

                        echo "<form method='GET'>
                            <input type='hidden' name='new' value='" . $newsRow["id"] . "'/>
                            <input type='submit' class='text-field__input' value='Удалить'>
                        </form>";

                        echo "</div>";
                    }
                ?>
                <?php
                    if (isset($_GET['new'])) {
                        $newid = mysqli_real_escape_string($conn, $_GET['new']);
                        $deleteNews = "DELETE FROM `news` WHERE id = '$newid'";
                        if (mysqli_query($conn, $deleteNews)) {
                            echo "<script>alert(\"Новость удалена\");</script>";
                        } else {
                            echo "Ошибка: " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }
                }
                ?>
                <?php
                if (isset($_GET['title']) && $_GET['title'] == 4) {
                ?>
                    <form method="POST">
                        <h1>Заполните все поля</h1>
                        <label class="text-field__label" for="title">Логин</label>
                        <p><input type="text" class="text-field__input" name="login"></p>
                        <label class="text-field__label" for="titleNew">Пароль</label>
                        <p><input type="text" class="text-field__input" name="password"></p>
                        <label class="text-field__label" for="titleNew">Почта</label>
                        <p><input type="text" class="text-field__input" name="email"></p>
                        <br>
                        <p><input type="submit" class="text-field__input" value="Отправить"></p>
                    </form>
                <?php
                }
                if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["email"])) {
                    $login = $_POST["login"];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $email = $_POST["email"];
                    $userReg = "INSERT INTO `admins` (`login`, `password`, `email`) VALUES ('$login', '$password', '$email')";
                    if ($conn->query($userReg)) {
                        echo "<p>" . "Регистрация прошла успешно" . "</p>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                }

                ?>
               

            </div>


        </div>

    </body>

</html>