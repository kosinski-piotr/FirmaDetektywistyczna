<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Firma detektywistyczna Herkules</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
</head>
<body>
    <?php

    $hostname="localhost";
    $username="s151266";
    $passowrd="JNw#7E8xVISJ";
    $dbname="s151266";

    $con = mysqli_connect($hostname,$username,$passowrd,$dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    echo "POŁĄCZONO Z BAZĄ!";
    mysqli_query($con,"SELECT * FROM Ludzie");

    ?>


</body>
</html>