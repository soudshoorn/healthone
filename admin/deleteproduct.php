<?php 
    session_start();
    include_once('../dbConnection.php');

    if(!isset($_SESSION['admin'])) {
        header("Location: ../index.php");
    }

    try {
        $id = $_GET['id'];

        $image = $db->prepare("SELECT * FROM products WHERE id = :id");
        $image->bindParam('id', $id);
        $image->execute();

        $result = $image->fetch(PDO::FETCH_ASSOC);
        
        $foto = $result['img'];

        unlink("../assets/img/".$foto);
    
        $deletereviews = $db->prepare("DELETE FROM reviews WHERE product_id = :product_id");
        $deletereviews->bindParam('product_id', $id);
        $deletereviews->execute();

        $delete = $db->prepare("DELETE FROM products WHERE id = :id ");
        $delete->bindParam('id', $id);

        if($delete->execute()){
            $_SESSION['success'] = "Het product is succesvol verwijderd.";      
            header("Location: ./admin.php");  
        } else {
            $_SESSION['error'] = "Iets is fout gegaan bij het verwijderen. Probeer het later opnieuw.";
            header("Location: ./admin.php");        
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>