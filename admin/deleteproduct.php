<?php 
    include_once('../dbConnection.php');

    try {
        $id = $_GET['id'];

        $image = $db->prepare("SELECT * FROM products WHERE id = :id");
        $image->bindParam('id', $id);
        $image->execute();

        $result = $image->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as &$data) {
            $foto = $data['img'];
        }

        unlink("../assets/img/".$foto);
    
        $delete = $db->prepare("DELETE FROM products WHERE id = :id ");
        $delete->bindParam('id', $id);

        if($delete->execute()){

            // error op beheer.php 
            header("Location: ./manageproduct.php");
        
        } else {
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>