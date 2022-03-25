<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "newsdb");
if (!$conn) {
    die("Ошибка:" . mysqli_connect_error());
}
if (isset($_GET["newsid"])) {
    $newsid = $_GET["newsid"]; //Записываем get запрос в переменную
}
if (isset($_GET["title"])) {
    $title = $_GET["title"]; //Записываем get запрос в переменную
}
$sql = "SELECT * FROM `header`";
$headerResult = mysqli_query($conn, $sql);
$newsSelect = "SELECT * FROM `news`";
$newsResult = mysqli_query($conn, $newsSelect);
$newsIdSelect = "SELECT * FROM `news` WHERE id = '$newsid'";
$newsIdResult = mysqli_query($conn, $newsIdSelect);
$newsTitleSelect = "SELECT * FROM `news` WHERE type = '$title'";
$newsTitleSelect = mysqli_query($conn, $newsTitleSelect);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Настоящая LENTA.ru</title>
</head>

<body>
    <div class="header">
        <header>

            <div class="left">

                <div>
                    <img src="img/logo.png" class="respons" alt="">
                    <span class="header_info">Информационное агенство <a href="admin/auth.php">Настоящая LENTA</a></span>
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
            echo "<li><a href='index.php?title=" . $headerrow["title"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>"; //Перебор меню
            //у меню такая же штука с получением запроса только в этот раз у нас будет title и нему мы делаем выборку новостей
        }
        echo "</ul>";
        ?>
    </div>
    <div class="content">

        <div class="cont">

            <?php
            if (isset($_GET['title']) && $_GET['title'] == "Политика") { //Выборка новостей из раздела политика
                if (isset($_GET["newsid"])) { //Если получаем GET запрос newsid то выводим новость в зависимости от Id
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newsLongBlock'>";
                        echo "<img class='newsBigImage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                } else { //Вывод всех новостей
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";
                        //в a href='index.php?newsid' присваиваем get запросу newsid(название может быть любым) значение id новости
                        //на 8-ой строке записываем в переменную с проверкой на сущестование
                        //на 17-ой делаем выборку по id новости
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else if (isset($_GET['title']) && $_GET['title'] == "Экономика") { //Выборка новостей из раздела экономика
                if (isset($_GET["newsid"])) { //Если получаем GET запрос newsid то выводим новость в зависимости от Id
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newsLongBlock'>";
                        echo "<img class='newsBigImage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                } else { //Вывод всех новостей
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";
                        //в a href='index.php?newsid' присваиваем get запросу newsid(название может быть любым) значение id новости
                        //на 8-ой строке записываем в переменную с проверкой на сущестование
                        //на 17-ой делаем выборку по id новости
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else if (isset($_GET['title']) && $_GET['title'] == "Наука") { //Выборка новостей из раздела наука
                if (isset($_GET["newsid"])) { //Если получаем GET запрос newsid то выводим новость в зависимости от Id
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newsLongBlock'>";
                        echo "<img class='newsBigImage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                } else { //Вывод всех новостей
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";
                        //в a href='index.php?newsid' присваиваем get запросу newsid(название может быть любым) значение id новости
                        //на 8-ой строке записываем в переменную с проверкой на сущестование
                        //на 17-ой делаем выборку по id новости
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else if (isset($_GET['title']) && $_GET['title'] == "Общество") { //Выборка новостей из раздела общество
                if (isset($_GET["newsid"])) { //Если получаем GET запрос newsid то выводим новость в зависимости от Id
                    foreach ($newsIdResult as $newsIdRow) { //Вывод всех новостей
                        echo "<div class='newsLongBlock'>";
                        echo "<img class='newsBigImage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                } else { //Вывод всех новостей
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";
                        //в a href='index.php?newsid' присваиваем get запросу newsid(название может быть любым) значение id новости
                        //на 8-ой строке записываем в переменную с проверкой на сущестование
                        //на 17-ой делаем выборку по id новости
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else { //Главная(Выводим из всех разделов)
                if (isset($_GET["newsid"])) {
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newsLongBlock'>";
                        echo "<img class='newsBigImage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                } else {
                    foreach ($newsResult as $newsRow) {
                        echo "<div class='newsBlock'>";
                        echo "<img class='newsImage' src='img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";
                        //в a href='index.php?newsid' присваиваем get запросу newsid(название может быть любым) значение id новости
                        //на 8-ой строке записываем в переменную с проверкой на сущестование
                        //на 17-ой делаем выборку по id новости
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor_name'] .  "</p>";
                        echo "</div>";
                    }
                }
            }



            ?>

        </div>


    </div>
</body>

</html>