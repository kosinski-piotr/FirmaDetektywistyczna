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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Zalogowany</title>
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

        <button class="nav" onclick="window.location.href='stronaGlowna.html'">
            Kontakt
        </button>

        <button class="nav-dark" onclick="window.location.href='uslugi.php'">
            Przeglądaj Usługi
        </button>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-3" id="tabela">
                <h3>
                    Wykrywanie podsłuchów oraz nadajników GPS.
                    <br />
                    <br />
                    <a href="wykrywanie.php">Przejdź!</a>
                    <br />
                    <br />
                </h3>
                <p>
                    Polega na dokładnym przeszukaniu budynku, pomieszczenia lub samochodu z użyciem specjalistycznego sprzętu, w celu wykrycia urządzeń podsłuchujących oraz namierzających. Klient posiada możliwość wyboru dwóch opcji: sprawdzenie budynku, sprawdzenie samochodu. W przypadku sprawdzenia samochodu cena jest stała, natomiast gdy sprawdzany jest budynek, klient podaje jego wielkość w metrach kwadratowych, a system automatycznie wylicza cenę. Klient spośród wolnych terminów może wybrać konkretną datę i godzinę.
                    <br />
                </p>
            </div>
            <div class="col-sm-3" id="tabela1">
                <h3>
                    Sprawdzanie komputerów pod kątem oprogramowania szpiegującego.
                    <br />
                    <br />
                    <a href="url">Przejdź!</a>
                    <br />
                    <br />
                </h3>
                <p>
                    Opiera się na dokładnym i bezbłędnym przeszukania komputera klienta przez informatyków. Klient spośród wolnych terminów może wybrać konkretną datę i godzinę.
                    <br />
                </p>
            </div>
            <div class="col-sm-3" id="tabela2">
                <h3>
                    Obserwacja ogólna
                    <br />
                    <br />
                    <a href="ObserwacjaOgolna.html">Przejdź!</a>
                    <br />
                    <br />
                </h3>
                <p>
                    Polega na śledzeniu osoby/osób w konkretnym wybranym terminie. Po wybraniu terminu, w którym są dostępni wolni detektywi system wylicza cenę w zależności od czasu obserwacji. Szczegóły mogą zostać skonsultowane telefonicznie, w biurze detektywistycznym lub przez system.
                    <br />
                </p>
            </div>
            <div class="col-sm-3" id="tabela3">
                <h3>
                    Ustalenie miejsca pracy.
                    <br />
                    <br />
                    <a href="url">Przejdź!</a>
                    <br />
                    <br />
                </h3>
                <p>
                    Odbywa się na zasadzie zebrania przez detektywa niezbędnych i rzetelnych dowodów dotyczących konkretnej sytuacji. Klient wybiera termin pierwszej konsultacji w celu ustalenia szczegółów. Następnie w trakcie trwania sprawy nasi detektywni oraz klient komunikują się telefonicznie, osobiście lub przez system.
                    <br />
                </p>
            </div>
            <div class="col-sm-3" id="tabela4">
                <h3>
                    Sprawdzanie wiernosci wspołmałżonka, partnera.
                    <br />
                    <br />
                    <a href="url">Przejdź!</a>
                    <br />
                    <br />
                </h3>
                <p>
                    Podobnie jak Ustalenie miejsca pracy odbywa się na zasadzie zebrania przez detektywa niezbędnych i rzetelnych dowodów dotyczących konkretnej sytuacji. Klient wybiera termin pierwszej konsultacji w celu ustalenia szczegółów. Następnie w trakcie trwania sprawy nasi detektywni oraz klient komunikują się telefonicznie, osobiście lub przez system.
                    <br />
                </p>
            </div>
        </div>
    </div>
</body>
</html>
