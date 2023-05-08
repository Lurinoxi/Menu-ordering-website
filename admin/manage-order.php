<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Bestellungen Verwalten</h1>

    <br /><br />

    <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
    ?>
        <br><br>


<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Food</th>
        <th>Price</th>
        <th>KW</th>
        <th>Order Date</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php
        //BEstellungen von DB ziehen
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Bestellung ordnen
        //Ausfhren
        $res = mysqli_query($conn, $sql);
        //Rows zählen
        $count = mysqli_num_rows($res);

        //Erstellt Serial Number und setzt den Wert auf 1
        $sn =1; 
        
        if($count>0)
        {
            //Verfügbar
            while($row=mysqli_fetch_assoc($res))
            {
                //BEstellungs DEtals ziehen
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $kw = $row['KW'];
                $order_date = $row['order_date'];
                $email = $row['email'];
                
                ?>

                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $food ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $kw ?></td>
                    <td><?php echo $order_date ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Order</a> 
                    </td>
                </tr>
                <?php

            }
        
        }
        else
        {
            //Nicht verfügbar
            echo "<tr><td colspan='6' class='error'>Es sind derzeit keine Bestellungen vorhanden</td></tr>";
        }
    ?>

</table>

    </div>

</div>

<?php include('partials/footer.php') ?>