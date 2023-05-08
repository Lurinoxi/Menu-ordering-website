<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Menüs Verwalten</h1>

    <br /><br />

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); 
        }

        if (isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        
    ?>

    <!-- Button to add Menu -->
	<br><br>

    <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Menü hinzufügen</a>

    <br><br><br>
    

<table class="tbl-full">
    <tr>
    <th>S.N.</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Active</th>
    <th>KW</th>
    <th>Actions</th>
    </tr>
<tr>
    <?php
    
        //SQL Query erstellen um die Items zu ziehen
        $sql ="SELECT * FROM tbl_food";
        //Query ausführen
        $res = mysqli_query($conn, $sql);

        //Rows zählen um zu schauen ob wir Menüs haben oder nicht (sind meist 1-2)
        $count = mysqli_num_rows($res);

        //Serial Number Variable erstlelen und Default wert auf 1 stellen
        $sn=1;

        if($count>0)
        {
            //Wir haben Menüs in DB
            //Menüs von DB anzeigen
            while($row=mysqli_fetch_assoc($res))
            {
                //Wert von individuellen Columns holen
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $active = $row['active'];
                $kw = $row['KW'];
                $year = $row['Year'];
                ?>

                    <td><?php echo $sn++; ?></td>                        
                    <td><?php echo $title; ?></td>
                    <td>€<?php echo $price; ?></td>
                    <td>
                        <?php 
                            //Schauen ob wir ein Image haben oder nicht wenn nicht text display wenn schon image display
                            if($image_name=="")
                            {
                                //Kein Bild
                                echo "<div class='error'>Kein Bild verfügbar</div>";
                            }
                            else
                            {
                                //Bild da
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $active; ?></td>
                    <td><?php echo $kw.' / '.$year; ?></td>
                    
                    <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Menu</a> 
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" >Delete Menu</a> 
                    </td>
                    </tr>
                    

                <?php
                
                
            }
        }
        else
        {
            //Keine Menüs in der DB
            echo "<tr> <td colspan='6'class='error'> Es sind noch keine Menüs erstellt worden! </td> </tr>";
        }
    ?>
</table>

    </div>

</div>

<?php include('partials/footer.php') ?>