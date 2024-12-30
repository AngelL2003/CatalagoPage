<?php
$servername = "localhost";
$username = "root";  // O el usuario de tu base de datos
$password = "";  // La contraseña de tu usuario (en XAMPP por defecto está vacía)
$dbname = "crud_db";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
