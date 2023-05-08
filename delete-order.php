<?php
    //Constants page einbinden
    include('config/constants.php');

    if(isset($_GET['id']))
    {
        //Löschen
        $id = $_GET['id'];

        //SQL Query zum Löschen der Bestellung ausführen
        $sql = "DELETE FROM tbl_order WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        //Überprüfen, ob die Bestellung gelöscht wurde, und eine entsprechende Nachricht ausgeben
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Bestellung erfolgreich gelöscht.</div>";
            header('location:'.SITEURL.'abbestellen.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Fehler beim Löschen der Bestellung.</div>";
            header('location:'.SITEURL.'abbestellen.php');
        }
    }
    else
    {
        //Weiterleiten auf Startseite
        $_SESSION['unauthorize'] = "<div class='error'>Unberechtigter Zugriff.</div>";
        header('location:'.SITEURL.'index.php');
    }
?>
