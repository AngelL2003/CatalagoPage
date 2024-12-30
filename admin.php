<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="admin-container">
        <h2>Bienvenido al Panel de Administración</h2>
        <!-- Aquí puedes añadir funcionalidades exclusivas para el administrador -->
        <a href="admin_image_manage.php">Gestionar imágenes</a>
    </div>
</body>
</html>
