<?php
    //Session Starten  
    session_start();

    //Constant Erstellen damit sich die Values nicht wiederholen
    define('SITEURL', 'http://localhost/food/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'Mama Bringts'); 
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //zur Datenbank verbinden
    $db_select = mysqli_select_db($conn , DB_NAME) or die(mysqli_error($conn)); //Datenbank auswählen

    
?>