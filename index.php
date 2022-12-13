<?php include('partials-front/menu.php')?>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center">Mama Bringts Menüs</h2>
            
            <?php
                //Zeigt Menüs an die auf Active gesetzt sind
                $sql ="SELECT * FROM tbl_food WHERE active='Yes'";

                //Query ausführen
                $res = mysqli_query($conn, $sql);

                //Rows zählen
                $count= mysqli_num_rows($res);

                //Schauen ob die Menüs verfügbar (Active) sind
                if($count>0)
                {
                    //Verfügbar
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Werte auslesen
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name =$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <?php
                                                //Bild verfügbar oder nicht
                                                if($image_name=="")
                                                {
                                                    //Bild nicht verfügbar
                                                    echo "<div class='error'>Das Bild ist nicht verfügbar</div>";
                                                }
                                                else
                                                {
                                                    //Bild verfügbar
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4><?php echo $title; ?></h4>
                                            <p class="food-price"><?php echo $price; ?></p>
                                            <p class="food-detail">
                                                <?php echo $description; ?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Jetzt Bestellen</a>
                                        </div>
                                    </div>

                        <?php
                    }

                }
                else
                {
                    //Nicht verfügbar
                    echo "<div class='error'>Das Menü wurde nicht gefunden!</div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>