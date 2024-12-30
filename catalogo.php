<?php
session_start();

// Verificar si la variable de sesión de usuario está definida
if (!isset($_SESSION['role'])) {
    // Si no está definida, redirigir al login o página de error
    header("Location: index.php");
    exit();
}

// Verificamos si el usuario tiene el rol de 'usuario'
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    // El rol es 'usuario', mostrar el botón
    echo '<button onclick="window.location.href=\'admin_image_manage.php\'">Gestionar imagenes</button>';
    echo '<button onclick="window.location.href=\'upload.php\'">Subir imagen</button>';
    echo '<button onclick="window.location.href=\'usuarios.php\'">Administrar Usuarios</button>';
}
?>

<?php
// Incluir la conexión a la base de datos
include 'config.php';

// Consulta para obtener todas las imágenes desde la base de datos
$query = "SELECT images.id, images.title, images.image_path, images.description, images.uploaded_at, users.username 
          FROM images
          INNER JOIN users ON images.user_id = users.id
          ORDER BY images.uploaded_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Imágenes</title>
    <link rel="stylesheet" href="catalogo_style.css">
</head>
<body>
    <div class="catalog-container">
        <h2>Catálogo de Imágenes</h2>
        
        <div class="cards-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>" class="card-image">
                    <div class="card-content">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <small>Subido por: <?php echo $row['username']; ?> el <?php echo $row['uploaded_at']; ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
