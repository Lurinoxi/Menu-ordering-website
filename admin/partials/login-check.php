<?php

    // Authorization - Access Control
    //Schaut ob User eingeloggt ist oder nicht
    if(!isset($_SESSION['user'])) //Wenn User session ist nicht gesetzt 
    {
        //User ist nicht eingeloggt
        //Weiterleitungs  Nachricht
        $_SESSION['no-login-message'] = "<div class='error text-center'>Bitte melde dich an um die Seite zu betreten</div>";
        //Weiterleiten auf Login Page
        header('location:'.SITEURL.'admin/login.php');
    }

?>