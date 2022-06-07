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

                if(isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $login = $db->prepare("SELECT * FROM users WHERE email = :email");
                    $login->bindParam("email", $email);
                    $login->execute();
        
                    $result = $login->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as &$data) {
                        if($password == $data['password']) {

                            $_SESSION['user'] = $data['id'];
                            $_SESSION['username'] = $data['name'];

                            if ($data['role'] == 'admin') {
                                $_SESSION['admin'] = true;
                                header("Location: /healthone/admin/manageproduct.php");
                            } else if ($data['role'] == 'guest') {
                                $_SESSION['admin'] = false;
                            }

                            header("Location: /healthone/index.php");
                        } else {
                            $_SESSION['error'] = "Onjuist wachtwoord of email adres.";
                        }
                    }
                }
            ?>
            <section class="login">
                <div class="container">
                    <div class="row">
                        <div class="login__form">
                            <form method="POST">
                            <h1 class="login__title">Login</h1>
                                <label class="email login__label">E-Mail</label>
                                <input type="email" class="email login__field" name="email" placeholder="john@doe.com">

                                <label class="email login__label">Wachtwoord</label>
                                <input type="password" class="password login__field" name="password" placeholder="••••••••••">

                                <div class="login__buttons">
                                    <a href="" class="login__buttons--forgot">Wachtwoord vergeten?</a>
                                    <input type="submit" name="submit" class="btn" value="Inloggen"></input>
                                </div>
                                <small class="login__new"><a href="register.php">Heb je nog geen account? Klik hier!</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    </body>
</html>