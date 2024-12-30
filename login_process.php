<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el nombre de usuario
    $query = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Verificar si el usuario existe
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password, $role);
        mysqli_stmt_fetch($stmt);

        // Verificar la contraseña ingresada con la almacenada (hasheada)
        if (password_verify($password, $hashed_password)) {
            // Si la verificación es correcta, iniciar la sesión
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role; // Guardamos el rol del usuario

            // Redirigir al catálogo de imágenes o página principal
            header("Location: catalogo.php");
            exit();
        } else {
            // Si la contraseña no coincide, mostrar mensaje de error
            echo "Credenciales incorrectas. Regístrate si no tienes usuario.";
        }
    } else {
        // Si el usuario no existe, mostrar mensaje de error
        echo "Credenciales incorrectas.";
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
}
?>

