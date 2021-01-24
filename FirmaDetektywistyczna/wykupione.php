<?php

session_start();
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Wykupione usługi</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style type="text/css">
        .nav-dark .nav {
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
            class="nav-dark"
            onclick="window.location.href='wykupione.php'">
            Przeglądaj wykupione usługi
        </button>
    </div>

    <div class="text">
            <b>Wykupione przez Ciebie usługi: </b><br />
<br />
        <?php

$sql = "SELECT * FROM zlecenie where uzytkownicy_iduzytkownicy={$_SESSION['id']}";
$result = @$polaczenie->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 while($row = $result->fetch_assoc()) {
     $sql1="SELECT nazwa FROM uslugi where id={$row['uslugi_iduslugi']}";
     $result1 = @$polaczenie->query($sql1);
     if ($result1->num_rows > 0) {
         while($row1 = $result1->fetch_assoc()) {
             echo "<div class='usluga'><b>Nazwa: </b>".$row1["nazwa"]."<br /><b>Termin spotkania/wykonania usługi:</b><br /> " . $row["Termin"]. "<br / ><b>Cena:</b><br />".$row["Cena"]."<br /><b>Szczegóły:</b><br />".$row["szczegoly"]." </div>";
         }
     }
  }
} else {
  echo "0 results";
}
        ?>

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