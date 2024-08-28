<?php
session_start();

// Verificar si el usuario está logueado y tiene el rol adecuado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el rol del usuario
$rol_id = $_SESSION['rol_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Sistema de Votaciones 2024</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1e1e2f;
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .menu-container {
            background-color: #2b2b3c;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .menu-container h1 {
            font-size: 2rem;
            color: #00ff99;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .menu-container a {
            display: block;
            padding: 15px;
            margin: 10px 0;
            text-decoration: none;
            color: #fff;
            background-color: #3b3b4f;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s;
        }

        .menu-container a:hover {
            background-color: #4a4a62;
        }

        .logout-button {
            background-color: #ff4c4c;
        }

        .logout-button:hover {
            background-color: #e03a3a;
        }
    </style>
</head>
<body>

    <div class="menu-container">
        <h1>Menú Principal</h1>
        <?php if ($rol_id == 1) { // Rol de administrador ?>
            <a href="admin.php">Administrador</a>
        <?php } ?>
        <a href="votar.php">Votar</a>
        <a href="resultados.html">Resultados</a>
        <a href="logout.php" class="logout-button">Cerrar Sesión</a>
    </div>

</body>
</html>
