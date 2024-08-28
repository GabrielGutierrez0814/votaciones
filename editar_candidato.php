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

// Obtener el ID del candidato a editar
$id = $_GET['id'];

// Obtener los datos del candidato
$sql = "SELECT * FROM candidatos WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Candidato no encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Candidato</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0a0b0e;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #1c1f26;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 400px;
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Editar Candidato</h1>
        <form action="procesar_edicion_candidato.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo $row['edad']; ?>" required>

            <label for="foto">Foto del Candidato (dejar en blanco si no se desea cambiar):</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

</body>
</html>
