<?php
    //constants.php einfügen
    include('config/constants.php');
    //1. Query erstellen um Session zu beenden
    session_destroy(); //Unsets $_SESSION['user'] in index.php

    //2. Auf Login weiterleiten
    header('location:'.SITEURL.'login.php');


?>