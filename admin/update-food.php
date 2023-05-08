<?php include('partials/menu.php') ?>

<?php
    //Schauen ob ID is set oder nicht
    if(isset($_GET['id']))
    {
        //Alle Details ziehen
        $id = $_GET['id'];

        //SQL Query um die Menüs zu ziehen
        $sql = "SELECT * FROM tbl_food WHERE id=$id";
        //Query ausführen
        $res = mysqli_query($conn, $sql);

        //Wert aus Query holen
        $row = mysqli_fetch_assoc($res);

        //Values holen 
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $active = $row['active'];
        $kw = $row['KW'];
        $year = $row['Year'];

    }
    else
    {
        //Weiterleiten auf Manage-Food.php
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Menü Aktualisierung</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>


            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image == "")
                    {
                        //Bild nicht verfügbar
                        echo"<div class='error'>Bild nicht verfügbar</div>";
                    }
                    else
                    {
                        //Bild vorhanden
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?> ?>" width="150px">
                        <?php
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Bild auswählen</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes" > Ja
                    <input <?php if($active=="No") {echo "Not checked";} ?> type="radio" name="active" value="No" > Nein
                </td>
            </tr>

            <tr>
                <td>KW: </td>
                <td>
                    <input type="number" name="KW" value="<?php echo $kw; ?>">
                </td>
            </tr>

            <tr>
                <td>Jahr: </td>
                <td>
                    <input type="number" name="Year" value="<?php echo $year; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Menu" class="btn-secondary">
                </td>
            </tr>
            
        </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                
                //1. Alle Details von dem Form ziehen
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $active = $_POST['active'];
                $kw = $_POST['KW'];
                $year = $_POST['Year'];

                //2. Bild hochladen wenns ausgewählt ist

                //Schauen ob button pressed wurde
                if(isset($_FILES['image']['name']))
                {
                    //Upload Knopf Clicked
                    $image_name = $_FILES['image']['name']; //Neuer Bild name

                    //Schauen ob das File verfügbar ist oder nicht
                    if($image_name!="")
                    {
                        //Image Available
                        //A. Neues Bild hochladen

                        //Image Umbenennen
                        $image_info = explode (".", $image_name); //Nimmt die extension von Image
                        $ext = end ($image_info);
                        $image_name = "Mama-Bringts-".rand(0000, 9999).'.'.$ext; //bennent das Image um

                        //Source pfad und Destinations Pfad ziehen
                        $src_path = $_FILES['image']['tmp_name']; //Source Pfad
                        $dest_path = "../images/food/".$image_name; //Destination Pfad

                        //Ladet bild hoch
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Schauen ob Bild hochgeladen wurde oder nicht
                        if($upload==false)
                        {
                            //Upload Failed
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //Weiterleiten auf Manage Food 
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Process Stoppen
                            die();
                        }

                        //B. Derzeitiges Bild löschen falls vorhanden
                        if($current_image!="")
                        {
                            //Bild verfügbar
                            //Bild löschen
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);
                            

                            //Check ob das Bild entfernt wurde
                            if($remove==false)
                            {
                                //Wurde nicht entfernt
                                $_SESSION['remove-failed'] = "<div class='error'> Bild konnte nicht entfernt werden! </div>";
                                //Weiterleiten
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Session Stoppen
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Bild wenn bild nicht ausgewählt wurde
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Bild wenn der knopf nd gedrückt wurde
                }

                //4. Menü updaten in der DB
                $sql2 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    active = '$active',
                    KW = '$kw',
                    Year ='$year'

                    WHERE id=$id
                    ";
                //Query ausführen
                $res2 = mysqli_query($conn, $sql2);
                

                //schauen ob query lauft
                if($res2==true)
                {
                    //Query funkt
                    $_SESSION['update'] = "<div class='success text-center'> Menü wurde erfolgreich aktualisiert!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Query funkt nd
                    $_SESSION['update'] = "<div class='error text-center'>Menü konnte nicht aktualisiert werden!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>