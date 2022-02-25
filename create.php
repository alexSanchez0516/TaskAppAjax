<?php

require_once 'db.php';
$conn = connectDB();

$taskName = htmlentities($_POST['name'] ?? null);
$taskDescription = htmlentities($_POST['description'] ?? null);


if ($taskName && $taskDescription) {
    $query = "INSERT INTO Task(name, description) VALUES ('${taskName}', '${taskDescription}')";
    if (mysqli_query($conn, $query)) {
        echo "Guardado correctamente";
    } else {
        die("Consulta ha fallado");
    }
}