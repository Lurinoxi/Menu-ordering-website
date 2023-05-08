<?php
    //Constants page einbinden
    include('../config/constants.php');


    if(isset($_GET['id']) && isset($_GET['image_name'])) //Man kann && oder 'AND' benutzen
    {
        //Löschen 
        //echo "Wird gelöscht";

        //1. ID und Image name ziehen
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Image löschen falls verfügbar
        if($image_name !="")
        {
             //Hat bild und muss von Folder gelöscht werden
              //Image path holen
              $path = "../images/food/".$image_name;

              //Image von Folder löschen
              $remove = unlink($path);
            
              //Schauen ob das Bild gelöscht ist oder nicht
              if($remove==false)
              {
                //Bild wurde nicht gelöscht
                $_SESSION['upload'] = "<div class='error'>Konnte Bild nicht löschen</div>";
                //Weiterleiten auf Manage-Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Prozess stoppen
                die();
              }
              else
              {

              }



        }
    

        //3. Menü von DB lösche
        $sql ="DELETE FROM tbl_food WHERE id=$id";
        //Query ausführen
        $res = mysqli_query($conn, $sql);

        //Schauen ob query ausführt oder nich und session nachricht senden
        if($res==true)
        {
            //Menu gelöscht
            $_SESSION['delete'] = "<div class='success'>Menü wurde erfolgreich gelöscht!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Konnte Menü nicht löschen
            $_SESSION['delete'] = "<div class='error'>Menü konnte nicht gelöscht werden!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        


    }
    else
    {
        //Weiterleiten auf Manage Food
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>