<?php
session_start();
include 'config.php'; // Asegúrate de incluir el archivo de conexión

// Código para eliminar la imagen seleccionada
if (isset($_GET['delete_id'])) {
    $image_id = $_GET['delete_id'];

    // Primero, obtenemos la ruta de la imagen para eliminarla del servidor
    $query = "SELECT image_path FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query); // Usamos la variable $conn de la conexión
    mysqli_stmt_bind_param($stmt, "i", $image_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $image_path);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Eliminar la imagen del servidor
    if (file_exists($image_path)) {
        unlink($image_path); // Elimina el archivo de imagen
    }

    // Luego, eliminamos el registro de la imagen en la base de datos
    $query = "DELETE FROM images WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $image_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirigir al mismo archivo después de eliminar la imagen
        header("Location: admin_image_manage.php");
        exit();
    } else {
        echo "Error al eliminar la imagen.";
    }
}
?>
