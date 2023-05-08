<?php include('partials-front/menu.php')?>

    <!-- Menü anzeige -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center">Mama Bringts Menüs</h2>              
			<html>
<head>
    <title></title>
    <link rel="stylesheet" href="css/dropdown.css">
</head>
<body>
    <div class="dropdown-container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name='kwlist'>
                <option value="">--- Aktuelle Woche ---</option>

                <?php
                $sql = "SELECT KW, Year from tbl_food ORDER BY `tbl_food`.`Year`, `tbl_food`.`KW` ASC LIMIT 3;";
                $res = mysqli_query($conn, $sql);
                $count= mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $KW = $row['KW'];
                        $year = $row['Year'];
                        echo '<option value="'.$KW.'/'.$year.'">'.$KW.' / '.$year.'</option>';
                    }
                }
                ?>
            </select>
            <input type="submit" name="Submit" value="Auswählen" />
        </form>
    </div>
</body>
</html>



            <?php
            if(isset($_SESSION['order']))
            {
               echo $_SESSION['order'];
               unset($_SESSION['order']);
            }
           ?>

            <?php
                //Generiert die Menü anzeige

                if(isset($_POST['kwlist']) && $_POST['kwlist'] != "")
                {
                    $kwyear = explode("/", $_POST['kwlist']);
                    //echo $kwyear[0]; // KW
                    //echo $kwyear[1]; // Jahr
                    $sql = "SELECT * FROM tbl_food WHERE `KW` =$kwyear[0] AND `Year` =$kwyear[1]";
                    
                }
                else
                {
                    $actual_kw = date('W');
                    $actual_year = date('Y');
                    $sql = "SELECT * FROM tbl_food WHERE `KW` = $actual_kw AND `Year` = $actual_year";
                }

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
						$active = $row['active'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name =$row['image_name'];
                        $kw = $row['KW'];
                        $year = $row['Year'];
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
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="hallo :D" class="img-responsive img-curve">
                                                    <?php
                                                }
                                            ?>
                                            
                                            
                                        </div>


                                        <div class="food-menu-desc">
                                            <h4><?php echo $title; ?></h4>
                                            <p class="food-price">€<?php echo $price; ?></p>
                                            <p class="food-KW">KW: <?php echo $kw . ' / ' . $year; ?>
                                            <p class="food-detail"><?php echo $description; ?>
                                            </p>
                                            <br>
											<?php
										if($active=="Yes")
										{
										?>
										<a href=" <?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Jetzt Bestellen</a>
										<?php
										}
										else
										{
										echo "Menü ist nicht mehr Verfügbar";
										}
										?>

                                        </div>
                                    </div>

                        <?php
                    }

                }
                else
                {
                    //Nicht verfügbar
                    echo "<div class='error'>Für diese Woche wurden noch keine Menüs erstellt!</div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menü Ende -->

    <?php include('partials-front/footer.php')?>