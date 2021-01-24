<?php

session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Strona główna</title>
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
            onclick="window.location.href='zalogowany.php'">
            Strona główna
        </button>

        <button class="nav-dark" onclick="window.location.href='kontakt.php'">
            Kontakt
        </button>

        <button class="nav" onclick="window.location.href='uslugi.php'">
            Przeglądaj Usługi
        </button>
    </div>

    <div class="text">
        <b>Możesz się z nami skontaktować poprzez</b>
        <br /> -nr telefon: 123 456 789
        <br /> -adres e-mail: herkules@detektywi.pl
        <br /> -wiadomość prywatną na stronie
    </div>
</body>
</html>