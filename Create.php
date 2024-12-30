<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    

    // Consulta para verificar si ya existe un usuario con el mismo username o email
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Si hay resultados, significa que ya existe un usuario con el mismo username o email
    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "Error: El nombre de usuario o correo electrónico ya está en uso.";
    } else {
        // Hashear la contraseña antes de insertarla
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Si no hay duplicados, insertamos el nuevo usuario con la contraseña hasheada
        $insert_query = "INSERT INTO users (username, email) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "ss", $name, $email);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: usuarios.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
}
?>
