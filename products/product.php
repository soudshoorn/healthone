<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
            <?php
                include_once('../components/Nav.php');
                include_once('../dbConnection.php');
                include_once('../components/Alerts.php');

                if(isset($_GET['createreview'])) {
                    echo "
                    <section class='reviews'>
                        <div class='container'>
                            <div class='row'>
                                <div class='review__wrapper'>
                                    <div class='review__create'>
                                        <form method='POST'>
                                            <div class='name__stars'>
                                                <label>Naam</label>
                                                <input name='name' type='text' class='name__review' disabled value='" . $_SESSION['username'] . "'>

                                                <label>Hoeveel sterren geef je?</label>
                                                <select name='stars'>
                                                    <option value='0'>0</option>
                                                    <option value='1'>1</option>
                                                    <option value='2'>2</option>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                </select>
                                            </div>

                                            <div class='description__submit'>
                                                <label>Mening</label>
                                                <textarea name='description'></textarea>
                
                                                <input class='btn' type='submit' name='reviewsubmit' value='Verzenden'>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    ";
                }

    
                $product = $db->prepare("SELECT * FROM products WHERE id = :id");
                $product->bindParam("id", $_GET['id']);
                $product->execute();
    
                $productresult = $product->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_POST['reviewsubmit'])) {
                    try {
                        $name = $_SESSION['username'];
                        $stars = filter_input(INPUT_POST, "stars", FILTER_SANITIZE_NUMBER_INT);
                        $product_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
    
                        $review = $db->prepare("INSERT INTO reviews(name, stars, description, product_id) VALUES(:name, :stars, :description, :product_id)");
    
                        $review->bindParam("name", $name);
                        $review->bindParam("stars", $stars);
                        $review->bindParam("description", $description);
                        $review->bindParam("product_id", $product_id);

                        if ($review->execute()) {
                            $_SESSION['success'] = "Je review is succesvol geplaatst.";
                        } else {
                            $_SESSION['error'] = "Er is iets fout gegaan, probeer later opnieuw.";
                        }
                    } catch (PDOException $e) {
                        echo "PDO Error: " . $e->getMessage();

                    }
        
                    $reviewresult = $review->fetchAll(PDO::FETCH_ASSOC);
                }

                if(isset($_GET['delete_review'])) {
                    $delete = "DELETE FROM reviews WHERE id=" . $_GET['delete_review'] ."";

                    $db->exec($delete);
                    $_SESSION['success'] = "Review succesvol verwijderd.";  
                    header("Location: ./product.php?id=".$_GET['id']."&reviews");  
                }
    
            ?>

        <section class="product">
            <div class="container">
                <div class="row">
                    <div class="product__wrapper">
                        <?php 
                            // Print elk product
                            foreach($productresult as &$data) {
                                if(isset($_GET['reviews'])) {
                                    echo "
                                    <div class='product__output'>
                                        <figure class='product__image'>
                                            <img src='../assets/img/" . $data['img'] ."' alt='' class='product__image--img'>
                                        </figure>
                                        <div class='product__description'>
                                            <div class='product__picker'>
                                                <ul class='product__picker--list'>
                                                    <li class='product__picker--link'><a href='product.php?id=".$_GET['id']."' class='product__link'>Beschrijving</a></li>
                                                    <li class='product__picker--link product__picker--active'><a href='product.php?id=".$_GET['id']."&reviews' class='product__link'>Reviews</a></li>
                                                </ul>
                                            </div>
                                    ";
                                } else {
                                    echo "
                                    <div class='product__output'>
                                        <figure class='product__image'>
                                            <img src='../assets/img/" . $data['img'] ."' alt='' class='product__image--img'>
                                        </figure>
                                        <div class='product__description'>
                                            <div class='product__picker'>
                                                <ul class='product__picker--list'>
                                                    <li class='product__picker--link product__picker--active'><a href='product.php?id=".$_GET['id']."' class='product__link'>Beschrijving</a></li>
                                                    <li class='product__picker--link'><a href='product.php?id=".$_GET['id']."&reviews' class='product__link'>Reviews</a></li>
                                                </ul>
                                            </div>
                                    ";
                                }
                                if(isset($_GET['reviews'])) {
                                    $reviews = $db->prepare("SELECT * FROM reviews WHERE product_id = :id");
                                    $reviews->bindParam("id", $_GET['id']);
                                    $reviews->execute();
                        
                                    $reviewsresult = $reviews->fetchAll(PDO::FETCH_ASSOC);

                                    if(!$reviewsresult) {
                                        echo "
                                        <div class='noreviews__wrapper'>
                                            <h3 class='noreviews__wrapper--title'>Er zijn nog geen reviews geplaatst.</h3>
                                            <a href='/healthone/products/product.php?id=".$_GET['id']."&reviews&createreview' class='btn manageproducts__create--btn'>Nieuw  <i class='fas fa-plus'></i></a>
                                        </div>
                                        ";
                                    } else if (!isset($_SESSION['user'])) {
                                        echo "
                                        <div class='noreviews__wrapper'>
                                            <h3 class='noreviews__wrapper--title'>Je moet ingelogd zijn om een review te plaatsen.</h3>
                                            <a href='/healthone/login/login.php' class='btn'>Login</a>
                                        </div>
                                        ";
                                    }

                                    foreach($reviewsresult as &$data) {
                                        if(isset($_SESSION['admin'])) {
                                            echo "
                                            <div class='noreviews__wrapper'>
                                                <h3 class='noreviews__wrapper--title'>Plaats ook een review.</h3>
                                                <a href='/healthone/products/product.php?id=".$_GET['id']."&reviews&createreview' class='btn manageproducts__create--btn'>Nieuw  <i class='fas fa-plus'></i></a>
                                            </div>
                                            <table>
                                            <tr class='reviews__top'>
                                                <th>Naam</th>
                                                <th>Sterren</th>
                                                <th>Mening</th>
                                            </tr>
                                            <tr>
                                                <td>" . $data['name'] . "</td>
                                                <td>" . $data['stars'] . "</td>
                                                <td>" . $data['description'] . "</td>
                                                <td class='delete__review'><a href='/healthone/products/product.php?id=".$_GET['id']."&delete_review=".$data['id']."&reviews' class='btn__delete--review'><i class='fas fa-times'></i></a></td>
                                            </tr>
                                            ";
                                        } else {
                                            echo "
                                            <table>
                                            <tr class='reviews__top'>
                                                <th>Naam</th>
                                                <th>Sterren</th>
                                                <th>Mening</th>
                                            </tr>
                                            <tr>
                                                <td>" . $data['name'] . "</td>
                                                <td>" . $data['stars'] . "</td>
                                                <td>" . $data['description'] . "</td>
                                            </tr>
                                            ";
                                        }
                                    }
                                    echo "</table>";
                                } else {
                                    echo "
                                        <h3 class='product__description--title'>" . $data['name'] . "</h3>
                                        <p class='product__description--para'> " . $data['description'] . " </p>
                                    ";
                                }
                                echo "
                                    </div>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>