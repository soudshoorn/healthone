<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css?v=1">
    </head>
    <body>
        <section id="landing">
            <?php
                include_once('./components/Nav.php');
            ?>
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="header__wrapper">
                            <div class="header__description">
                                <h1 class="header__description--title">De sportschool voor jouw gezondheid</h1>
                                <p class="header__description--para">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                    Earum minus repellendus laudantium voluptates, sapiente nemo facere placeat? 
                                    Officiis quod nisi velit? Natus voluptas non nisi! Nisi, alias! Voluptates, totam? Qui!
                                </p>
                                <div class="header__button">
                                    <button class="btn">Registreer direct!</button>
                                </div>
                            </div>
                            <figure class="header__banner">
                                <img src="./assets/img/header-banner.jpg" class="header__banner--img" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="goals">
            <div class="container">
                <div class="row">
                    <div class="goals__wrapper">
                        <div class="goals__goal">
                            <i class="fas fa-dumbbell goals__icon"></i>
                            <div class="goals__goal--description">
                                <h1 class="goals__goal--title">Krachttraining</h1>
                                <p class="goal__goal--para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis ut repellendus consectetur.</p>
                            </div>
                        </div>
                        <div class="goals__goal">
                            <i class="fas fa-bicycle goals__icon"></i>
                            <div class="goals__goal--description">
                                <h1 class="goals__goal--title">Cardio</h1>
                                <p class="goal__goal--para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis ut repellendus consectetur.</p>
                            </div>
                        </div>
                        <div class="goals__goal">
                            <i class="fas fa-spa goals__icon"></i>
                            <div class="goals__goal--description">
                                <h1 class="goals__goal--title">Fysio</h1>
                                <p class="goal__goal--para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis ut repellendus consectetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>