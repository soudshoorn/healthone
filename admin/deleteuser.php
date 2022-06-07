<?php 
    session_start();
    include_once('../dbConnection.php');

    try{    
        $id = $_GET['id'];
        $delete = $db->prepare("DELETE FROM users WHERE id = :id");
        $delete->bindParam('id', $id);

        if($delete->execute()){
            header("Location: ./admin.php");  
            $_SESSION['success'] = "De gebruiker is succesvol verwijderd.";      
        } else {
            header("Location: ./admin.php");        
            $_SESSION['error'] = "Iets is fout gegaan bij het verwijderen. Probeer het later opnieuw.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>