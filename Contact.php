<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title>Kontaktiere Uns!</title>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../food/css/contact-us.css">
        <body>
        <div class="logo">
                <a href="../food/index.php" title="Logo">
                    <img src="images/Menu Logo.png" alt="Mama Bringts" class="img-responsive">
                </a>
            </div>
            <div class="container">
                <h1>Kontaktiere Uns</h1>
                <p>Bitte sende uns hier dein Anliegen, unser Team wird sich schnellstmöglich drum kümmern!</p>
                <form action="mail.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="name" name="name" id="name">
                    <label for="email">E-Mail:</label>
                    <input type="email" name="email">
                    <label for="anliegen">Ihr Anliegen:</label>
                    <input type="anliegen" name="anliegen">
                    <label for="message">Message:</label>
                    <textarea name="message" cols="30" rows="10"></textarea>
                    <input type="submit" value="Absenden">
                </form>

            </div>
        </body>
    </head>
</html>