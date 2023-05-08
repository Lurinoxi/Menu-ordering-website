<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Mama Bringts</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Startet hier -->
            <form action="" method="POST" class="text-center">
            E-Mail:<br>
            <input type="text" name="email" placeholder="Enter E-Mail"><br><br>
            
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Endet hier -->

            <p class="text-center">Created by - Lurinoxi</a></p>
        </div>
    
    </body>

</html>

<?php

    //Schauen ob Login geklickt oder nicht
    if(isset($_POST['submit']))
    {
        //Login Processen
        //1. Daten von Login Formular ziehen
         $email = $_POST['email'];
         $password = md5($_POST['password']);
         

         //2. Schauen ob Username und Passwort existieren oder nicht
         $sql = "SELECT * FROM tbl_admin WHERE email='$email' and password='$password' and rechte='admin'";

         //3. Query ausführen
         $res = mysqli_query($conn, $sql);

         //4. Rows zählen um zu schauen ob User existiert oder nicht
         $count = mysqli_num_rows($res);

         if($count==1)
         {
            //User gibts & Login funkt
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $email; //Schaut ob dr User eingelogt ist oder nicht, logout wird es unset'n
            //Weiterleiten auf Home Page
            header('location:'.SITEURL.'admin/');


         }
         else
         {
            //User gibts nicht & Login funkt nicht
            $_SESSION['login'] = "<div class='error text-center'>Benutzername oder Passwort sind falsch!</div>";
            //Weiterleiten auf Login Page
            header('location:'.SITEURL.'admin/login.php');

         }

    }



?>
