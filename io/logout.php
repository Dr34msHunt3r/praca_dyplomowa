<?php 
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    header("location://localhost/io/index.php");
}else{
    header("location://localhost/io/index.php");
}

?>