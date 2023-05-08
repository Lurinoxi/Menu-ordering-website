<?php include('partials/menu.php'); ?>

        <!-- Main Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Administrator Verwaltung</h1>
                <br /><br /><br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Zeigt Session Nachricht an
                        unset($_SESSION['add']); //Entfernt Session Nachricht
                    }

                    if(isset($_SESSION['delete']))
                    {
                        Echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br><br>

                <!-- Button to add Admin -->
                <a href="add-admin.php" class="btn-primary">Add User</a>
            

                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>E-Mail</th>
                    <th>Actions</th>
                    </tr>

                    <?php
                        //Fügt alle Admins zum Table hinzu
                        $sql = "SELECT * FROM tbl_admin";
                        //Führt die Query aus
                        $res = mysqli_query($conn, $sql);

                        //Schaut nach ob die Query ausgeführt wurde oder nicht
                        if($res==TRUE)
                        {
                            // Zählt die Zeilen in der Datenbank um zu schauen ob wir Daten in der Bank haben oder nicht
                            $count = mysqli_num_rows($res); // Holt sich alle Zeilen der Datenbank

                            $sn=1; //Created die Variablen und Weisst die den Admins zu 

                            //Checkt die Anzahl von Zeilen
                            if($count>0)
                            {
                                //Haben Daten in Datenbank         
                                while($rows=mysqli_fetch_assoc($res))       
                                {
                                    //Benutzen While loop um die Daten in der Datenbank zu bekommen
                                    //Der Loop lauft so lang wir Daten haben

                                    //Individuelle Daten ziehen
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $email=$rows['email'];

                                    //Values im Table anzeigen
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>    
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary" >Update User</a> 
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" >Delete User</a> 
                                        </td>
                                    </tr>
                                    <?php
                                    
                                    
                                }              
                            }
                            else
                            {
                                //Wir haben keine Daten in der Datenbank

                            }
                        }
                    ?>

                    
                </table>
                <!-- Button Ende -->


            </div>

</div>
            <!-- Main Content Section Ende -->

<?php include('partials/footer.php'); ?>
