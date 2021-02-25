<?php 
    $conn = new mysqli('localhost', 'root', 'root', 'asuwebcamp');

    if($conn->connect_error) {
        echo $error -> $conn->connect_error;
    }
?>