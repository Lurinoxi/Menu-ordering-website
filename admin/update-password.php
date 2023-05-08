<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
    <h1>Change Password</h1>
    <br><br>

    <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
    ?>

    <form action="" method="POST">
    
        <table class="tbl-30">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Old Password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password:  </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
            
        </table>

    </form>

    </div>
</div>


<?php

                //Schauen ob der Button gedrückt wurde oder nicht
                if(isset($_POST['submit']))
                {
                    //1. Daten ziehen von dem Formular 
                    $id=$_POST['id'];
                    $current_password = md5($_POST['current_password']);
                    $new_password = md5($_POST['new_password']);
                    $confirm_password = md5($_POST['confirm_password']);


                    //2. Schauen ob der User mit ID und Passwort existiert oder nicht
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                    //Query ausführen
                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        //Schauen ob Daten verfügbar sind oder nicht
                        $count=mysqli_num_rows($res);

                        if($count==1)
                        {
                            //User existiert und Password kann geändert werden
                            //echo "Benutzer Gefunden";
                            //Schauen ob das neue Password mit dem Confirm Passwort übereinstimmen
                            if($new_password==$confirm_password)
                            {
                                //Password Update
                                //echo "Password stimmt überein";
                                $sql2 = "UPDATE tbl_admin SET 
                                    password='$new_password'
                                    WHERE id=$id
                                ";

                                //Query ausführen
                                $res2 = mysqli_query($conn, $sql2);

                                //Schauen ob die Query ausgeführt wurde oder nicht
                                if($res2==true)
                                {
                                    //Success Message Anzeigen
                                    $_SESSION['change-pwd'] = "<div class='success'>Password erfolgreich geändert! </div>";
                                    //Weiterleiten auf Admin Page mit Success Message
                                    header('location:'.SITEURL.'admin/manage-admin.php');
                                }
                                else
                                {
                                    //Error Message Anzeigen
                                    $_SESSION['change-pwd'] = "<div class='error'>Password konnte nicht geändert werdebn! </div>";
                                    //Weiterleiten auf Admin Page mit Error Message
                                    header('location:'.SITEURL.'admin/manage-admin.php');
                                }
                            }
                            else
                            {
                                //Weiterleiten auf Admin Page mit Error Nachricht
                                $_SESSION['pwd-not-match'] = "<div class='error'>Password stimmt nicht überein! </div>";
                            //Weiterleiten
                            header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //User existiert nicht, Nachricht anzeigen und weiterleiten
                            $_SESSION['user-not-found'] = "<div class='error'>Benutzer wurde nicht gefunden. </div>";
                            //Weiterleiten
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    //3. Schauen ob das Neue Password mit dem Confirm Password einstimmt oder nicht


                    //4. Password updaten wenn alles zustimmt

                }

?>


<?php include('partials/footer.php');?>