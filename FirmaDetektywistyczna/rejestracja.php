<?php

	session_start();

	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;

		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];

		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}

		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}

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
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

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
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

				if (!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}

				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					echo '<script>alert('.$email.')</script>';
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (79, '$nick', '$haslo1', '$email', '$email', 1)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: index.php');
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
            Nickname:
            <br />
            <input type="text" value="<?php
                                      if (isset($_SESSION['fr_nick']))
                                      {
                                          echo $_SESSION['fr_nick'];
                                          unset($_SESSION['fr_nick']);
                                      }
                                      ?>"
                name="nick" />
            <br />

            <?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
            ?>

		E-mail:
            <br />
            <input type="text" value="<?php
                                      if (isset($_SESSION['fr_email']))
                                      {
                                          echo $_SESSION['fr_email'];
                                          unset($_SESSION['fr_email']);
                                      }
                                      ?>"
                name="email" />
            <br />

            <?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
            ?>

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

            <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
            ?>

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

     
            <br />

            <input type="submit" value="Zarejestruj się" />

        </form>
    </div>
    <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>