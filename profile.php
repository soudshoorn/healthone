<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
            <?php
                include_once('./dbConnection.php');
                include_once('./components/Nav.php');
                include_once('./components/Alerts.php');

                if(($_GET['user'] != $_SESSION['user']) || (!isset($_SESSION['user']))) {
                    header("Location: ./index.php");
                }

                $user = $db->prepare("SELECT * FROM users WHERE id = :id");
                $user->bindParam("id", $_GET['user']);
                $user->execute();
    
                $result = $user->fetch(PDO::FETCH_ASSOC);

                if (isset($_POST['editprofile'])) {
                    $users = $db->prepare("SELECT * FROM users");
                    $users->execute();
        
                    $result = $users->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result as $data) {

                        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                        $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING);
                        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                        $passwordrepeat = filter_input(INPUT_POST, "passwordrepeat", FILTER_SANITIZE_STRING);

                        if (($data['email'] !== $email) && ($password == $passwordrepeat)) {
                            $userupdate = $db->prepare("UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE id = :id");

                            $userupdate->bindParam("name", $name);
                            $userupdate->bindParam("email", $email);
                            $userupdate->bindParam("role", $role);
                            $userupdate->bindParam("password", $password);
                            $userupdate->bindParam("id", $_GET['user']);

                            if($userupdate->execute()) {
                                $_SESSION['success'] = "De nieuwe gegevens zijn succesvol opgeslagen.";
                                header("Location: ./profile.php?user=".$_SESSION['user']."");
                            } else {
                                $_SESSION['error'] = "Er is een fout opgetreden tijdens het opslaan van de nieuwe gegevens.";
                                header("Location: ./profile.php?user=".$_SESSION['user']."");
                            }
                        } else if ($password !== $passwordrepeat) {
                            $_SESSION['error'] = "De wachtwoorden komen niet overeen.";
                            header("Location: ./profile.php?user=".$_SESSION['user']."");
                        } else if ($data['email'] == $email) {
                            $_SESSION['error'] = "Dit email adres is al in gebruik.";
                            header("Location: ./profile.php?user=".$_SESSION['user']."");
                        } else {
                            $_SESSION['error'] = "Er is een onbekende fout opgetreden.";
                            header("Location: ./profile.php?user=".$_SESSION['user']."");
                        }
                    }
                }

            ?>
            <section class="profile">
                <div class="container">
                    <div class="row">
                        <div class="profile__header">
                            <h3 class="profile__header--title">Hallo, <?php echo $result['name']; ?></h3>
                        </div>
                        <div class="profile__edit">
                            <h5 class="profile__edit--title">Pas uw account aan.</h5>
                            <div class="profile__edit--wrapper">
                                <form method="POST">
                                    <div class="profile__edit--top">
                                        <div class="profile__sub--wrapper">
                                            <label class="name register__label">Naam</label>
                                            <input type="text" class="name register__field" placeholder="John Doe" name="name">
                                        </div>

                                        <div class="profile__sub--wrapper">
                                            <label class="email register__label">E-Mail</label>
                                            <input type="email" class="email register__field" placeholder="john@doe.com" name="email">
                                        </div>
                                    </div>

                                    <div class="profile__edit--bottom">
                                        <div class="profile__sub--wrapper">
                                            <label class="email register__label">Wachtwoord</label>
                                            <input type="password" class="password register__field" placeholder="••••••••••" name="password">
                                        </div>

                                        <div class="profile__sub--wrapper">
                                            <label class="email register__label">Herhaal Wachtwoord</label>
                                            <input type="password" class="password register__field" placeholder="••••••••••" name="passwordrepeat">
                                        </div>
                                    </div>

                                    <input type="submit" class="btn" value="Bevestigen" name="editprofile">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </body>
</html>