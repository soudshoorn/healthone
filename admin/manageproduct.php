<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
            <?php
                include_once('../dbConnection.php');   
                include_once('../components/Nav.php');

                if (isset($_POST['submit'])) {

                    $file = $_FILES['file'];


                    $fileError = $file['error'];
                    $fileTmp = $file['tmp_name'];
                    $fileName = $file['name'];
                    $fileSize = $file['size'];

                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = array('jpg', 'jpeg', 'png');

                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileError === 0) {
                            if ($fileSize < 500000) {
                                $fileNameNew = uniqid('', true).".".$fileActualExt;
                                $fileDestination = '../assets/img/'.$fileNameNew;
                                move_uploaded_file($fileTmp, $fileDestination);

                                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING);
                                $file = filter_input(INPUT_POST, $fileNameNew, FILTER_SANITIZE_STRING);
                                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
            
            
                                $query = $db->prepare("INSERT INTO products(name, img, description, category_id) VALUES(:name, :img, :description, :category_id)");
            
                                $query->bindParam("name", $name);
                                $query->bindParam("img", $fileNameNew);
                                $query->bindParam("description", $description);
                                $query->bindParam("category_id", $category);
                                if ($query->execute()) {
                                    echo "<div class='row alert alert-success'>Het nieuwe product is toegevoegd.</div>";
                                } else {
                                    echo "<div class='row alert alert-error'>ERROR: Er is iets fout gegaan, probeer later opnieuw.</div>";
                                }
                                echo "<br />";
                            } else {
                                echo "<div class='row alert alert-error'>ERROR: Dit bestand is te groot.</div>";
                            }
                        } else {
                            echo "<div class='row alert alert-error'>ERROR: Er is iets fout gegaan, probeer later opnieuw.</div>";
                        }
                    } else {
                        echo "<div class='row alert alert-error'>ERROR: Verboden bestandstype. Alleen jpg, jpeg & png's zijn toegestaan.</div>";
                    }
                }
            ?>

            <section class="manageproducts">
                <div class="container">
                    <div class="row">
                        <table class="manageproducts__table">
                            <tr>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>Image</th>
                                <th>Beschrijving</th>
                                <th>Categorie</th>
                            </tr>
                        <?php 
                            $category = $db->prepare("SELECT * FROM products");
                            $category->execute();
                
                            $result = $category->fetchAll(PDO::FETCH_ASSOC);

                            foreach($result as &$data) {
                                echo "
                                <tr>
                                    <td>" . $data['id'] . "</td>
                                    <td>" . $data['name'] . "</td>
                                    <td>" . $data['img'] . "</td>
                                    <td>" . $data['description'] . "</td>
                                    <td>" . $data['category_id'] . "</td>
                                    <td><a href='/healthone/admin/manageproduct.php?deleteproduct=" . $data['id'] . "' class='btn'><i class='fas fa-times'></i></a></td>
                                </tr>
                                ";
                            }

                            if(isset($_GET['deleteproduct'])) {
                                $delete = "DELETE FROM products WHERE id=" . $_GET['deleteproduct'] ."";

                                $db->exec($delete);
                                echo "<div class='row alert alert-success'>Product succesvol verwijderd.</div>";
                            }

                            if(isset($_GET['deletesuccessful'])) {
                                echo "<div class='row alert alert-success'>Het product is succesvol verwijderd.</div>";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </section>
            <section class="addproduct">
                <div class="container">
                    <div class="row">
                        <form method="POST" enctype="multipart/form-data">
                            <label>Categorie</label>
                            <select name="category">
                                <option value="1">Crosstrainers</option>
                                <option value="2">Loopbanden</option>
                            </select>
        
                            <label>Naam</label>
                            <input type="text" name="name" required>
        
                            <label>Foto</label>
                            <input type="file" name="file" required>
        
                            <label>Beschrijving</label>
                            <textarea name="description" required></textarea>
        
                            <input class="btn" type="submit" name="submit">
                        </form>
                    </div>
                </div>
            </section>

            <?php 
                include_once('../components/Footer.php')
            ?>
    </body>
</html>