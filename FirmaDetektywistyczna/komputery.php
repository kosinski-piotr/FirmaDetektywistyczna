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

if (isset($_POST['Ilosc']))
{
    $wszystko_OK=true;

    //Zapamiętaj wprowadzone dane
    $ilosc = $_POST['Ilosc'];
    $_SESSION['ilosc'] = $ilosc;
    $cena = $ilosc*200;

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
                if ($polaczenie->query("INSERT INTO zlecenie VALUES (NULL,NULL,'$cena','Ilość komputerów: $ilosc',2, {$_SESSION['id']})"))
                {
                    $_SESSION['udanarejestracja']=true;
                    echo($termin."<script>alert('Zlecenie zostało przyjęte do realizacji. Skontaktujemy się z Tobą w celu potwerdzenia')</script>");
                    echo("<script>window.location = 'daneprzelewu.php';</script>");
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
    <title>Sprawdzenie komputerów</title>
    <link rel="stylesheet" href="css/wykrywanie.css" />
</head>
<body>
  
  <script>

  function changeEvent(){
    var computers = document.getElementById("computers").value;
    let price = computers * 200;
    document.getElementById("calculated").innerHTML = "cena za sprawdzenie: " + price;
  }

  </script>


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
  <div class="title">
    Sprawdzanie komputerów pod kątem oprogramowania szpiegującego 
    <br/><br/>
    Komputery należy dostarczyć do naszego biura w ciągu 14 dni od zamówienia usługi
  </div>


    <br/><br/>
    Podaj ilość komputerów:
    <form method="post">
      <input type="number" id="computers" onChange="changeEvent()"
      min="1" max="20" name="Ilosc">

      
    <br/><br/>
    <div id="calculated">

    </div>

    <br/><br/>

      <input type="submit" value="Zatwierdź" class="button-green">
    </form>
    <br/>
      <input type="button" value="Wróć" onclick="window.location.href='zalogowany.php'" class="button">
  </div>
    <?php
        if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>
