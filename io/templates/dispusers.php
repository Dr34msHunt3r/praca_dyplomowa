<?php 
$con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");

if(isset($_POST['rentbookid']) && isset($_POST['rentuserid'])){

    $sql = "DELETE FROM rezerwacje WHERE `user_id`='".$_POST['rentuserid']."' AND `book_id`='".$_POST['rentbookid']."' ";
    $set = "INSERT INTO `wypozyczone` (`user_id`,`book_id`) VALUES ('".$_POST['rentuserid']."','".$_POST['rentbookid']."') ";
    if(mysqli_query($con,$sql) && mysqli_query($con,$set)){
        header("location://localhost/io/templates/dispusers.php?book_rent");
    }else{
        echo "Nie udało się wypożyczyć książki";
    }

}elseif(isset($_POST['bookuserid']) && isset($_POST['bookbookid'])){

    $sql = "DELETE FROM rezerwacje WHERE `user_id`='".$_POST['bookuserid']."' AND `book_id`='".$_POST['bookbookid']."' ";
    $retrive = "UPDATE ksiazka SET `stan`=`stan`+1 WHERE `id`='".$_POST['bookbookid']."' ";
    if(mysqli_query($con,$sql) && mysqli_query($con,$retrive)){
        header("location://localhost/io/templates/dispusers.php?book_retrived");
    }else{
        echo "Nie udało się anulować rezerwacji";
    }

}elseif(isset($_POST['getbackuserid']) && isset($_POST['getbackbookid'])){

    $sql = "DELETE FROM wypozyczone WHERE `user_id`='".$_POST['getbackuserid']."' AND `book_id`='".$_POST['getbackbookid']."' ";
    $retrive = "UPDATE ksiazka SET `stan`=`stan`+1 WHERE `id`='".$_POST['getbackbookid']."' ";
    if(mysqli_query($con,$sql) && mysqli_query($con,$retrive)){
        header("location://localhost/io/templates/dispusers.php?book_retrived");
    }else{
        echo "Nie udało się zwrócić książki";
    }

}elseif(isset($_POST['deleteuserid'])){

    $sql = "DELETE FROM users WHERE `user_id`='".$_POST['deleteuserid']."'";
    $checkr = "SELECT * FROM rezerwacje WHERE `user_id`='".$_POST['deleteuserid']."' ";
    $checkw = "SELECT * FROM wypozyczone WHERE `user_id`='".$_POST['deleteuserid']."' ";
    if(mysqli_query($con,$sql) && mysqli_num_rows(mysqli_query($con,$checkr))==0 && mysqli_num_rows(mysqli_query($con,$checkw))==0){
        header("location://localhost/io/templates/dispusers.php?user_deleted");
    }else{
        echo "Nie udało się usunąć użytkownika";
    }

}else{

    $sql = "SELECT U.username, I.date, K.tytul, I.user_id, I.book_id FROM users U JOIN rezerwacje I ON U.user_id = I.user_id JOIN ksiazka K ON K.id = I.book_id ORDER BY U.username";

    $result = mysqli_query($con,$sql);
    echo "<br><br>Zarezerwowane książki<br><br>";
    $i=1;
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<div class='basket'>
        <a class='title'>$i. ".$row['username']." ".$row['tytul']."</a><a class='date'>".$row['date']."</a>
        <input id='".$row['user_id']."' class='".$row['book_id']."' type='submit' name='rentbook' value='Wypożycz'>
        <input id='".$row['user_id']."' class='".$row['book_id']."' type='submit' name='cancelbook' value='Anuluj'>
        </div>";
        $i+=1;
    }

    $sql = "SELECT U.username, I.date, K.tytul, I.user_id, I.book_id FROM users U
     JOIN wypozyczone I ON U.user_id = I.user_id JOIN ksiazka K ON K.id = I.book_id ORDER BY U.username";

    $result = mysqli_query($con,$sql);
    echo "<br><br>Wypożyczone książki<br><br>";
    $i=1;
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<div class='basket'>
        <a class='title'>$i. ".$row['username']." ".$row['tytul']."</a><a class='date'>".$row['date']."</a>
        <input id='".$row['user_id']."' class='".$row['book_id']."' type='submit' name='getback' value='Anuluj'>
        </div>";
        $i+=1;
    }

    $sql = "SELECT `username`, `user_id` FROM `users`";

    $result = mysqli_query($con,$sql);
    echo "<br><br>Użytkownicy<br><br>";
    $i=1;
    while($row = mysqli_fetch_assoc($result)){
        
        if($row['username'] != 'admin'){
            echo "<div class='basket'>
            <a class='title'>$i. ".$row['username']."</a><a class='date'></a>
            <input id='".$row['user_id']."' class='cancel_btn' type='submit' name='delete_user' value='Usuń'>
            </div>";
            $i+=1;
        }
    }
}
?>