<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votaciones 2024</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1e1e2f;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #2b2b3c;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .header h1 {
            font-size: 3rem;
            color: #00ff99;
            text-transform: uppercase;
        }

        .main {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .card {
            background-color: #2b2b3c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100px;
            margin-bottom: 15px;
            border-radius: 50%;
        }

        .card h3 {
            font-size: 1.5rem;
            color: #00ff99;
        }

        .card p {
            color: #b0b0c3;
        }

        .card button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            background-color: #00ff99;
            color: #1e1e2f;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card button:hover {
            background-color: #00cc7a;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            padding: 20px 0;
            background-color: #2b2b3c;
        }

        .footer p {
            color: #b0b0c3;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-vote-yea"></i> Votaciones 2024</h1>
        </div>

        <!-- Main Content -->
        <div class="main">
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
            // Iterar sobre cada candidato y mostrarlo en la tarjeta
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<img src='" . $row['foto'] . "' alt='Foto de " . $row['nombre'] . "' width='100' height='100'>";
                echo "<h3>" . $row['nombre'] . " " . $row['apellido'] . "</h3>";
                echo "<p>Edad: " . $row['edad'] . "</p>";
                echo "<a href='entrada_datos.php?candidato_id=" . $row['id'] . "'><button>Votar</button></a>";
                echo "</div>";
            }
        } else {
            echo "<div class='card'><p>No hay candidatos registrados.</p></div>";
        }

        $conn->close();
        ?>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; Gabriel Soft 2024</p>
        </div>
    </div>

</body>
</html>
