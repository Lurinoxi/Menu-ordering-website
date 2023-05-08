<?php include('config/constants.php'); ?>
<?php include('login-check.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mama Bringts - S.I.E </title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="../food/index.php" title="Logo">
                    <img src="images/favicon.png" alt="Mama Bringts" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
					<li>
                        <a href="../food/abbestellen.php">Meine Bestellungen</a>
                    </li>
                    <li>
                        <a href="../food/Contact.php">Kontakt</a>
                    </li>
                    <?php if($_SESSION['rechte'] == 'admin'): ?>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/">Admin Panel</a>
                    </li>
                <?php endif; ?>

					<li>
                        <a href="../food/Logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
