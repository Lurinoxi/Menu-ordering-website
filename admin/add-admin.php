<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper" >
        <h1>Add User</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add'])) //Schaut ob die Session lauft oder nicht
        {
            echo $_SESSION['add']; //Zeigt Session Nachricht an
            unset($_SESSION['add']); //Entfernt Session Nachricht
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>

                    <td>Vor und Nachname:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Bitte Name eingeben">
                    </td>
                </tr>
                
                <tr>

                    <td>Rolle:</td>
                    <td>
                        <input type="text" name="rolle" placeholder="Mitarbeiter/Lehrling/Spezialarbeitskraft">
                    </td>

            </tr>

                <tr>

                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" placeholder="Ihre Email">
                    </td>

                </tr>

                <tr>

                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Ihr Passwort">
                    </td>

            </tr>

                <tr>

                    <td>Rechte:</td>
                    <td>
                    <input type="text" name="rechte" placeholder="admin/leer">
                    </td>

                </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="Submit" value="Hinzufügen" class="btn-secondary">
                </td>
            </tr>
            
            </table>

        </form>
        
    </div>
</div>






<?php include('partials/footer.php'); ?>


<?php
    //Eingabe von der Form in die Datenbank speichern
    //Checken ob der Eingabe Knopf gedrückt wurde oder nicht

    if(isset($_POST['Submit']))
    {
        //1. Get the Data from the Form
         $full_name = $_POST['full_name'];
         $rolle = $_POST['rolle'];
         $email = $_POST['email'];
         $password = md5($_POST['password']); //MD5 = Passwort Encryption
         $rechte = $_POST['rechte'];
         

         //2. SQL Datenbank speichert eingaben von Form
         $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            rolle='$rolle',
            email='$email',
            password='$password',
            rechte='$rechte'

         ";
        
        //3. Query Ausführen und Daten in Datenbank speichern
        $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conn)); //zur Datenbank verbinden
        $db_select = mysqli_select_db($conn ,'Mama Bringts') or die(mysqli_error($conn)); //Datenbank auswählen

        //3. Query ausführen und Daten in der Datenbank speichern
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Checkt ob die (Query ausgeführt wurde) Daten eingefügt wurden oder nicht und gibt eine angemessene Nachricht dafür aus
        if($res==TRUE)
        {   
            //Session Variable erstellen um die Nachricht anzuzeigen
            $_SESSION['add'] = "<div class='success'>Admin erfolgreich erstellt</div>";
            //Weiterleiten auf Manage-Admin
            header('location: manage-admin.php');
        }
        else
        {
            //Session Variable erstellen um die Nachricht anzuzeigen
            $_SESSION['add'] = "<div class='error'>Konnte Admin nicht erstellen</div>";
            //Weiterleiten auf Add Admin
            header('location: add-admin.php');
        }
        
    }

?>