<?php
session_start();
$con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");

    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/categories.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link rel="stylesheet" type="text/css" href="css/manage_books.css">
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
    <?php if(isset($_POST['edit_book'])){ 
    
        if(isset($_SESSION['send_id'])){
            $sql = "SELECT tytul, autor, kategoria, wydawnictwo, rok, ocena, opis, ilosc, stan FROM ksiazka WHERE id = '".$_SESSION['send_id']."' ";
            if(mysqli_query($con, $sql)){
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result); ?>
                
                <form form action='/io/templates/process.php' method='post' enctype="multipart/form-data">
                    <div class='book_el'>
                        <label for="title">Tytuł:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Tytuł" name="tytul"><?php echo $row['tytul']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="autor">Autor:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Autor" name="autor"><?php echo $row['autor']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="category">Kategoria:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Kategoria" name="kategoria"><?php echo $row['kategoria']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="wydawnictwo">Wydawnictwo:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Wydawnictwo" name="wydawnictwo"><?php echo $row['wydawnictwo']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="year">Rok:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Rok" name="rok"><?php echo $row['rok']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="ocena">Ocena:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Ocena" name="ocena"><?php echo $row['ocena']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="opis">Opis:</label>
                        <textarea id="w3mission" rows="10" cols="50" placeholder="Opis" name="opis"><?php echo $row['opis']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="ilosc">Ilość:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Ilość" name="ilosc"><?php echo $row['ilosc']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label for="stan">Stan:</label>
                        <textarea id="w3mission" rows="1" cols="25" placeholder="Stan" name="stan"><?php echo $row['stan']; ?></textarea>
                    </div>
                    <div class='book_el'>
                        <label>Okładka:</label>
                        <input type="file" name="file"/>
                    </div>
                
                    <input class='save_edit_book' type='submit' name='save_edit_book' value='Zapisz edycję'>
                </form>

            <?php } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }
        }else{
            echo "ERROR: No book id.";
        }
    
    ?>
        
        

    <?php }else{ ?>
    <form form action='/io/templates/process.php' method='post' enctype="multipart/form-data">
        <div class='book_el'>
            <label for="title">Tytuł:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Tytuł" name="tytul"></textarea>
        </div>
        <div class='book_el'>
            <label for="autor">Autor:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Autor" name="autor"></textarea>
        </div>
        <div class='book_el'>
            <label for="category">Kategoria:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Kategoria" name="kategoria"></textarea>
        </div>
        <div class='book_el'>
            <label for="wydawnictwo">Wydawnictwo:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Wydawnictwo" name="wydawnictwo"></textarea>
        </div>
        <div class='book_el'>
            <label for="year">Rok:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Rok" name="rok"></textarea>
        </div>
        <div class='book_el'>
            <label for="ocena">Ocena:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Ocena" name="ocena"></textarea>
        </div>
        <div class='book_el'>
            <label for="opis">Opis:</label>
            <textarea id="w3mission" rows="10" cols="50" placeholder="Opis" name="opis"></textarea>
        </div>
        <div class='book_el'>
            <label for="ilosc">Ilość:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Ilość" name="ilosc"></textarea>
        </div>
        <div class='book_el'>
            <label for="stan">Stan:</label>
            <textarea id="w3mission" rows="1" cols="25" placeholder="Stan" name="stan"></textarea>
        </div>
        <div class='book_el'>
            <label>Okładka:</label>
            <input type="file" name="file"/>
        </div>
    
        <input class='add_book' type='submit' name='add_book' value='Zapisz'>
    </form>
    <?php } ?>

</body>
<?php
    include('templates/footer.php');
    ?>
</html>