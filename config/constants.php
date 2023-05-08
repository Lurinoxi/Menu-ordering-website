<?php
    // Start session
    session_start();

    // Define constants to prevent repetition
    define('SITEURL', 'http://localhost/food/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'Mama Bringts');

    // Connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

   