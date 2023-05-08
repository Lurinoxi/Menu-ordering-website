<html>
<link rel="stylesheet" type="text/css" href="css/abbestellen.css">
</html>


<?php 
include('partials-front/menu.php');
require_once('config/constants.php');

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['email'])) {
    // Benutzer ist nicht eingeloggt, weiterleiten zur Login-Seite
    $_SESSION['no-login-message'] = 'Bitte melde dich an, um auf deine Bestellungen zuzugreifen.';
    header('location:'.SITEURL.'login.php');
}

// Email des eingeloggten Benutzers abrufen
$email = $_SESSION['email'];

?>

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
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
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
        $sql = "SELECT * FROM tbl_order WHERE email='$email' ORDER BY id DESC"; //Bestellungen des eingeloggten Benutzers abrufen und ordnen
        //Ausfhren
        $res = mysqli_query($conn, $sql);
        //Rows zählen
        $count = mysqli_num_rows($res);

        //Erstellt Serial Number und setzt den Wert auf 1
        $sn = 1; 
        
        if($count > 0)
        {
            //Verfügbar
            while($row = mysqli_fetch_assoc($res))
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
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $food ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $kw ?></td>
                    <td><?php echo $order_date ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>delete-order.php?id=<?php echo $id; ?>" class="btn-secondary" onclick="return confirm('Möchten Sie die Bestellung wirklich löschen?')">Bestellung löschen</a>
                    </td>
                </tr>
                <?php

            }
        
        }
        else
        {
            echo "<tr><td colspan='7' style='text-align:center; font-weight:bold; color:red;'>Es sind derzeit keine Bestellungen vorhanden</td></tr>";
        }
    ?>

</table>

    </div>

</div>

<?php include('partials-front/footer.php') ?>
