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
            onclick="window.location.href='logowanie.php'">
            Zaloguj się
        </button>
    </div>

    <div class="text">
        <form action="login.php" method="post">
            Login:
            <input type="text" name="login" />
            Hasło:
            <input type="password" name="haslo" />
            <input type="submit" value="Zaloguj się" />

        </form>
    </div>
    <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>