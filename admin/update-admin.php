<?php include('partials/menu.php')  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>

        <br><br>

        <?php
                  //1. ID vom Admin ziehen
                $id=$_GET['id'];
                  //2. Query erstellen um die Details zu ziehen
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //Query ausführen
                $res=mysqli_query($conn, $sql);

                //Schauen ob die query ausgeführt wird oder nd
                if($res==true)
                {
                    // Schauen ob die Daten verfügbar sind oder nich
                    $count = mysqli_num_rows($res);
                    //Schauen ob wir Admin Daten haben oder nicht
                    if($count==1)
                    {
                        //Details ziehen
                        $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $rolle = $row['rolle'];
						$email = $row['email'];
                        $rechte = $row['rechte'];
                    }
                    else
                    {
                        //Auf Manage Page weiterleiten
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

        ?>

        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Rolle</td>
                    <td>
                        <input type="text" name="rolle" value="<?php echo $rolle; ?>">
                    </td>
                </tr>

				<tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Rechte</td>
                    <td>
                        <input type="rechte" name="rechte" value="<?php echo $rechte; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
    </form>

    </div>
</div>

<?php

    //Schauen ob Submit Button gedrückt wurde oder nicht
    if(isset($_POST['submit']))
    {
        //Die Values von dem Formular updaten
        $ID = $_POST['id'];
        $full_name = $_POST['full_name'];
        $rolle = $_POST['rolle'];
		$email = $_POST['email'];
        $rechte = $_POST['rechte'];
        

        //SQL Query erstellen um die Admins zum Updaten
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        rolle = '$rolle',
        email = '$email',
        rechte = '$rechte',
        WHERE id='$id'
        ";


        //Query auführen 
        

        $res = mysqli_query($conn, $sql);

        //Schauen ob Query ausgeführt wird oder nich
        if($res==true)
        {
            //Query wird ausgeführt und Admin wurde Updated
            $_SESSION['update'] = "<div class='success'Admin Updated Sucessfully.</div>";
            //Weiterleiten auf Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Admin konnte nicht Updated werden 
            $_SESSION['update'] = "<div class='error'Admin could not be Updated.</div>";
            //Weiterleiten auf Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php')  ?>