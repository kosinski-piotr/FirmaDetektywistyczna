<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Firma detektywistyczna Herkules</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <style type="text/css">
       .nav {
            width:50%;
        }
    </style>
</head>
<body>
    <div class="user-container"></div>

    <div class="top">
        <div class="name">>Herkules! </div>
    </div>

    <div class="navbar">
        <button
            class="nav"
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
        <button
            onclick="window.location.href='index.php'">
            Strona główna
        </button>
    </div>
    <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
    ?>
</body>
</html>