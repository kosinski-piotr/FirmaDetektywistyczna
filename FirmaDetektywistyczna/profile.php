<?php

session_start();
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style type="text/css">
       .nav {
            width:50%;
        }
    </style>
</head>
<body>
    <div class="user-container">
        <a class="user-link" href="profile.php">
            <?php
            echo "<p>Zalogowany jako ".$_SESSION['Imie'].' '.$_SESSION['Nazwisko'];
            ?>
        </a>
    </div>
    <div class="top">
        <div class="name">Herkules!</div>

        <div class="space"></div>

        <div class="envelope-container">
            <img src="images/Envelope-icon.png" alt="koperta" class="envelope" />
        </div>

        <form action="logout.php" method="get">
            <input class="button " type="submit" value="Wyloguj się" />
        </form>
    </div>

    <div class="navbar">
        <button
            class="nav"
            onclick="window.location.href='modyfikuj.php'">
            Modyfikuj dane
        </button>
        <button
            class="nav"
            onclick="window.location.href='wykupione.php'">
            Przeglądaj wykupione usługi
        </button>
    </div>

    <div class="text">
        <button
            onclick="window.location.href='zalogowany.php'">
            Strona główna
        </button>
    </div>
    <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>