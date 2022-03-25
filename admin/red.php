<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "newsdb");
if (isset($_GET["newred"])) {
    $newred = $_GET["newred"];
}
$newsSelect = "SELECT * FROM `news` WHERE id='$newred'";
$newsResult = mysqli_query($conn, $newsSelect);
?>
<!DOCTYPE html>
<html lang="ru">

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
    <div class="conten">
        <div class="cont">
            <form method="POST" enctype="multipart/form-data">
                <?php
                foreach ($newsResult as $newrow) {

                ?>

                    <label class="text-field__label" for="title">Заголовок</label>
                    <?php echo "<p>" . "<input type='text' class='text-field__input' name='title' value='" . $newrow["title"] . "'>" . "<p>"; ?>
                    <label class="text-field__label" for="titleNew">Выберите изображение для статьи</label>
                    <p><input type="file" name="filename" size="10"></p>
                    <label class="text-field__label" for="titleNew">Введите описание статьи</label>
                    <?php echo "<textarea name='longdesc' cols='55' rows='25' class='text-bigfield__label'" . $newrow["longdesc"] .
                        "</textarea>"; ?>
                    <label class="text-field__label" for="titleNew">Введите имя автора</label>
                    <?php echo "<p>" . "<input type='text' class='text-field__input' name='autor_name'
                    value='" . $newrow["autor_name"] . "'>" . "</p>"; ?>
                    <label class="text-field__label" for="titleNew">Введите тип статьи</label>
                    <?php echo "<p>" . "<input type='text' class='text-field__input' name='type'
                    value='" . $newrow["type"] . "'>" . "</p>"; ?>
                    <br>
                    <p><input type="submit" class="text-field__input" value="Отправить"></p>
                <?php
                }
                ?>

            </form>
            <?php
            if (
                isset($_POST["title"]) && isset($_POST["longdesc"])  && isset($_POST["autor_name"])
                && isset($_POST["type"]) && $_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK
            ) {
                $name = $_FILES["filename"]["name"];
                $type = $_FILES["filename"]["type"];
                $path = __DIR__ . "/../" . '/img/';
                move_uploaded_file($_FILES["filename"]["tmp_name"], $path . $name);
                $title = $_POST["title"];
                $longdesc = $_POST["longdesc"];
                $autor_name = $_POST["autor_name"];
                $type = $_POST["type"];
                $newsAdd = "UPDATE `news` SET `title`='$title', `image`='$name', `longdesc`='$longdesc', `date`=NOW(), `autor_name`='$autor_name', `type`='$type' WHERE id ='$newred'";
                if ($conn->query($newsAdd)) {
                    echo "<script>alert(\"Новость изменена\");</script>";
                } else {
                    echo "Ошибка: " . $conn->error;
                }
            } else {
                echo "<script>alert(\"Введите все данные\");</script>";
            }
            ?>
        </div>
    </div>
</body>

</html>