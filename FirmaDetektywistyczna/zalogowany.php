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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Oliwski</title>
</head>

<body>

    <?php

	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	echo "<p><b>Imie</b>: ".$_SESSION['Imie'];
	echo " | <b>Nazwisko</b>: ".$_SESSION['Nazwisko'];
	echo " | <b>Uprawnienia</b>: ".$_SESSION['Uprawnienia']."</p>";

	echo "<p><b>ID</b>: ".$_SESSION['id'];

    ?>

</body>
</html>