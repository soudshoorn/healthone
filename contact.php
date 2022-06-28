<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <?php
            include_once('./components/Nav.php');
            include_once('./dbConnection.php');

        ?>

        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="contact__wrapper">
                        <div class="contact__map">
                            <iframe width="600" height="400" class="contact__map--iframe" src="https://maps.google.com/maps?q=Anthony%20fokkersingel&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                        <form action="post" class="contact__form">
                            <div class="contact__form--sub">
                                <div class="contact__form--wrapper">
                                    <label class="contact__form--label">Voornaam</label>
                                    <input type="text" name="firstname" class="contact__form--input" placeholder="John" required>
                                </div>

                                <div class="contact__form--wrapper">
                                    <label class="contact__form--label">Achternaam</label>
                                    <input type="text" name="lastname" class="contact__form--input" placeholder="Doe" required>
                                </div>
                            </div>

                            <div class="contact__form--sub">
                                <div class="contact__form--wrapper">
                                    <label class="contact__form--label">E-Mail</label>
                                    <input type="email" name="email" class="contact__form--input" placeholder="johndoe@gmail.com" required>
                                </div>

                                <div class="contact__form--wrapper">
                                    <label class="contact__form--label">Woonplaats</label>
                                    <input type="text" name="city" class="contact__form--input" placeholder="Den Haag" required>
                                </div>
                            </div>
                            
                            <div class="contact__form--submit">
                                <input type="submit" class="contact__form--submit btn" value="Verzenden">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



    </body>
</html>