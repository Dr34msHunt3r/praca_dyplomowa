<?php

// function displaybooks($con, $sql)
// {
    $con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");
    $sql = "SELECT `id`,`tytul`,`autor`,`ocena` FROM ksiazka ORDER BY id ASC";
    if (isset($_POST['book_id'])){
        $searchq = $_POST['book_id'];
        $sql = "SELECT `id`,`tytul`,`autor`,`ocena`,`opis`, `stan` FROM `ksiazka` WHERE `id` = '$searchq'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        if($count == 0){
            echo "0 pasujących wyników";
        }
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $opis = $row["opis"];
            $stan = $row["stan"];
            $rows[] = $row;
            unset($row["id"]);
            unset($row["opis"]);
            unset($row["stan"]);
            echo "<div class='book_box' id='".$id."'>";
            $i = 0;
            foreach ($row as $field => $value) {
                if($i == 0){
                    echo "<img src='/io/img/$value.jpg' alt='image'><br>";
                }
                if ($i < 2) {
                    echo "<a class='at$i'>$value<span class='tooltiptext'>$value</span></a>";
                } else {
                    echo "<a class='at$i'>Ocena: $value/10</a>";
                }
                $i += 1;
            }
            echo "</div>";
            echo "<div class='details'>Opis:<br><br>$opis</div>";
        }
        
        session_start();
        if(isset($_SESSION['uname'])){
            if($_SESSION['uname'] == 'admin'){ //MENU KSIĄŻKI ADMINA
                $_SESSION['send_id'] = $id;
                echo "<form action='/io/manage_books.php' method='post'>
                    <input class='edit_book' type='submit' name='edit_book' value='Edytuj'>
                    </form>
                    <form action='/io/templates/process.php' method='post'>
                    <input class='delete_book' type='submit' name='delete_book' value='Usuń'>
                    </form>"; 
            }elseif($_SESSION['uname'] != 'admin'){
                $sqlq = "SELECT `user_id` FROM `users`WHERE `username` = '".$_SESSION['uname']."' ";
                $result = mysqli_query($con,$sqlq);
                $row = mysqli_fetch_assoc($result);
                $user_id = $row['user_id'];

                $_SESSION['send_id'] = $id;

                $sql = "SELECT `user_id`,`book_id` FROM `rezerwacje` WHERE `user_id` = '$user_id' AND `book_id` = '$id' ";
                $sqll = "SELECT `user_id`,`book_id` FROM `wypozyczone` WHERE `user_id` = '$user_id' AND `book_id` = '$id' ";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                if($stan == 0 || $count != 0 || mysqli_num_rows(mysqli_query($con,$sqll))!=0){
                    echo "<form action='/io/templates/process.php' method='post'>
                    <input class='book_btn' type='submit' name='book' value='Rezerwuj' disabled>
                    </form>";
                }else{
                    echo "<form action='/io/templates/process.php' method='post'>
                    <input class='book_btn' type='submit' name='book' value='Rezerwuj'>
                    </form>";
                }
            }
        }else{

            echo "<form action='/io/templates/process.php' method='post'>
            <input class='book_btn' type='submit' name='book' value='Rezerwuj'>
            </form>";

        }
        
        
    }else{
        if (isset($_POST['search'])) {
            $searchq = $_POST['search'];
            // $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
            $sql = "SELECT `id`,`tytul`,`autor`,`ocena` FROM `ksiazka` WHERE `tytul` LIKE '%$searchq%' OR `autor` LIKE '%$searchq%' OR `wydawnictwo` LIKE '%$searchq%' OR `rok` LIKE '%$searchq%' OR `opis` LIKE '%$searchq%' OR `kategoria` LIKE '%$searchq%' ORDER BY `id` ASC";
        }
        if(isset($_POST['category'])){
            $searchq = $_POST['category'];
            // $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
            $sql = "SELECT `id`,`tytul`,`autor`,`ocena` FROM `ksiazka` WHERE `kategoria` LIKE '%$searchq%' ORDER BY `id` ASC";
        }
        
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        if($count == 0){
            echo "0 pasujących wyników";
        }
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $rows[] = $row;
            unset($row["id"]);
            echo "<div class='book_box' id='".$id."'>";
            $i = 0;
            foreach ($row as $field => $value) {
                if($i == 0){
                    echo "<img src='/io/img/$value.jpg' alt='image'><br>";
                }
                if ($i < 2) {
                    echo "<a class='at$i'>$value<span class='tooltiptext'>$value</span></a>";
                } else {
                    echo "<a class='at$i'>Ocena: $value/10</a>";
                }
                $i += 1;
            }
            echo "</div>";
        }
    }
    mysqli_close($con);
// }