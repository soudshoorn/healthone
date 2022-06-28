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

                if(!isset($_SESSION['admin'])) {
                    header("Location: ../index.php");
                }

                $product = $db->prepare("SELECT * FROM products WHERE id = :id");
                $product->bindParam("id", $_GET['id']);
                $product->execute();
    
                $productresult = $product->fetch(PDO::FETCH_ASSOC);

                if (isset($_POST['editsubmit'])) {
                    $products = $db->prepare("SELECT * FROM products");
                    $products->execute();
        
                    $result = $products->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result as $data) {

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

                                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                                    $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING);
                                    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
                
                                    $query = $db->prepare("UPDATE products SET name = :name, img = :img, description = :description, category_id = :category_id WHERE id = :id");
                
                                    $query->bindParam("name", $name);
                                    $query->bindParam("img", $fileNameNew);
                                    $query->bindParam("description", $description);
                                    $query->bindParam("category_id", $category);
                                    $query->bindParam("id", $_GET['id']);

                                    if ($query->execute()) {
                                        $_SESSION['success'] = "Het product is succesvol gewijzigd.";
                                        header("Location: ./admin.php");
                                    } else {
                                        $_SESSION['error'] = "Er is iets fout gegaan, probeer later opnieuw.";
                                        header("Location: ./admin.php");
                                    }
                                    echo "<br />";
                                } else {
                                    $_SESSION['error'] = "Dit bestand is te groot.";
                                    header("Location: ./admin.php");
                                }
                            } else {
                                $_SESSION['error'] = "Er is iets fout gegaan, probeer later opnieuw.";
                                header("Location: ./admin.php");
                            }
                        } else {
                            $_SESSION['error'] = "Verboden bestandstype. Alleen jpg, jpeg & png's zijn toegestaan.";
                            header("Location: ./admin.php");
                        }
                    }
                }

            ?>
                    <section class='editproduct'>
                        <div class='container'>
                            <div class='row'>
                                <form method='POST' enctype='multipart/form-data'>
                                    <label>Categorie</label>
                                    <select name='category'>
                                        <option value='1' <?php if($productresult['category_id'] == 1){echo 'selected';}  ?> >Crosstrainers</option>
                                        <option value='2' <?php if($productresult['category_id'] == 2){echo 'selected';}  ?> >Loopbanden</option>
                                    </select>
                
                                    <label>Naam</label>
                                    <input type='text' name='name' value='<?php echo $productresult['name']; ?>' required>
                
                                    <label>Foto</label>
                                    <input type='file' name='file' value='<?php echo $productresult['img']; ?>'>
                
                                    <label>Beschrijving</label>
                                    <textarea name='description' required><?php echo $productresult['description']; ?></textarea>
                
                                    <input class='btn' type='submit' name='editsubmit' value='Verzenden'>
                                </form>
                            </div>
                        </div>
                    </section>
    </body>
</html>