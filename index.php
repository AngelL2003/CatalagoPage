<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <div class="logo_empresa">
            <img src="../Nuevo/img/Logo_Empresa.jpg" alt="Logo de la empresa">

        </div>
        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario o Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
            <button type="submit" onclick="window.location.href='register.php'">Registrarse</button>
        </form>
    </div>
</body>
</html>
