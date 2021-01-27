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

if (isset($_POST['TerminSpotkania']) && isset($_POST['Godzina']) && isset($_POST['Adres']))
{
    $wszystko_OK=true;

    //Zapamiętaj wprowadzone dane
    $termin = date('Y-m-d', strtotime($_POST['TerminSpotkania']));
    $metraz = $_POST['Metraz'];
    $godzina = $_POST['Godzina'];
    $adres = $_POST['Adres'];
    $_SESSION['godzina'] = $godzina;
    $_SESSION['adres'] = $adres;
    $_SESSION['metraz'] = $metraz;
    $cena;

    if ($metraz==0)
        $cena=300;
    else
        $cena = ($metraz*7)+100;
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
                if ($polaczenie->query("INSERT INTO zlecenie VALUES (NULL,'Data: $termin<br />Godzina: $godzina','$cena','Adres: $adres',1, {$_SESSION['id']})"))
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
    <title>Wykrywanie podsłuchow oraz nadajnikow GPS</title>
    <link rel="stylesheet" href="css/wykrywanie.css" />
</head>
<body>

  <script>
  function changeEvent() {
    var dropDown = document.getElementById("dropDown").value;

    if(dropDown === "pomieszczenie"){
        document.getElementById('wrapperOne').style.display = 'block';
        document.getElementById('wrapperTwo').style.display = 'none';
     } else {
       document.getElementById('wrapperOne').style.display = 'none';
        document.getElementById('wrapperTwo').style.display = 'block';
     }
  }

  function changeEvent2(){
    var meters = document.getElementById("meters").value;
    let price = 100 + meters * 7;
    document.getElementById("calculated").innerHTML = "cena za podany metraż: " + price;
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
    Wykrywanie podsłuchów oraz nadajników GPS
  </div>



  <select id="dropDown" onChange="changeEvent()">
    <option value="pomieszczenie" selected="selected"> Przeszukanie pomieszczenia</option>
    <option value="samochod">Przeszukanie samochodu</option>
  </select>

   <div id="wrapperOne">
     <form method="post">
        <label for="#">Wybierz termin usługi:</label>
        <br>
        <input type="date" id="TerminSpotkania" value="<?php
                                                       if (isset($_SESSION['termin']))
                                                       {
                                                           echo $_SESSION['termin'];
                                                           unset($_SESSION['termin']);
                                                       }
                                                       ?>"
               name="TerminSpotkania">


      <br/><br/>

        <label for="#">Wybierz godzinę:</label>
        <br>
        <input type="time" value="<?php
                                  if (isset($_SESSION['godzina']))
                                  {
                                      echo $_SESSION['godzina'];
                                      unset($_SESSION['godzina']);
                                  }
                                  ?>"
               name="Godzina">


      <br/><br/>

        <label for="#">Podaj Adres:</label>
        <br>
        <input type="text" value="<?php
                                  if (isset($_SESSION['adres']))
                                  {
                                      echo $_SESSION['adres'];
                                      unset($_SESSION['adres']);
                                  }
                                  ?>"
               name="Adres">


    <br/><br/>
    Podaj Metraż pomieszczenia w m2 (max 200):

      <input type="number" id="meters" onChange="changeEvent2()"
      min="1" max="200" value="<?php
                               if (isset($_SESSION['metraz']))
                               {
                                   echo $_SESSION['metraz'];
                                   unset($_SESSION['metraz']);
                               }
                               ?>"
             name="Metraz">


    <br/><br/>
    <div id="calculated">

    </div>

    <br/><br/>

      <input type="submit" value="Zatwierdź" class="button-green">
    </form>
    <br/>
    <input type="button" value="Wróć" onclick="window.location.href='uslugi.php'" class="button">
  </div>

   <div id="wrapperTwo">
       <form method="post">

      <label for="#">Wybierz termin usługi:</label>
      <br>
      <input type="date" value="<?php
                                if (isset($_SESSION['termin']))
                                {
                                    echo $_SESSION['termin'];
                                    unset($_SESSION['termin']);
                                }
                                ?>"
             name="TerminSpotkania">


    <br/><br/>

      <label for="#">Wybierz godzinę:</label>
      <br>
      <input type="time" value="<?php
                                if (isset($_SESSION['godzina']))
                                {
                                    echo $_SESSION['godzina'];
                                    unset($_SESSION['godzina']);
                                }
                                ?>"
             name="Godzina">


    <br/><br/>
  
      <label for="#">Podaj Adres:</label>
      <br>
      <input type="text" value="<?php
                                if (isset($_SESSION['adres']))
                                {
                                    echo $_SESSION['adres'];
                                    unset($_SESSION['adres']);
                                }
                                ?>"
             name="Adres">


    <br/>
    Cena za sprawdzenie pojazdu to 300zł

    <br/><br/>
    
      <input type="submit" value="Zatwierdź" class="button-green">
    </form>
    <br/>
    <input type="button" value="Wróć" onclick="window.location.href='uslugi.php'" class="button">
   </div>

</div>
        <?php
        if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
        ?>
</body>
</html>
