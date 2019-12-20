<?php 
    if (isset($_COOKIE['PHPSESSDI'])) {
        include("../db-connect.php");
        include("profile.php");
    }

    else header("Location: /");
?>