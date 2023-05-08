<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Menüs verwalten</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Name des Menüs">
                </td>
            </tr>

            <tr>
                <td>Beschreibung: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Beschreibung des Menüs"></textarea>
                </td>
            </tr>

            <tr>
                <td>Preis: </td>
                <td>
                    <input type="number" name="price" placeholder="Preis des Menüs">
                </td>
            </tr>

            <tr>
                <td>KW: </td>
                <td>
                    <input type="number" name="KW" placeholder="Kalenderwoche 1-52">
                </td>
            </tr>

            <tr>
                <td>Jahr: </td>
                <td>
                    <input type="number" name="Year" value="<?php echo date('Y'); ?>">
                </td>
            </tr>

            <tr>
                <td>Bild auswählen: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Verfügbar: </td>
                <td>
                    <input type="radio" name="active" value="Yes" > Ja
                    <input type="radio" name="active" value="No" > Nein
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Menü Hinzufügen" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <?php

            //Schauen ob der Button gedrückt wurde oder nicht 
            if(isset($_POST['submit']))
            {
                //Menü in die DB schieben
                
                //1. Daten von Form ziehen
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $kw = $_POST['KW'];
                $year = $_POST['Year'];
                
                
                //Schauen ob Radion button fuer Active is checked oder nicht
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setzt den standard Wert
                }

                //2. Bild vom Menü hochladen Std Mama bringts logo
                //Schauen ob ein Bild hochgeladen wurde oder nicht
                if(isset($_FILES['image']['name']))
                {
                    // Details vom ausgewählten bild ziehen
                    $image_name =$_FILES['image']['name'];

                    //Schauen ob bild ausgewählt ist oder nicht bild erst hochladen wenn ausgewählt
                    if($image_name!="")
                    {
                        //Bild ausgewählt
                        //A. Bild umbenennen
                        // Endung vom Bild ziehen (jpg, png usw)
                        $image_info = explode (".", $image_name);
                        $ext = end ($image_info);

                        //Neuer Name für Bild kreiren
                        $image_name = "Mama-Bringts-" .rand(0000,9999).".".$ext; //Erstellt neuen Bild namen


                        //B. Bild hochladen
                        //SRC Pfad und Destination Pfad ziehen

                        // Source Pfad is der derzeitige Standort vom Bild
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Pfad wo das Bild hochgeladen werden soll
                        $dst = "../images/food/".$image_name; 

                        //Schlussendlich Bild hochladen
                        $upload = move_uploaded_file($src, $dst);

                        //Schauen ob das Bild hochgeladen wurde oder nicht
                        if($upload==false)
                        {
                            //Image Upload Fehlgeschlagen
                            //Weiterleiten auf Add Food Seite mit Error msg
                            $_SESSION['upload'] = "<div class='error'>Bild konnte nicht Hochgeladen werden!</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Process wird gestoppt
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; //Default Wert vom Image ist 0 bzw Blank
                }

                //3. Daten von Form in die DB einfügen

                //SQL Query erstellen
                // Für Numericals müssen wir kein Wet setzen aber für String value schon String = Text Numerical = Zahlen
                $sql = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    active = '$active',
                    KW = '$kw',
                    Year ='$year'

                ";

                //Query ausführen
                $res = mysqli_query($conn, $sql);
                //Schaen ob daten eingefügt oder nd
                if($res == true)
                {
                    //Daten sind drin
                    $_SESSION['add'] = "<div class='success'>Menü erfolgreich hinzugefügt!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Daten sind nd drin
                    $_SESSION['add'] = "<div class='error'>Menü konnte nicht hinzugefügt werden!</div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>