<?php

require_once 'db.php';

$conn = connectDB();


$id =  filter_var($_POST['id'], FILTER_VALIDATE_INT);
$taskName = htmlentities($_POST['name'] ?? null);
$taskDescription = htmlentities($_POST['description'] ?? null);


$query = "UPDATE Task SET name = '{$taskName}', description = '{$taskDescription}' where id = $id";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "Task updated successfully";
} else {
    die(mysqli_error($conn));
}