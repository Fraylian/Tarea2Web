<?php
$host = 'localhost';
$db = 'guerrerosz';
$user = 'root';
$pass = '';

// Crear una conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
