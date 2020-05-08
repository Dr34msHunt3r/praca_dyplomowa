<?php
if(isset($_SESSION['uname']) == true && $_SESSION['uname'] != 'admin'){ ?>
    <title>Library Online</title>
    <div class="main_menu">
    <div><a>Library Online</a></div>
    <li class="button"><a href="/io/index.php">Strona główna</a></li>
    <li class="button"><a href="/io/help.php">Pomoc</a></li>
    <li class="button"><a href="/io/contact.php">Kontakt</a></li>
    <li class="button"><a href="/io/manage.php">Konto</a></li>
    <li class="button"><a href="logout.php?logout">Wyloguj</a></li>
    <li class="hide"></li>
    </div>
    <div class="search">
    <form action="index.php" method="post">
        <label for="searcher">Szukaj</label>
        <input type="text" id="searcher" name="search" placeholder="szukaj">
        <input class="search_button" type="image" src="/io/img/magnifier.png">
        <a>Witaj <?php echo $_SESSION['uname']; ?></a>
    </form>
    </div>
<?php }elseif(isset($_SESSION['uname']) == true && $_SESSION['uname'] == 'admin'){ ?>
    <title>Library Online</title>
    <div class="main_menu">
    <div><a>Library Online</a></div>
    <li class="button"><a href="/io/index.php">Strona główna</a></li>
    <li class="button"><a href="/io/manage_books.php">Dodaj książki</a></li>
    <li class="button"><a href="/io/manage_users.php">Zarządzaj użytkownikami</a></li>
    <li class="button"><a href="logout.php?logout">Wyloguj</a></li>
    <li class="hide"></li>
    </div>
    <div class="search">
    <form action="index.php" method="post">
        <label for="searcher">Szukaj</label>
        <input type="text" id="searcher" name="search" placeholder="szukaj">
        <input class="search_button" type="image" src="/io/img/magnifier.png">
        <a>Witaj <?php echo $_SESSION['uname']; ?>istratorze</a>
    </form>
    </div>
<?php
}else{ ?>
    <title>Library Online</title>
    <div class="main_menu">
    <div><a>Library Online</a></div>
    <li class="button"><a href="/io/index.php">Strona główna</a></li>
    <li class="button"><a href="/io/help.php">Pomoc</a></li>
    <li class="button"><a href="/io/contact.php">Kontakt</a></li>
    <li class="button"><a href="/io/login.php">Zaloguj</a></li>
    <li class="button"><a href="/io/register.php">Zarejestruj</a></li>
    <li class="hide"></li>
    </div>
    <div class="search">
    <form action="index.php" method="post">
        <label for="searcher">Szukaj</label>
        <input type="text" id="searcher" name="search" placeholder="szukaj">
        <input class="search_button" type="image" src="/io/img/magnifier.png">
    </form>
    </div>
<?php
}
?>