
<?php include('partials/menu.php'); ?>

        <!-- Main Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <br><br>

                <div class="col-3">

                    <?php
                            //SQL Query
                            $sql = "SELECT * FROM tbl_food";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);               
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Menüs
                </div>

                <div class="col-3">

                <?php
                            //SQL Query
                            $sql = "SELECT * FROM tbl_order";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);               
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Bestellungen
                </div>

                <div class="col-3">

                <?php
                            //SQL Query
                            $sql = "SELECT * FROM tbl_admin";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);               
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Benutzer
                </div>

                <div class="clearfix"></div>

            </div>
            <!-- Main Content Section Ende -->


<?php include('partials/footer.php'); ?>
