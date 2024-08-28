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

// Capturar datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$cedula = $_POST['cedula'];
$candidato_id = $_POST['candidato_id'];

// Verificar si la cédula ya ha votado
$check_sql = "SELECT * FROM votos WHERE cedula = '$cedula'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    $response = array("status" => "error", "message" => "Ya has votado anteriormente.");
} else {
    // Insertar el voto en la base de datos
    $sql = "INSERT INTO votos (nombre, apellidos, cedula, candidato_id) VALUES ('$nombre', '$apellidos', '$cedula', '$candidato_id')";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Voto registrado exitosamente.");
    } else {
        $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    }
}

$conn->close();

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
