<?php

require_once 'db.php';
$conn = connectDB();



$query = "SELECT * FROM Task";

$result = mysqli_query($conn, $query);

if ($result) {
    $json = array();
    while($row = mysqli_fetch_assoc($result)) {
        $json[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description']
        );
    }
    $json_string = json_encode($json);
    echo $json_string;
} else {
    die("Query failed");
}




