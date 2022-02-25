<?php

require_once 'db.php';

$conn = connectDB();

$id = $_POST['idElement'] ?? null;

if ($id) {
    $query = "SELECT * FROM Task WHERE id = $id";
    $result = mysqli_query($conn, $query);


    if ($result) {
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }
        echo json_encode($json);
    } else {
        die("Query failed");
    }
}
