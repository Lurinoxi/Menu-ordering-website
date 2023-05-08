<?php
    // Start session
    session_start();

    // Define constants to prevent repetition
    define('SITEURL', '');
    define('LOCALHOST', '');
    define('DB_USERNAME', '');
    define('DB_PASSWORD', '');
    define('DB_NAME', '');

    // Connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

   
