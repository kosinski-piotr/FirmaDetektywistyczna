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
        zalogowany jako: Tadeusz Wyborowy
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
      <form action="/action_page.php">
        <label for="#">Wybierz termin usługi:</label>
        <br>
        <input type="date" id="TerminSpotkania" name="TerminSpotkania">
      </form>

      <br/><br/>
      <form action="/action_page.php">
        <label for="#">Wybierz godzinę:</label>
        <br>
        <input type="time" name="appt">
      </form>

      <br/><br/>
      <form action="/action_page.php">
        <label for="#">Podaj Adres:</label>
        <br>
        <input type="text" name="TerminSpotkania">
      </form>

    <br/><br/>
    Podaj Metraż pomieszczenia w m2 (max 200):
    <form action="/action_page.php">
      <input type="number" id="meters" onChange="changeEvent2()"
      min="1" max="200">
    </form>
      
    <br/><br/>
    <div id="calculated">

    </div>

    <br/><br/>
    <form action="/action_page.php">
      <input type="submit" value="Zatwierdź" class="button-green">
    </form>
    <br/>
    <input type="button" value="Wróć" onclick="window.location.href='uslugi.php'" class="button">
  </div>

   <div id="wrapperTwo">
    <form action="/action_page.php">
      <label for="#">Wybierz termin usługi:</label>
      <br>
      <input type="date" name="TerminSpotkania">
    </form>

    <br/><br/>
    <form action="/action_page.php">
      <label for="#">Wybierz godzinę:</label>
      <br>
      <input type="time" name="appt">
    </form>

    <br/><br/>
    <form action="/action_page.php">
      <label for="#">Podaj Adres:</label>
      <br>
      <input type="text" id="TerminSpotkania" name="TerminSpotkania">
    </form>

    <br/> 
    Cena za sprawdzenie pojazdu to 300zł

    <br/><br/>
    <form action="/action_page.php">
      <input type="submit" value="Zatwierdź" class="button-green">
    </form>
    <br/>
    <input type="button" value="Wróć" onclick="window.location.href='uslugi.php'" class="button">
   </div>

</div>
</body>
</html>
