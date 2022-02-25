<?php

require_once 'db.php';
$conn = connectDB();

$search =  htmlentities($_POST['search'] ?? null) ;

if ($search != null) {
    $query = "SELECT * FROM Task WHERE name LIKE '%$search%'";
    $data = mysqli_query($conn, $query);

    if (!$data) {
        die("Error consulta" . mysqli_error($conn));
    }

    $json = array();

    while ($row = mysqli_fetch_array($data)) {
        $json[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description']
        );
    }
    
    $json_string = json_encode($json);


    echo $json_string;

}