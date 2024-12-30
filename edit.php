<?php
include 'config.php';

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE users SET username='$name', email='$email', role='$role' WHERE id=$id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: usuarios.php");
    } else {
        echo "Error al actualizar el usuario: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="" method="POST">
        <label for="username">Nombre</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <label for="email">Correo Electronico</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <label for="Rol">Rol</label>
        <input type="text" name="role" value="<?php echo $user['role']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
