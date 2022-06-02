<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <?php
            include_once('./dbConnection.php');
            include_once('./components/Nav.php');

            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_GET, $_POST['name'], FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_GET, $_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_GET, $_POST['password'], FILTER_SANITIZE_STRING);
                $passwordrepeat = filter_input(INPUT_GET, $_POST['passwordrepeat'], FILTER_SANITIZE_STRING);

                // if ($password == $passwordrepeat) {
                    $query = $db->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");

                    $query->bindParam("name", $name);
                    $query->bindParam("email", $email);
                    $query->bindParam("password", $password);

                    if($query->execute()) {
                        header("Location: ./index.php");
                    }// } else {
                    //     echo "<div class='row alert alert-error'>ERROR: Er is een fout opgetreden, probeer het later opnieuw.</div>";
                    // }
                // } else {
                //     echo "<div class='row alert alert-error'>ERROR: Wachtwoorden komen niet overeen.</div>";
                // }
            }
        ?>
            <section class="register">
                <div class="container">
                    <div class="row">
                        <div class="register__form">
                            <form method="POST">
                            <h1 class="register__title">REGISTER</h1>
                                <label class="name register__label">Naam</label>
                                <input type="text" class="name register__field" placeholder="John Doe" name="name">
                            
                                <label class="email register__label">E-Mail</label>
                                <input type="email" class="email register__field" placeholder="john@doe.com" name="email">

                                <label class="email register__label">Wachtwoord</label>
                                <input type="password" class="password register__field" placeholder="••••••••••" name="password">

                                <label class="email register__label">Herhaal Wachtwoord</label>
                                <input type="password" class="password register__field" placeholder="••••••••••" name="passwordrepeat">

                                <div class="register__buttons">
                                    <a href="" class="register__buttons--forgot">Wachtwoord vergeten?</a>
                                    <input type="submit" name="submit" class="btn" value="Registreren"></input>
                                </div>
                                <small class="register__new"><a href="login.php">Heb je al een account? Klik hier!</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        <?php 
            include_once('./components/Footer.php')
        ?>
    </body>
</html>