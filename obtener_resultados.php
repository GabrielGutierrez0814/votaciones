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

// Obtener los resultados de los votos y la ruta de las fotos
$sql = "SELECT candidatos.nombre, COUNT(votos.id) AS votos, candidatos.foto
        FROM candidatos
        LEFT JOIN votos ON candidatos.id = votos.candidato_id
        GROUP BY candidatos.id";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
