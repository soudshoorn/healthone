<?php
    if(isset($_SESSION['success'])) {
        echo "<div class='row alert alert-success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }

    if(isset($_SESSION['error'])) {
        echo "<div class='row alert alert-error'>ERROR: ".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
?>