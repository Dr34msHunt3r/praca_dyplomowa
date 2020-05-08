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
                <label for="login">Podaj login:</label>
                <input type="text" id="login" name="uname"><br><br>
                <label for="fpassword">Podaj hasło:</label>
                <input type="password" id="fpassword" name="fpass"><br><br>
                <label for="spassword">Powtórz hasło:</label>
                <input type="password" id="spassword" name="spass"><br><br>
                <input class="sub_button" type="submit" name="register" value="Rejestruj">
                <?php 
                if(isset($_GET['Empty']) == true){
                    echo "<div>".$_GET['Empty']."</div>";
                }elseif(isset($_GET['Invalid']) == true){
                    echo "<div>".$_GET['Invalid']."</div>";
                }elseif(isset($_GET['Invalidp']) == true){
                    echo "<div>".$_GET['Invalidp']."</div>";
                }
                ?>
            </form>
        </div>
    </body>
    <?php
    include('templates/footer.php');
    ?>
</html>