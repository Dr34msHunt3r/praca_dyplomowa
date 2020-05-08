<?php 
$con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");

if(isset($_POST['button_id'])){

    session_start();
    $sql = "SELECT `user_id` FROM `users`WHERE `username` = '".$_SESSION['uname']."' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    $result = mysqli_query($con, "SELECT id FROM ksiazka WHERE tytul = '".$_POST['button_id']."' ");
    $row = mysqli_fetch_assoc($result);
    $book_id = $row['id'];
    if(mysqli_query($con,"DELETE FROM rezerwacje WHERE `user_id` = '".$user_id."' AND book_id = '".$book_id."' ") && mysqli_query($con,"UPDATE `ksiazka` SET `stan` = `stan` + 1 WHERE `id` = '".$book_id."'")){
        
    $sql = "SELECT `user_id` FROM `users`WHERE `username` = '".$_SESSION['uname']."' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    $sql = "SELECT t1.user_id, t1.date, t2.tytul FROM rezerwacje AS t1 LEFT JOIN ksiazka AS t2 ON t1.book_id = t2.id WHERE t1.user_id = '".$user_id."'";
    $result = mysqli_query($con,$sql);
    $i=1;
    $zarezerwowane = mysqli_num_rows($result);
    echo "<div class='flexContainer'>
    <div class='container'>
    Zarezerwowane:";
        if($zarezerwowane == 0){
            echo "<div class='basket'>
            <a class='title'>Aktualnie nie masz zarezerwowanych książek</a><a class='date'></a>
            </div>";
        }else{
            while($row = mysqli_fetch_assoc($result)){
        
                echo "<div class='basket'>
                <a class='title'>$i. ".$row['tytul']."</a><a class='date'> ".$row['date']."</a>
                <input id='".$row['tytul']."' class='cancel_btn' type='submit' name='cancel' value='Anuluj'>
                </div>";
                $i+=1;
            }
        }
    $sql = "SELECT t1.user_id, t1.date, t2.tytul FROM wypozyczone AS t1 LEFT JOIN ksiazka AS t2 ON t1.book_id = t2.id WHERE t1.user_id = '".$user_id."'";
    $result = mysqli_query($con,$sql);
    $i=1;
    $wypozyczone = mysqli_num_rows($result);
    echo "Wypożyczone:";       
    if($wypozyczone == 0){
        echo "<div class='basket'>
        <a class='title'>Aktualnie nie masz wypożyczonych książek</a><a class='date'></a>
        </div>";
           
    }else{
        while($row = mysqli_fetch_assoc($result)){
    
            echo "<div class='basket'>
            <a class='title'>$i. ".$row['tytul']."</a><a class='date'> ".$row['date']."</a>
            </div>";
            $i+=1;
            
        }
        
    }

    }else{
        echo "ERROR: Could not able to execute. " . mysqli_error($con);
    }
    if($_SESSION['uname'] != 'admin'){
        if($zarezerwowane != 0 || $wypozyczone != 0){
            echo "</div><div class='container'>
            <div class='description'>Jeśli nie jesteś dłużej zainteresowany/a bezpłatnymi usługami tej strony możesz usunąć konto jednym kliknięciem.</div>
            <form action='/io/templates/process.php' method='post'>
                <input class='sub_button' type='submit' name='delete' value='Usuń konto' disabled>
            </form>
            </div>";
        }else{
            echo "</div><div class='container'>
            <div class='description'>Jeśli nie jesteś dłużej zainteresowany/a bezpłatnymi usługami tej strony możesz usunąć konto jednym kliknięciem.</div>
            <form action='/io/templates/process.php' method='post'>
                <input class='sub_button' type='submit' name='delete' value='Usuń konto'>
            </form>
            </div>";
        }
    }
    

}else{
    
    $sql = "SELECT `user_id` FROM `users`WHERE `username` = '".$_SESSION['uname']."' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    $sql = "SELECT t1.user_id, t1.date, t2.tytul  FROM rezerwacje AS t1 LEFT JOIN ksiazka AS t2 ON t1.book_id = t2.id WHERE t1.user_id = '".$user_id."'";
    $result = mysqli_query($con,$sql);
    $i=1;
    $zarezerwowane = mysqli_num_rows($result);
    echo "<div class='flexContainer'>
        <div class='container'>
        Zarezerwowane:";
        if($zarezerwowane == 0){
            echo "<div class='basket'>
                <a class='title'>Aktualnie nie masz zarezerwowanych książek</a><a class='date'></a>
                </div>";
        }else{
            while($row = mysqli_fetch_assoc($result)){
        
                echo "<div class='basket'>
                <a class='title'>$i. ".$row['tytul']."</a><a class='date'> ".$row['date']."</a>
                <input id='".$row['tytul']."' class='cancel_btn' type='submit' name='cancel' value='Anuluj'>
                </div>";
                $i+=1;
            }
        }
        $sql = "SELECT t1.user_id, t1.date, t2.tytul FROM wypozyczone AS t1 LEFT JOIN ksiazka AS t2 ON t1.book_id = t2.id WHERE t1.user_id = '".$user_id."'";
    $result = mysqli_query($con,$sql);
    $i=1;
    $wypozyczone = mysqli_num_rows($result);
    echo "Wypożyczone:";       
    if($wypozyczone == 0){
        echo "<div class='basket'>
        <a class='title'>Aktualnie nie masz wypożyczonych książek</a><a class='date'></a>
        </div>";
            
    }else{
        while($row = mysqli_fetch_assoc($result)){
    
            echo "<div class='basket'>
            <a class='title'>$i. ".$row['tytul']."</a><a class='date'> ".$row['date']."</a>
            </div>";
            $i+=1;
            
        }
        
        
    }
    if($_SESSION['uname'] != 'admin'){
        if($zarezerwowane != 0 || $wypozyczone != 0){
            echo "</div><div class='container'>
            <div class='description'>Jeśli nie jesteś dłużej zainteresowany/a bezpłatnymi usługami tej strony możesz usunąć konto jednym kliknięciem.</div>
            <form action='/io/templates/process.php' method='post'>
                <input class='sub_button' type='submit' name='delete' value='Usuń konto' disabled>
            </form>
            </div>";
        }else{
            echo "</div><div class='container'>
            <div class='description'>Jeśli nie jesteś dłużej zainteresowany/a bezpłatnymi usługami tej strony możesz usunąć konto jednym kliknięciem.</div>
            <form action='/io/templates/process.php' method='post'>
                <input class='sub_button' type='submit' name='delete' value='Usuń konto'>
            </form>
            </div>";
        }
    
    }
}
    



?>