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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dane do Przelewu</title>
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    <div class="name">Herkules</div>

    <div class="space"></div>

    <div class="envelope-container">
        <img src="images/Envelope-icon.png" alt="koperta" class="envelope" />
    </div>

    <button class="button">Wyloguj Się</button>
</div>
<div class="col-sm-6" id="danePrzelew">
    <br><br>
    <h1>Dziękujemy za wybranie naszej Usługi!</h1>
    <br><br><h3>Aby usługa została wykonana, potrzebna jest autoryzacja.</h3>
    <h3>prosimy wykonanie przelewu na poniższe konto:</h3>
    <h3>&nbsp;</h3>
    <h3>&nbsp;</h3>
    <h3>Numer konta: 07 1241 1561 0103 4455 1909 1215</h3>
    <h3>W tytule: Imię Nazwisko, wybrana usługa detektywistyczna, data</h3>
    <h3>&nbsp;</h3>
    <h3>Jeśli przelew został już wykonany</h3>
    <a style="font-size:30px" href="zalogowany.php">Przejdź na stronę gł&oacute;wną!</a>
</div>
    <?php
        if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>