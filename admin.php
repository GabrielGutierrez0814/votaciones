<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 1) { // 1 es el rol de 'Administrador'
    header("Location: login.php");
    exit();
}

// Código para crear candidatos aquí...
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestión de Candidatos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0a0b0e;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .navbar {
            width: 100%;
            padding: 15px;
            background-color: #1c1f26;
            display: flex;
            justify-content: space-around;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .navbar a {
            color: #00ff99;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #2a2f38;
        }
        .navbar a:hover {
            background-color: #00b367;
        }
        .container {
            background-color: #1c1f26;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 600px;
            margin: 100px auto 30px auto; /* Espaciado para margen superior e inferior */
        }
        h1 {
            text-align: center;
            color: #00ff99;
            margin-bottom: 20px;
        }
        label {
            color: #bbb;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2a2f38;
            color: #fff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #00cc7a;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #00b367;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        th {
            background-color: #00ff99;
        }
        td {
            background-color: #2a2f38;
        }
        a {
            color: #00cc7a;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="menu.php">Inicio</a>
        <a href="resultados.html">Resultados</a>
        <a href="votar.php">Votar</a>
        <a href="logout.php">Cerrar Sesión</a>
    </div>

    <div class="container">
        <h1>Agregar Candidato</h1>
        <form action="procesar_candidato.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required>

            <label for="foto">Foto del Candidato:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <input type="submit" value="Agregar Candidato">
        </form>
    </div>

    <div class="container">
        <h1>Lista de Candidatos</h1>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistema_votacion";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }
                
                // Obtener la lista de candidatos
                $sql = "SELECT * FROM candidatos";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Iterar sobre cada candidato y mostrarlo en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['foto'] . "' alt='Foto de " . $row['nombre'] . "' width='50' height='50'></td>";
                        echo "<td>" . $row['nombre'] . " " . $row['apellido'] . "</td>";
                        echo "<td>" . $row['edad'] . "</td>";
                        echo "<td class='actions'>
                                <a href='editar_candidato.php?id=" . $row['id'] . "'>Editar</a> |
                                <a href='eliminar_candidato.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este candidato?\");'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay candidatos registrados.</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
