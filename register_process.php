<?php
// Incluir la conexión a la base de datos
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el usuario o el email ya existen
    $query_check = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
    $stmt_check = mysqli_prepare($conn, $query_check);
    mysqli_stmt_bind_param($stmt_check, "ss", $username, $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Nombre de usuario o correo electrónico ya registrados.";
    } else {
        // Cifrar la contraseña antes de guardarla
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir al login después de un registro exitoso
            header("Location: index.php");
            exit();
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
?>
