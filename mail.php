<?php

$name = $_POST['name'];
$email = $_POST['email'];
$anliegen = $_POST['anliegen'];
$message = $_POST['message'];

$mailheader = "From:".$name."<".$email.">\r\n";

$recipient ="matteo.lang@sie.at";

mail($recipient, $anliegen, $message, $mailheader)
or die('Error!');

echo '

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title>Kontaktiere Uns!</title>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="contact-us.css">
        <body>
            <div class="container">
                <h1>Danke fürs Kontaktieren!</h1>
                <p class="back">Zurück zum <a href="index.php">Hauptmenü!</a>.</p>
            </div>
        </body>
    </head>
</html>

';

?>