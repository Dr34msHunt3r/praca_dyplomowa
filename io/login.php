<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/logbox.css">
        <link rel="icon" href="icon.png">
    </head>
    <body style="background-color:#f1f3f7;">
        <header>
              <?php require('templates\header.php'); ?>
        </header>
        <div class="log_box">
            <form action="/io/templates/process.php" method="post">
                <label for="login">Login:</label>
                <input type="text" id="uname" name="uname" placeholder=" login"><br><br>
                <label for="password">Hasło:</label>
                <input type="password" id="pass" name="pass" placeholder=" hasło"><br>
                <a href="/io/register.php">Nie masz konta?</a><br><br>
                <input class="sub_button" type="submit" name="login" value="Zaloguj">
            </form>
            <?php 
                if(isset($_GET['Empty']) == true){
                    echo "<div>".$_GET['Empty']."</div>";
                }elseif(isset($_GET['Invalid']) == true){
                    echo "<div>".$_GET['Invalid']."</div>";
                }elseif(isset($_GET['Acc']) == true){
                    echo "<div>".$_GET['Acc']."</div>";
                }
            ?>
        </div>

    </body>
    <?php
    include('templates/footer.php');
    ?>
</html>