<?php

require_once 'db.php';
$conn = connectDB();


if (isset($_POST['idElement'])) {
    $id = $_POST['idElement'];

    $query = "DELETE FROM Task WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "delete is successfull";
    } else {
        echo "delete is not successful";
    }

    
}