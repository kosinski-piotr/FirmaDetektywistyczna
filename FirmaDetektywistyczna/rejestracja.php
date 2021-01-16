<?php

	session_start();

	if (isset($_POST['imie']) && isset($_POST['nazwisko']))
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

		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];

		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];

		if ((strlen($haslo1)<4) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 4 do 20 znaków!";
		}

		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}

		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;

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

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$login'");

				if (!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_login']="Istnieje już użytkownik o takim loginie. Wybierz inny :)";
				}

				if ($wszystko_OK==true)
				{
					//Dodawanie Użytkownika do bazy:
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$login', '$haslo1', '$imie', '$nazwisko', 1)"))
					{
						$_SESSION['udanarejestracja']=true;
                        echo("<script>alert('Rejestracja przebiegła pomyślnie!')</script>");
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
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Firma detektywistyczna Herkules</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style type="text/css">
        .nav-dark .nav {
            width:50%;
        }
    </style>
</head>
<body>
    <div class="user-container"></div>

    <div class="top">
        <div class="name">Herkules!</div>
    </div>

    <div class="navbar">
        <button
            class="nav"
            onclick="window.location.href='index.php'">
            Strona główna
        </button>
        <button
            class="nav-dark"
            onclick="window.location.href='rejestracja.php'">
            Zarejestruj się
        </button>
    </div>

    <div class="text">
        <form method="post">
        Login:
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
		Imię:
            <br />
            <input type="text" value="<?php
                                      if (isset($_SESSION['fr_imie']))
                                      {
                                          echo $_SESSION['fr_imie'];
                                          unset($_SESSION['fr_imie']);
                                      }
                                      ?>"
                name="imie" />
            <br />
            <hr />
        Nazwisko:
            <br />
            <input type="text" value="<?php
                                      if (isset($_SESSION['fr_nazwisko']))
                                      {
                                          echo $_SESSION['fr_nazwisko'];
                                          unset($_SESSION['fr_nazwisko']);
                                      }
                                      ?>"
                name="nazwisko" />
            <br />
            <hr />
		Twoje hasło:
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
		Powtórz hasło:
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
            <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
            ?>
     
  
            <hr />
            <br />
            <input type="submit" value="Zarejestruj się" />

        </form>
    </div>
    <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>