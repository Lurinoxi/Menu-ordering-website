

<?php

define('SITEURL', 'http://localhost/food/');


$name = $_POST['name'];
$email = $_POST['email'];
$anliegen = $_POST['anliegen'];
$message = $_POST['message'];

$mailheader = "From:".$name."<".$email.">\r\n";

$recipient ="postmaster@localhost";

mail($recipient, $anliegen, $message, $mailheader)
or die('Error!');

header('location:'.SITEURL.'Contact-confirmation.php');


?>