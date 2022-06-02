<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php
            include_once('../components/Nav.php');
            include_once('../dbConnection.php');

            $category = $db->prepare("SELECT * FROM categories");
            $category->execute();

            $result = $category->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="categories">
            <div class="container">
                <div class="row">
                    <h3 class="categories__title">Categorieën</h3>
                    <div class="categories__wrapper">
                        <?php 
                            // Print alle categorieen
                            foreach($result as &$data) {
                                echo "
                                <div class='category'>
                                    <figure class='category__image'>
                                        <img src='../assets/img/" . $data['img'] ."' alt='' class='category__image--img'>
                                    </figure>
                                    <div class='category__description'>
                                        <h3 class='category__description--title'>" . $data['name'] . "</h3>
                                        <a href='apparaten.php?id=" . $data['id'] . "'><button class='btn'>Meer Details</button></a>
                                    </div>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php

            include_once('../components/Footer.php');
        ?>
    </body>
</html>