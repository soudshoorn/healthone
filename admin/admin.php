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
                    exit();
                }

                if(isset($_GET['createproduct'])) {
                    echo "
                    <section class='addproduct'>
                        <div class='container'>
                            <div class='row'>
                                <form method='POST' enctype='multipart/form-data'>
                                    <label>Categorie</label>
                                    <select name='category'>
                                        <option value='1'>Crosstrainers</option>
                                        <option value='2'>Loopbanden</option>
                                        <option value='3'>Roeitrainers</option>
                                        <option value='4'>Hometrainer</option>
                                    </select>
                
                                    <label>Naam</label>
                                    <input type='text' name='name' required>
                
                                    <label>Foto</label>
                                    <input type='file' name='file' required>
                
                                    <label>Beschrijving</label>
                                    <textarea name='description' required></textarea>
                
                                    <input class='btn' type='submit' name='submit' value='Verzenden'>

                                    <div class='addproduct__cancel'>
                                        <a href='/healthone/admin/admin.php' class='addproduct__cancel btn'>Annuleren</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    ";
                }

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
                                    $_SESSION['success'] = "Het nieuwe product is toegevoegd.";
                                    header("Location: ./admin.php");
                                } else {
                                    $_SESSION['error'] = "Er is iets fout gegaan, probeer later opnieuw.";
                                }
                                echo "<br />";
                            } else {
                                $_SESSION['error'] = "Dit bestand is te groot.";
                            }
                        } else {
                            $_SESSION['error'] = "Er is iets fout gegaan, probeer later opnieuw.";
                        }
                    } else {
                        $_SESSION['error'] = "Verboden bestandstype. Alleen jpg, jpeg & png's zijn toegestaan.";
                    }
                }
            ?>

            <section class="users">
                <div class="container">
                    <div class="row">
                    <table class="manageproducts__table">
                            <tr>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>E-Mail</th>
                                <th>Rol</th>
                                <th></th>
                                <th></th>
                            </tr>
                        <?php 
                            $users = $db->prepare("SELECT * FROM users");
                            $users->execute();
                
                            $result = $users->fetchAll(PDO::FETCH_ASSOC);

                            foreach($result as &$data) {
                                echo "
                                <tr>
                                    <td>" . $data['id'] . "</td>
                                    <td>" . $data['name'] . "</td>
                                    <td>" . $data['email'] . "</td>
                                    <td>" . $data['role'] . "</td>
                                    <td class='edit__btn--wrapper'><a href='/healthone/admin/edituser.php?id=" . $data['id'] . "' class='edit__btn'><i class='fas fa-pencil-alt'></i></i></a></td>
                                    <td class='delete__btn--wrapper'><a href='/healthone/admin/admin.php?verify_userdelete=".$data['id']."' class='delete__btn'><i class='fas fa-times'></i></a></td>
                                </tr>
                                ";
                            }


                            if(isset($_GET['verify_userdelete'])) {
                                $id = $_GET['verify_userdelete'];
                                echo "
                                <div class='verify'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='verify__wrapper'>
                                                <form method='POST' class='verify__form'>
                                                    <h3>Weet je zeker dat je deze gebruiker wilt verwijderen?</h3>
                                
                                                    <div class='verify__buttons'>
                                                        <a href='/healthone/admin/admin.php' class='btn verify__cancel'>Annuleren</a>
                                                        <a href='/healthone/admin/deleteuser.php?id=".$id."' class='btn verify__delete'>Verwijderen</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </section>

            <section class="manageproducts">
                <div class="container">
                    <div class="row">
                        <div class="manageproducts__create">
                            <a href="/healthone/admin/admin.php?createproduct" class="btn manageproducts__create--btn">Nieuw  <i class="fas fa-plus"></i></a>
                        </div>
                        <table class="manageproducts__table">
                            <tr>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>Image</th>
                                <th>Beschrijving</th>
                                <th>Cat. ID</th>
                                <th></th>
                                <th></th>
                            </tr>
                        <?php 
                            $category = $db->prepare("SELECT * FROM products");
                            $category->execute();
                
                            $result = $category->fetchAll(PDO::FETCH_ASSOC);

                            foreach($result as &$data) {
                                echo "
                                <tr>
                                    <td>" . $data['id'] . "</td>
                                    <td class='manageproduct__description'>" . $data['name'] . "</td>
                                    <td class='manageproduct__description'>" . $data['img'] . "</td>
                                    <td class='manageproduct__description'>" . $data['description'] . "</td>
                                    <td class='manageproduct__categoryid'>" . $data['category_id'] . "</td>
                                    <td class='edit__btn--wrapper'><a href='/healthone/admin/editproduct.php?id=" . $data['id'] . "' class='edit__btn'><i class='fas fa-pencil-alt'></i></i></a></td>
                                    <td class='delete__btn--wrapper'><a href='/healthone/admin/admin.php?verify_productdelete=".$data['id']."' class='delete__btn'><i class='fas fa-times'></i></a></td>
                                </tr>
                                ";
                            }


                            if(isset($_GET['verify_productdelete'])) {
                                $id = $_GET['verify_productdelete'];
                                echo "
                                <div class='verify'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='verify__wrapper'>
                                                <form method='POST' class='verify__form'>
                                                    <h3>Weet je zeker dat je dit product wilt verwijderen?</h3>
                                
                                                    <div class='verify__buttons'>
                                                        <a href='/healthone/admin/admin.php' class='btn verify__cancel'>Annuleren</a>
                                                        <a href='/healthone/admin/deleteproduct.php?id=".$id."' class='btn verify__delete'>Verwijderen</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                        </table>
                    </div>
                </div>
            </section>
    </body>
</html>