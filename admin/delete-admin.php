<?php
    
    //Constants.php einfügen
    include('../config/constants.php');

    //1. ID vom Admin der gelöscht wird ziehen
     $id = $_GET['id'];

    //2. SQL Query machen um die Gelöschten Admins zu speicher
    $sql = "DELETE FROM tbl_admin where id=$id";

    //Query ausführen
    $res = mysqli_query($conn, $sql);

    // Schauen ob die Query ausgeführt wird oder nicht
    if($res==true)
    {
        //Query wird ausgeführt und Admin wird gelöscht
        //Session Variable erstellen um die Nachricht auf Main Page anzeigen
        $_SESSION['delete'] = "<div class='success'>Admin wurde Erfolgreich gelöscht!</div>";
        //Weiterleitung auf Manage Page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //Admin konnte nicht Gelöscht werden
        //echo "Admin konnte nicht gelöscht werden";

        $_SESSION['delete'] = "<div class='error'>Admin konnte nicht gelöscht werden! Versuche es später nochmal</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Weiterleitung auf Delete-admin machen mit Nachricht (success/error)






?>