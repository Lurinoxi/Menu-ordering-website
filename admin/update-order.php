<?php include('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        
            //Schauen ob ID gesetzt ist oder nicht
            if(isset($_GET['id']))
            {
                //ORder Details holen
                $id=$_GET['id'];
                //Query um Details zu ziehen
                $sql= "SELECT * FROM tbl_order WHERE id=$id";
                //Query ausführen
                $res=mysqli_query($conn, $sql);
                //Rows zählen
                $count = mysqli_num_rows($res);
                
                if($count==1)
                {
                    //Details verfügbar
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $order_date = $row['order_date'];
                    $email = $row['email'];
                }
                else
                {
                    //Details nicht verfügbar, Weiterleiten
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Weiterleiten auf Manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Menü Name</td>
                    <td><b><?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>Preis</td>
                    <td><b> € <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Datum</td>
                    <td><b><?php echo $order_date; ?></b></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="order_date" value="<?php echo $order_date; ?>">

							<input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <?php
            //Check ob Update Button gedrückt wurde
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Werte von Form holen
                $id = $_POST['id'];
                $order_date = $_POST['order_date'];
                $price = $_POST['price'];
                $email = $_POST['email'];

                //Werte updaten
                $sql2 = "UPDATE tbl_order SET
                    email = '$email'
                    WHERE id=$id
                ";

                //ausführen
                $res2 = mysqli_query($conn, $sql2);
                //Schauen ob  updated wurde
                //Weiterleiten auf Mng Order
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Bestellung wurde erfolgreich geändert!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Bestellung konnte nicht geändert werden!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>