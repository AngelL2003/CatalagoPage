<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirigir al login si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
    <link rel="stylesheet" href="upload_style.css">
</head>
<body>
    <div class="upload-container">
        <h2>Subir una nueva imagen</h2>
        <form action="upload_process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Selecciona una imagen:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit">Subir Imagen</button>
        </form>
    </div>
    <?php
    // Verificamos si el usuario tiene el rol de 'usuario'
    if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    // El rol es 'usuario', mostrar el botón
    echo '<button onclick="window.location.href=\'catalogo.php\'">Volver</button>';
}
    ?>
</body>
</html>
