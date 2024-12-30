<?php
session_start();
include 'config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: login.php");
    exit();
}

// Verificar si el usuario tiene rol de admin
if ($_SESSION['role'] !== 'admin') {
    // Si el rol no es admin, mostrar un mensaje de error o redirigir
    echo "No tienes permisos para acceder a esta página.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con PHP y MySQL</title>
    <link rel="stylesheet" href="usuariostyle.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>

        <!-- Formulario para agregar usuarios -->
        <form action="create.php" method="POST">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Agregar Usuario</button>
        </form>

        <!-- Tabla para mostrar usuarios -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "'>Editar</a>
                        <a href='delete.php?id=" . $row['id'] . "'>Eliminar</a>
                    
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
