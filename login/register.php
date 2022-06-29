<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php
            include_once('../dbConnection.php');
            include_once('../components/Nav.php');
            include_once('../components/Alerts.php');

            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                $passwordrepeat = filter_input(INPUT_POST, "passwordrepeat", FILTER_SANITIZE_STRING);

                $hashpass = password_hash($password, PASSWORD_BCRYPT);
                $passcheck = password_verify($passwordrepeat, $hashpass);

                $users = $db->prepare("SELECT * FROM users WHERE email = :email");
                $users->bindParam("email", $email);
                $users->execute();
                $usersresult = $users->fetch(PDO::FETCH_ASSOC);

                if(!$usersresult) {
                    if ($passcheck) {
                        try{
                            $query = $db->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");

                            $query->bindParam("name", $name);
                            $query->bindParam("email", $email);
                            $query->bindParam("password", $hashpass);

                            if($query->execute()) {
                                $_SESSION['success'] = "Account is succesvol aangemaakt, je kan nu inloggen.";  
                                header("Location: ./login.php");
                            } else {
                                $_SESSION['error'] = "Er is een fout opgetreden, probeer het later opnieuw.";  
                                header("Location: ./register.php");              
                            }
                        }catch(PDOException $e){
                            echo "error! " . $e->getMessage();
                        }
                    } else {
                        $_SESSION['error'] = "Wachtwoorden komen niet overeen.";  
                        header("Location: ./register.php");              
                    }
                } else {
                    $_SESSION['error'] = "Het opgegeven email adress is al in gebruik.";  
                    header("Location: ./register.php");    
                }
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
                                <small class="register__new"><a href="/healthone/products/login.php">Heb je al een account? Klik hier!</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

    </body>
</html>