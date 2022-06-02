<html>
    <head>
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
            <?php
                include_once('./dbConnection.php');   
                include_once('./components/Nav.php');
            ?>
            
            <form method="POST" enctype="multipart/form-data">
                <label>Categorie</label>
                <select name="category">
                    <option value="1">Crosstrainers</option>
                    <option value="2">Loopbanden</option>
                </select>

                <label>Naam</label>
                <input type="text" name="name">

                <label>Foto</label>
                <input type="file" name="file">

                <label>Beschrijving</label>
                <input type="text" name="description">

                <input type="submit" name="submit">
            </form>

            <?php 

                if (isset($_POST['submit'])) {

                    $file = $_FILES['file'];


                    $fileError = $file['error'];
                    $fileTmp = $file['tmp_name'];
                    $fileName = $file['name'];
                    $fileSize = $file['size'];

                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileError === 0) {
                            if ($fileSize < 500000) {
                                $fileNameNew = uniqid('', true).".".$fileActualExt;
                                $fileDestination = 'assets/img/'.$fileNameNew;
                                move_uploaded_file($fileTmp, $fileDestination);
                            } else {
                                echo "Dit bestand is te groot.";
                            }
                        } else {
                            echo "Er is iets fout gegaan, probeer het later opnieuw.";
                        }
                    } else {
                        echo "Dit type bestand is verboden.";
                    }

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
                        echo "Het nieuwe product is toegevoegd!";
                    } else {
                        echo "Er is iets fout gegaan!";
                    }
                    echo "<br />";
                }

                include_once('./components/Footer.php')
            ?>
    </body>
</html>