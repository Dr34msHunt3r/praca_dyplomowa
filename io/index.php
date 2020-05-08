<?php
session_start();
$con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");
$sql = "SELECT `id`,`tytul`,`autor`,`ocena` FROM ksiazka ORDER BY id ASC";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/categories.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link rel="icon" href="icon.png">
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="/io/js/scripts.js"></script>
    

</head>

<body style="background-color:#f1f3f7;">
    <header>
        <?php
        require('templates\header.php');
        ?>
    </header>
    
    <div class="flexContainer">
        <div>
            <?php
            require('templates\categories.php');      
            ?>
        </div>
        <div>
            <div class="gallery">
                <?php
                include('templates/dispbook.php');
                ?>
            </div>
        </div>
    </div>
</body>
    <?php
    include('templates/footer.php');
    ?>
</html>