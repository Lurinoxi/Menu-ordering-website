<?php include('partials-front/menu.php')?>

    <?php
        //Menü ID da?
        if(isset($_GET['food_id']))
        {
            //Menü id und details ziehen
            $food_id = $_GET['food_id'];

            //Details von ausgewähltem Menü
            $sql ="SELECT * FROM tbl_food WHERE id=$food_id";
            //Ausführen 
            $res = mysqli_query($conn, $sql);
            //Rows zählen
            $count = mysqli_num_rows($res);
            //Schauen ob daten verfügbar sind oder nd
            if($count==1)
            {
                //Daten da
                //Daten aus DB ziehen
                $row=mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $kw = $row['KW'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Daten nicht da 
                //Weiterleiten auf Homepage
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Weiterleiten auf Homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- Start -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-Black">Füllen Sie dieses Formular aus um die Bestellung abzuschicken.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        
                            //Schauen ob Bild verfügbar
                            if($image_name=="")
                            {
                                //Nicht verfügbar
                                echo "<div class='error'>Bild wurde nicht gefunden.</div>";
                            }
                            else
                            {
                                //Verfügbar
                                ?>
                                <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }
                        
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">€<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <p class="food-kw">KW: <?php echo $kw; ?></p>
                        <input type="hidden" name="KW" value="<?php echo $kw; ?>">

                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Max Mustermann" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. Max.Mustermann@sie.at" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                //Order button gedrückt oder nicht
                if(isset($_POST['submit']))
                {
                    //Alle Details von dem Formular ziehen

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $kw = $_POST['KW'];
                    $order_date = date("Y-m-d"); //Bestell Zeit
                    $email = $_POST['email'];


                    // Bestellung in DB sichern
                    //SQL erstellen
                    $sql2 = "INSERT INTO tbl_order SET
                        food ='$food',
                        price ='$price',
                        KW ='$kw',
                        order_date ='$order_date',
                        email ='$email'
                    ";

                    //query ausführen
                    $res2 = mysqli_query($conn, $sql2);

                    //Schauen ob query ausgeführt wurde
                    if($res2==true)
                    {
                        //Query ausgeführt
                        $_SESSION['order'] = "<div class='success text-center'>Bestellung abgeschickt!</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Query nicht ausgeführt
                        echo "<div class='error text-center'>Bestellung konnte nicht abgeschickt werden!</div>";
                        header('location:'.SITEURL);
                    }


                }

            ?>

        </div>
    </section>
<!-- Stop -->
    <?php include('partials-front/footer.php')?>