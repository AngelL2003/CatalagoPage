<?php
session_start();
include 'config.php';

// Verificamos si el usuario tiene el rol de 'usuario'
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    // El rol es 'usuario', mostrar el botón
    echo '<button onclick="window.location.href=\'catalogo.php\'">Volver</button>';
}

// Obtener todas las imágenes de la base de datos
$query = "SELECT * FROM images";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Imágenes</title>
    <link rel="stylesheet" href="adminimstyles.css">
</head>
<body>
    <div class="admin-container">
        <h2>Gestionar Imágenes Subidas</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Subida por Usuario ID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>" width="100">
                        </td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td>
                            <a href="admin_manage_image.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta imagen?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
