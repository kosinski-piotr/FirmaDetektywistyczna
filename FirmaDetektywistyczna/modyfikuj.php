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

if (isset($_POST['login']))
{
    //Udana walidacja? Załóżmy, że tak!
    $wszystko_OK=true;

    //Sprawdź poprawność loginu
    $login = $_POST['login'];

    //Sprawdzenie długości loginu
    if ((strlen($login)<3) || (strlen($login)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
    }

    if (ctype_alnum($login)==false)
    {
        $wszystko_OK=false;
        $_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
    }


    //Sprawdź poprawność hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    $haslo3 = $_POST['haslo3'];

    if ($haslo1 != $_SESSION['pass'])
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Podano błędne hasło";
    }

    if ((strlen($haslo2)<4) || (strlen($haslo2)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Hasło musi posiadać od 4 do 20 znaków!";
    }

    if ($haslo2!=$haslo3)
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
    }

    //Zapamiętaj wprowadzone dane
    $_SESSION['fr_login'] = $login;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    $_SESSION['fr_haslo3'] = $haslo3;
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

                if ($polaczenie->query("UPDATE uzytkownicy SET user = '$login', pass = '$haslo2' WHERE id = {$_SESSION['id']}"))
                {
                    $_SESSION['udanarejestracja']=true;
                    echo("<script>alert('Zmiana danych przebiegła pomyślnie!')</script>");
                    echo("<script>window.location = 'index.php';</script>");
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
    <title>Modyfikuj dane</title>
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
            class="nav-dark"
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
        <form method="post">
            <b>Zmień login: </b><br /><br />
            Jeżeli nie chcesz zmieniać loginu, podaj swój dotychczasowy.<br /> W innym przypadku wpisz nowy:
            <br />
            <input type="text" value="<?php
                                      if (isset($_SESSION['fr_login']))
                                      {
                                          echo $_SESSION['fr_login'];
                                          unset($_SESSION['fr_login']);
                                      }
                                      ?>"
                name="login" />
            <br />
            <?php
			if (isset($_SESSION['e_login']))
			{
				echo '<div class="error">'.$_SESSION['e_login'].'</div>';
				unset($_SESSION['e_login']);
			}
            ?>
            <hr />
            <br />
            <b>Zmień hasło: </b>
            <br />
            <br />
            Podaj swoje aktualne hasło: 
            <br />
            <input type="password" value="<?php
                                          if (isset($_SESSION['fr_haslo1']))
                                          {
                                              echo $_SESSION['fr_haslo1'];
                                              unset($_SESSION['fr_haslo1']);
                                          }
                                          ?>"
                name="haslo1" />
            <br />
            <hr />
            Twoje nowe hasło:
            <br />

            <input type="password" value="<?php
                                          if (isset($_SESSION['fr_haslo2']))
                                          {
                                              echo $_SESSION['fr_haslo2'];
                                              unset($_SESSION['fr_haslo2']);
                                          }
                                          ?>"
                name="haslo2" />
            <br />
            Powtórz nowe hasło:
            <br />

            <input type="password" value="<?php
                                          if (isset($_SESSION['fr_haslo3']))
                                          {
                                              echo $_SESSION['fr_haslo3'];
                                              unset($_SESSION['fr_haslo3']);
                                          }
                                          ?>"
                name="haslo3" />
            <br />
            <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
            ?>


            <hr />
            <br />
            <input type="submit" value="Zatwierdź zmiany" />

        </form>
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