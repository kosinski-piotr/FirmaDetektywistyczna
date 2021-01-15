<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Firma detektywistyczna Herkules</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style type="text/css">
        .nav-dark {
            width:100%
        }
    </style>
</head>
<body>
	<div class="user-container">
		<form action="login.php" method="post">
	
			Login: <input type="text" name="login" />
			Hasło: <input type="password" name="haslo" /> 
			<input type="submit" value="Zaloguj się" />
	
		</form>
	</div>

    <div class="top">
        <div class="name">Herkules!</div>
    </div>

    <div class="navbar">
        <button
            class="nav-dark"
            onclick="window.location.href='index.php'">
            Strona główna
        </button>
    </div>

    <div class="text">
        <b>ZALOGUJ SIĘ ABY MIEĆ DOSTĘP DO WSZYSTKICH MOŻLIWOSCI!</b><br /><br />
        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
      Lorem Ipsum has been the industry's standard dummy text ever since the
      1500s, when an unknown printer took a galley of type and scrambled it to
      make a type specimen book. It has survived not only five centuries, but
      also the leap into electronic typesetting, remaining essentially
      unchanged. It was popularised in the 1960s with the release of Letraset
      sheets containing Lorem Ipsum passages, and more recently with desktop
      publishing software like Aldus PageMaker including versions of Lorem
      Ipsum.
    </div>
        <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
        ?>
</body>
</html>