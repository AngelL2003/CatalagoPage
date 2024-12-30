<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: usuarios.php");
} else {
    echo "Error al eliminar el usuario: " . mysqli_error($conn);
}
?>
