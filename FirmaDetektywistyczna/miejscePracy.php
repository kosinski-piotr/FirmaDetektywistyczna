<?php

session_start();
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
?>
<?php

session_start();

if (isset($_POST['imie']) && isset($_POST['nazwisko']))
{
    $wszystko_OK=true;

    //Zapamiętaj wprowadzone dane
    $termin = date('Y-m-d', strtotime($_POST['TerminSpotkania']));
    $godzina = $_POST['godzina'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $dane = $_POST['w3review'];
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {

            if ($wszystko_OK==true)
            {
                //Dodawanie Użytkownika do bazy:
                if ($polaczenie->query("INSERT INTO zlecenie VALUES (NULL,'Data: $termin<br />Godzina: $godzina',NULL,'Imie i nazwisko: $imie $nazwisko<br />Dane: $dane',3, {$_SESSION['id']})"))
                {
                    $_SESSION['udanarejestracja']=true;
                    echo($termin."<script>alert('Zlecenie zostało przyjęte do realizacji. Skontaktujemy się z Tobą w celu potwerdzenia')</script>");
                    echo("<script>window.location = 'zalogowany.php';</script>");
                }
                else
                {
                    throw new Exception($polaczenie->error);
                }

            }

            $polaczenie->close();
        }

    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności. Prosimy spróbować w innym terminie!</span>';
        echo '<br />Informacja developerska: '.$e;
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ustalenie miejsca pracy</title>
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
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
        <div class="name">Herkules!</div>

        <div class="space"></div>

        <div class="envelope-container">
            <img src="images/Envelope-icon.png" alt="koperta" class="envelope" />
        </div>

        <button class="button">Wyloguj Się</button>
    </div>
    <div class="container">
        <h1>Ustalenie Miejsca Pracy</h1>
        <br />
        <br />
        <div class="row">
            <form method="post">
                <div class="col-sm-4">

                    <label for="#">Wybierz termin pierwszego spotkania:</label>
                    <br />
                    <input type="date" id="TerminSpotkania" name="TerminSpotkania" />

                    <br />
                    <br />

                    <label for="#">Wybierz proponowaną godzinę pierwszego spotkania:</label>
                    <br />
                    <input type="time" id="appt" name="godzina" />

                </div>
                <div class="col-sm-4">
                    <br />
                    <label>Dane Obserwowanej Osoby:</label>
                    <br />

                    <label for="#">Imie:</label>
                    <input type="text" value="<?php
                                              if (isset($_SESSION['imie']))
                                              {
                                                  echo $_SESSION['imie'];
                                                  unset($_SESSION['imie']);
                                              }
                                              ?>"
                        name="imie" />
                    <br />
                    <br />
                    <label for="#">Nazwisko:</label>
                    <input type="text" value="<?php
                                              if (isset($_SESSION['nazwisko']))
                                              {
                                                  echo $_SESSION['nazwisko'];
                                                  unset($_SESSION['nazwisko']);
                                              }
                                              ?>"
                        name="nazwisko" />
                    <br />
                    <br />

                </div>
                <div class="col-sm-4">
                    <label>Wpisz dodatkowe dane:</label>

                    <label for="w3review"></label>
                    <textarea id="w3review" name="w3review" rows="4" cols="50">
                        Pisz tutaj
                    </textarea>

                    <br />
                    <br />
                </div>
                <div class="col-sm-2">

                    <input type="submit" value="Zatwierdź" id="acceptB" />
                </div>
            </form>
            <div class="col-sm-2">

                <input type="button" value="Wróć" onclick="uslugi.php" id="backB" />

            </div>

        </div>
    </div>

    <?php
        if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>