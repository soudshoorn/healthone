<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
            <?php
                include_once('../components/Nav.php');

                include_once('../components/Nav.php');
                include_once('../dbConnection.php');
    
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

                        echo $name, $stars, $description, $product_id;
    
                        if ($review->execute()) {
                            echo "<div class='row alert alert-success'>Het nieuwe product is toegevoegd.</div>";
                        } else {
                            echo "<div class='row alert alert-error'>ERROR: Er is iets fout gegaan, probeer later opnieuw.</div>";
                        }
                    } catch (PDOException $e) {
                        echo "PDO Error: " . $e->getMessage();

                    }
        
                    $reviewresult = $review->fetchAll(PDO::FETCH_ASSOC);
                }

                if(isset($_GET['delete_review'])) {
                    $delete = "DELETE FROM reviews WHERE id=" . $_GET['delete_review'] ."";

                    $db->exec($delete);
                    echo "<div class='row alert alert-success'>Review succesvol verwijderd.</div>";

                }
    
            ?>

        <section class="product">
            <div class="container">
                <div class="row">
                    <div class="product__wrapper">
                        <?php 
                            // Print elk product
                            foreach($productresult as &$data) {
                                echo "
                                <div class='product__output'>
                                    <figure class='product__image'>
                                        <img src='../assets/img/" . $data['img'] ."' alt='' class='product__image--img'>
                                    </figure>
                                    <div class='product__description'>
                                        <h3 class='product__description--title'>" . $data['name'] . "</h3>
                                        <p class='product__description--para'> " . $data['description'] . " </p>
                                    </div>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="reviews">
            <div class="container">
                <div class="row">
                    <div class="reviews__wrapper">
                        <table>
                            <tr class="reviews__top">
                                <th>Naam</th>
                                <th>Sterren</th>
                                <th>Mening</th>
                            </tr>
                            <?php 
                                $reviews = $db->prepare("SELECT * FROM reviews WHERE product_id = :id");
                                $reviews->bindParam("id", $_GET['id']);
                                $reviews->execute();
                    
                                $reviewsresult = $reviews->fetchAll(PDO::FETCH_ASSOC);
                                foreach($reviewsresult as &$data) {
                                    if($_SESSION['admin'] == false) {
                                        echo "
                                        <tr>
                                            <td>" . $data['name'] . "</td>
                                            <td>" . $data['stars'] . "</td>
                                            <td>" . $data['description'] . "</td>
                                        </tr>
                                        ";
                                    } else if($_SESSION['admin'] == true) {
                                        echo "
                                        <tr>
                                            <td>" . $data['name'] . "</td>
                                            <td>" . $data['stars'] . "</td>
                                            <td>" . $data['description'] . "</td>
                                            <td><a href='/healthone/products/product.php?id=".$_GET['id']."&delete_review=".$data['id']."' class='btn'><i class='fas fa-times'></i></a></td>
                                        </tr>
                                        ";
                                    }
                                }
                            ?>
                        </table>
                    </div>
                    <div class="review__wrapper">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "
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
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>