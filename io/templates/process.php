<?php 
session_start();
$con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");

if(isset($_POST['login'])){
    if(empty($_POST['uname']) || empty($_POST['pass'])){
        header("location://localhost/io/login.php?Empty= Proszę wypełnić puste pola");
    }else{
        $query = "SELECT * from users WHERE username='".$_POST['uname']."' AND pass='".$_POST['pass']."'";
        $result = mysqli_query($con,$query);
        if(mysqli_fetch_assoc($result)){
            $_SESSION['uname'] = $_POST['uname'];
            header("location://localhost/io/index.php");
        }else{
            header("location://localhost/io/login.php?Invalid= Proszę podać poprawne dane ");
        }
    }
}elseif(isset($_POST['register'])){
    if(empty($_POST['uname']) || empty($_POST['fpass'] || empty($_POST['spass']))){
        header("location://localhost/io/register.php?Empty= Proszę wypełnić puste pola");
    }else{
        $query = "SELECT * from users WHERE username='".$_POST['uname']."'";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        if($row['username'] == $_POST['uname']){
            header("location://localhost/io/register.php?Invalid= Nick już zajęty");
        }elseif($_POST['fpass'] != $_POST['spass']){
            header("location://localhost/io/register.php?Invalidp= Wpisane hasło jest inne");
        }else{
            $sql = "INSERT INTO users (username, pass) VALUES ('".$_POST['uname']."','".$_POST['fpass']."')";
            if(mysqli_query($con, $sql)){
                $_SESSION['uname'] = $_POST['uname'];
                header("location://localhost/io/index.php");
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }
            
        }
    }
}elseif(isset($_POST['book'])){
    if(isset($_SESSION['uname']) && isset($_SESSION['send_id'])){
        // TUTAJ MUSI WEJŚĆ REZERWACJA KSIĄŻKI
        echo "rezerwuję ...";
        $query = "SELECT * FROM `users` WHERE `username` = '".$_SESSION['uname']."'";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $book_id = $_SESSION['send_id'];
        $query = "INSERT INTO `rezerwacje` (`user_id`, `book_id`) VALUES ('".$user_id."', '".$book_id."');";
        $result = mysqli_query($con,$query);
        mysqli_query($con,"UPDATE `ksiazka` SET `stan` = `stan` - 1 WHERE `id` = '".$book_id."'");
        header("location://localhost/io/index.php");
    }else{
        header("location://localhost/io/login.php?Acc= Zaloguj się, aby rezerwować");
    }
}elseif(isset($_POST['delete'])){
    $sql = "DELETE FROM users WHERE username = '".$_SESSION['uname']."'";
    if(mysqli_query($con, $sql)){
        header("location://localhost/io/logout.php?logout");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}elseif(isset($_POST['add_book'])){ //TU SIĘ DZIEJE
    
    if(!empty($_POST['tytul']) && !empty($_POST['autor']) && !empty($_POST['kategoria']) && !empty($_POST['wydawnictwo']) && !empty($_POST['rok']) && !empty($_POST['opis']) && $_POST['rok']>0 && is_numeric($_POST['rok']) && is_numeric($_POST['ocena']) && $_POST['ocena']>=0 && $_POST['ocena']<=10 && is_numeric($_POST['ilosc']) && is_numeric($_POST['stan'])){
        
        $sql = "INSERT INTO ksiazka (`tytul`,`autor`,`kategoria`,`wydawnictwo`,`rok`,`ocena`,`opis`,`ilosc`,`stan`) VALUES ('".$_POST['tytul']."','".$_POST['autor']."','".$_POST['kategoria']."','".$_POST['wydawnictwo']."','".$_POST['rok']."','".$_POST['ocena']."','".$_POST['opis']."','".$_POST['ilosc']."','".$_POST['stan']."' )";
        
        $file_name = $_POST['tytul'].".jpg";
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = "C:/xampp/htdocs/io/img/".$file_name;

        move_uploaded_file($file_tem_loc,$file_store);

        if(mysqli_query($con, $sql)){
            header("location://localhost/io/index.php");
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    
    }else{
        echo "ERROR: Could not able to add book. ";
    }
}elseif(isset($_POST['delete_book'])){
    
    if(isset($_SESSION['send_id'])){
        $sql = "DELETE FROM ksiazka WHERE id = '".$_SESSION['send_id']."' ";
        if(mysqli_query($con, $sql)){
            header("location://localhost/io/index.php");
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    }else{
        echo "ERROR: No book id.";
    }
}elseif(isset($_POST['save_edit_book'])){

    if(!empty($_POST['tytul']) && !empty($_POST['autor']) && !empty($_POST['kategoria']) && !empty($_POST['wydawnictwo']) && !empty($_POST['rok']) && !empty($_POST['opis']) && $_POST['rok']>0 && is_numeric($_POST['rok']) && is_numeric($_POST['ocena']) && $_POST['ocena']>=0 && $_POST['ocena']<=10 && is_numeric($_POST['ilosc']) && is_numeric($_POST['stan']) && isset($_SESSION['send_id'])){
        
        
        
        $con = mysqli_connect('localhost', 'admin', 'admin123', 'libo') or die("could not connect");
        $sql = "UPDATE `ksiazka` SET `tytul`='".$_POST['tytul']."', `autor`='".$_POST['autor']."', `kategoria`='".$_POST['kategoria']."', `wydawnictwo`='".$_POST['wydawnictwo']."', `rok`='".$_POST['rok']."', `ocena`='".$_POST['ocena']."', `opis`='".$_POST['opis']."', `ilosc`='".$_POST['ilosc']."', `stan`='".$_POST['stan']."' WHERE `ksiazka`.`id`='".$_SESSION['send_id']."' ";
        
        
        $file_name = $_POST['tytul'].".jpg";
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = "C:/xampp/htdocs/io/img/".$file_name;

        move_uploaded_file($file_tem_loc,$file_store);

        if(mysqli_query($con, $sql)){
            header("location://localhost/io/index.php");
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    
    }else{
        echo "ERROR: Could not able to edit book. ";
    }

}else{
    header("location://localhost/io/index.php");
}
?>