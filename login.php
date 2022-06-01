<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <section class="login__wrapper">
            <?php
                include_once('./components/Nav.php');
            ?>
            <section class="login">
                <div class="container">
                    <div class="row">
                        <div class="login__form">
                            <form action="">
                            <h1 class="login__title">Login</h1>
                                <label class="email login__label">E-Mail</label>
                                <input type="email" class="email login__field" placeholder="john@doe.com">

                                <label class="email login__label">Wachtwoord</label>
                                <input type="password" class="password login__field" placeholder="••••••••••">

                                <div class="login__buttons">
                                    <a href="" class="login__buttons--forgot">Wachtwoord vergeten?</a>
                                    <button class="btn">Inloggen</button>
                                </div>
                                <small class="login__new"><a href="register.php">Heb je nog geen account? Klik hier!</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <?php 
                include_once('./components/Footer.php')
            ?>
        </section>
    </body>
</html>