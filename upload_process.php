<?php
session_start();
include 'config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Verificar si el usuario es administrador
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('No tienes los permisos');
            window.location='/Nuevo/catalogo.php';</script>";
    exit();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Verificar si se ha seleccionado una imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_error = $_FILES['image']['error'];
        $image_type = $_FILES['image']['type'];

        // Extensiones de imagen permitidas
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Validar la extensión de la imagen
        if (in_array($image_extension, $allowed_extensions)) {
            // Definir la ruta de almacenamiento
            $image_new_name = uniqid('', true) . '.' . $image_extension;
            $image_path = 'uploads/' . $image_new_name;

            // Mover la imagen a la carpeta de destino
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Insertar la información de la imagen en la base de datos
                $query = "INSERT INTO images (user_id, image_path, title, description) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "isss", $user_id, $image_path, $title, $description);

                if (mysqli_stmt_execute($stmt)) {
                    // Redirigir al catálogo si la subida fue exitosa
                    header("Location: catalogo.php");
                    exit();
                } else {
                    echo "Error al guardar la imagen en la base de datos.";
                }
            } else {
                echo "Error al mover la imagen al servidor.";
            }
        } else {
            echo "Formato de imagen no permitido. Solo se permiten JPG, JPEG, PNG y GIF.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>
