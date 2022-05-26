<?php 

?>

<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./assets/css/style.css">
    </head>
    <body>
        <section id="landing">
            <?php
                include_once('./components/Nav.php');
            ?>
            <div class="header">
                <div class="header__description">
                    <h1 class="header__description--title">De sportschool voor jouw gezondheid</h1>
                    <p class="header__description--para">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Earum minus repellendus laudantium voluptates, sapiente nemo facere placeat? 
                        Officiis quod nisi velit? Natus voluptas non nisi! Nisi, alias! Voluptates, totam? Qui!
                    </p>
                    <button class="btn">Registreer je en laat je mening achter</button>
                </div>
                <figure class="header__banner">
                    <img src="./assets/img/header-banner.jpg" class="header__banner--img" alt="">
                </figure>
            </div>
        </section>
    </body>
</html>